
@php
	$main_data=json_decode($data['amount_data'],true);
//	dd($main_data);
	$curr=$setting_data['payment_currency'];
@endphp
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
							<tbody>
								<tr>
									<th colspan="5" align="center" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000;" valign="top"><strong>Booking Detail </strong></th>
								</tr>

								<tr>
									<th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkin :</strong></th>
									<th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkout :</strong></th>
									<th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Guest :</strong></th>
									<th align="left" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Night :</strong></th>
									<th align="center" style="padding: 10px; background: #00a9dd; color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Amount :</strong></th>
									
								</tr>
								<tr>
									<td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$data['checkin'] }}</td>
									<td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$data['checkout'] }}</td>
									<td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$data['total_guests'] }} ({{$data['adults']}} Adults, {{$data['child']}} Child)</td>
									<td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">{{$data['total_night'] }}</td>
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
    
        

								
                                @if($data['is_pet']=="yes")
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top"> Pet</td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $data['pet_no'] !!}</td>
                                </tr>
                                    @if($data['pet_no']==1)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; " valign="top">First Pet Weight</td>
                                        <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $data['first_pet_weight'] !!}</td>
                                    </tr>
                                    @endif
                                    @if($data['pet_no']==2)
                                      <tr>
                                        <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; border-bottom:0px solid #00a9dd;" valign="top">First Pet Weight</td>
                                        <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $data['first_pet_weight'] !!} lbs</td>
                                    </tr>
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd; border-right:0px solid #00a9dd; " valign="top">Second Pet Weight</td>
                                        <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #00a9dd;" valign="top">{!! $data['second_pet_weight'] !!} lbs</td>
                                    </tr>
                                    @endif
                                @endif

          
        
							</tbody>
						</table>