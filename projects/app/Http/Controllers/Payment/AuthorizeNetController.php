<?php
namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Payment;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Session;
use ModelHelper;
use MailHelper;

class AuthorizeNetController extends Controller{
    
    function index(Request $request,$id){
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="stripe"){
            return redirect()->route("stripe_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="paypal"){
            return redirect()->route("paypal_payment",$id);
        }
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
                $data = new \stdClass();
                $data->name=" Payment Request ";
                $data->meta_title=" Payment Request ";
                $data->meta_keywords=" Payment Request ";
                $data->meta_description=" Payment Request ";
                $booking=$booking->toArray();
                return view("front.booking.payment.authorize",compact("booking","data","property"));
            }
        }
        return abort(404);
    }

    function indexPost(Request $request,$id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
                try {
                     $input = $request->input();
                    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
                    $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
                    $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));
                    $refId = 'ref' . time();
                    $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);
                    $creditCard = new AnetAPI\CreditCardType();
                    $creditCard->setCardNumber($cardNumber);
                    $creditCard->setExpirationDate($input['expiration-year'] . "-" .$input['expiration-month']);
                    $creditCard->setCardCode($input['cvv']);
                    $paymentOne = new AnetAPI\PaymentType();
                    $paymentOne->setCreditCard($creditCard);
                    $transactionRequestType = new AnetAPI\TransactionRequestType();
                    $transactionRequestType->setTransactionType("authCaptureTransaction");
                    $transactionRequestType->setAmount($input['amount']);
                    $transactionRequestType->setPayment($paymentOne);
                    $requests = new AnetAPI\CreateTransactionRequest();
                    $requests->setMerchantAuthentication($merchantAuthentication);
                    $requests->setRefId($refId);
                    $requests->setTransactionRequest($transactionRequestType);
                    $controller = new AnetController\CreateTransactionController($requests);
                    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
                    if ($response != null) {
                        if ($response->getMessages()->getResultCode() == "Ok") {
                            $tresponse = $response->getTransactionResponse();
                            if ($tresponse != null && $tresponse->getMessages() != null) {
                                $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                                $msg_type = "success_msg";  
                                  $payment=Payment::create(['booking_id'=>$booking->id,'receipt_url'=>'' ,'customer_id'=>'' ,'amount'=>$input['amount'],'tran_id'=>$tresponse->getTransId(),'description'=>json_encode($request->all()),'type'=>"authorize",'status'=>"complete"]);
                                ModelHelper::finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property);
                                return redirect('payment/success/'.$payment->id)->with("success","successfully Payment");
                            } else {
                                $message_text = 'There were some issue with the payment. Please try again later.';
                                $msg_type = "error_msg";                                    
                                if ($tresponse->getErrors() != null) {
                                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                                    $msg_type = "error_msg";                                    
                                }
                            }
                        } else {
                            $message_text = 'There were some issue with the payment. Please try again later.';
                            $msg_type = "error_msg";                                    
                            $tresponse = $response->getTransactionResponse();
                            if ($tresponse != null && $tresponse->getErrors() != null) {
                                $message_text = $tresponse->getErrors()[0]->getErrorText();
                                $msg_type = "error_msg";                    
                            } else {
                                $message_text = $response->getMessages()->getMessage()[0]->getText();
                                $msg_type = "error_msg";
                            }                
                        }
                    } else {
                        $message_text = "No response returned";
                        $msg_type = "error_msg";
                    }
                    return back()->with($msg_type, $message_text);
                }  catch (Exception $e) {
                    $message =$e->getError()->message ;
                }
            }else{
                $message="property is not longer";
            }
        }else{
            $message="Booking is invalid";
        }
        return redirect()->back()->with("danger",$message);
    }
}