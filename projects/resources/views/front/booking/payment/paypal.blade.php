@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")
    @php
        $main_data=json_decode($booking['amount_data'],true);
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        $amount=$main_data['quote']['totalAmount'];
        $payment_currency= $setting_data['payment_currency'];
       $curr=$payment_currency;
    @endphp
    <section class="page-title" style="background-image: url({{$bannerImage}});">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate">{{$name}}</h1>
            <div class="checklist">
                <p>
                    <a href="{{url('/')}}" class="text"><span>Home</span></a>
                    <a class="g-transparent-a">{{$name}}</a>
                </p>
            </div>
        </div>
    </section>
      <section class="About-sec">
        <div class="container">
            <div class="row">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="left" valign="top" style="border:0px solid transparent;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Property Detail </strong></th>
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 10px;" valign="top"><strong>Property Name :</strong></td>
                                            <td align="left" style="padding: 10px;" valign="top">{{$property->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th colspan="2" align="center" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>User Detail </strong></th>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"><strong>Name :</strong></td>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"><strong>Email :</strong></td>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['email']}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"><strong>Mobile:</strong></td>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['mobile']}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000; border-right:0px solid var(--secondary-color);" valign="top"><strong>Message :</strong></td>
                                            <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; color:#000;" valign="top">
                                                {{$booking['message']}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                           
                                @php $main_data=json_decode($booking['amount_data'],true);@endphp
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                                    <tbody>
                                        <tr>
                                            <th colspan="5" align="center" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top" class="book"><strong>Booking Detail</strong></th>
                                        </tr>

                                        <tr>
                                            <th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkin :</strong></th>
                                            <th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkout :</strong></th>
                                            <th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Guest :</strong></th>
                                            <th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Night :</strong></th>
                                            <th align="center" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Amount :</strong></th>
                                            
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$booking['checkin'] }}</td>
                                            <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$booking['checkout'] }}</td>
                                            <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                            <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$booking['total_night'] }}</td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['quote']['rent']['rentNetPrice'],2)}}</td>
                                        </tr>
                                         @if($main_data['quote']['rent']['extraGuestsNetPrice']!=0)
                                        
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top"> Extra Guests Fee </td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['quote']['rent']['extraGuestsNetPrice'],2)}}</td>
                                        </tr>
                                            @endif
                                        

                                           @if($main_data['quote']['rent']['discount'])
                                            <tr>
                                               <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{ $main_data['quote']['rent']['discount']['discountCode']  }} ({{ $main_data['quote']['rent']['discount']['discountType']  }})</td>
                                               <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['rent']['discount']['amount'],2)}}</td>
                                           </tr>
                                           @endif

                 
                                       @if($main_data['quote']['rent']['taxAmount']!=0)
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Tax Amount</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['rent']['taxAmount'],2)}}</td>
                                       </tr>

                                       @endif
                                     
                                       @if($main_data['quote']['rent']['grossPrice']!=0)
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Gross Amount</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['rent']['grossPrice'],2)}}</td>
                                       </tr>

                                       @endif
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Cleaning Fee</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['fees']['cleaningFee']['grossPrice'],2)}}</td>
                                       </tr>
                                    
                                    
                                    
                                    @foreach($main_data['quote']['fees']['otherFees'] as $c)
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{ ucfirst($c['name'])}}</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($c['grossPrice'],2)}}</td>
                                       </tr>
                                    
                                      @endforeach
                                    
                               
                                    
                                        @if($main_data['quote']['includeSecurityDepositInTotal']==false)

                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Total Amount</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['totalAmount'],2)}}</td>
                                       </tr>

                                          <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Security Deposit Amount</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['securityDeposit'],2)}}</td>
                                       </tr>
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Amount to Pay</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format(($main_data['quote']['totalAmount']+$main_data['quote']['securityDeposit']),2)}}</td>
                                       </tr>

                                       @else
                                          <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Security Deposit Amount</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['securityDeposit'],2)}}</td>
                                       </tr>
                                       <tr>
                                           <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">Amount to Pay</td>
                                           <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{!! $curr !!} {{number_format($main_data['quote']['totalAmount'],2)}}</td>
                                       </tr>
                                        @endif
            
                

                                        
                                        @if($booking['is_pet']=="yes")
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top"> Pet</td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $booking['pet_no'] !!}</td>
                                        </tr>
                                            @if($booking['pet_no']==1)
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; " valign="top">First Pet Weight</td>
                                                <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $booking['first_pet_weight'] !!}</td>
                                            </tr>
                                            @endif
                                            @if($booking['pet_no']==2)
                                              <tr>
                                                <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">First Pet Weight</td>
                                                <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $booking['first_pet_weight'] !!} lbs</td>
                                            </tr>
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; " valign="top">Second Pet Weight</td>
                                                <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $booking['second_pet_weight'] !!} lbs</td>
                                            </tr>
                                            @endif
                                        @endif

                  

                                        </tbody>
                                    </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="paypal-button-container" style="    margin: 55px;text-align: center;"></div>
            </div>
        </div>
    </section>
@stop
@section("js")
<script src="https://www.paypal.com/sdk/js?client-id={{ ModelHelper::getDataFromSetting('paypal_access_token') }}" data-namespace="paypal_sdk"></script>
<script>
paypal_sdk.Buttons({
createOrder : function(data, actions){
  return actions.order.create({
    purchase_units : [{
      amount : {
        value : parseFloat("{{$amount}}")
      }
    }]
  })
},
style: {   color:  'gold',  shape:  'rect',  label:  'buynow', size: 'responsive', branding: true},
  onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
        location.href="{{ route('paypal.submit',[$booking['id']]) }}?tx="+details.id+"&st="+details.status+"&amt={{$amount}}&item_number={{$booking['id']}}";
    });
  },
}).render('#paypal-button-container');
</script>
@stop
@section("css")

@stop