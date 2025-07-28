@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
          $payment_currency= $setting_data['payment_currency'];
    @endphp
	<!-- start banner sec -->
  
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

	<!-- start about section -->
        
      <!-- About Section -->
 
      <section class="About-sec">

        <div class="container">

            <div class="row">

                            <div class="t1">
                            <h4 style="font-size: 17px; color: #000; font-weight: 600">Hey {{$booking['name']}},</h4>

                            <p style=" font-size: 15px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 15px 0; text-align: left">Your booking request has been submitted successfully. You will receive an email for the booking request. <br> We will contact you shortly.</p>
                            <div class="table-box">

                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <th colspan="2" align="center" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Property Detail </strong></th>
                                </tr>

                                <tr>
                                    <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; font-family: 'Poppins', sans-serif; color:#000; border-right:0px solid var(--secondary-color);" valign="top"><strong>Property Name :</strong></td>
                                    <td align="left" style="padding: 10px; border: 1px solid var(--secondary-color); font-weight: bold; font-size: 15px; font-family: 'Poppins', sans-serif; color:#000;" valign="top">{{$property->name }}</td>
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
                           
@php
    $main_data=json_decode($booking['amount_data'],true);
//  dd($main_data);
@endphp
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 30px;">
                            <tbody>
                                <tr>
                                    <th colspan="5" align="center" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top" class="book"><strong>Booking Detail </strong></th>
                                </tr>

                                <tr>
                                    <th align="left" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkin :</strong></th>
                                    <th align="left" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Checkout :</strong></th>
                                    <th align="left" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Guest :</strong></th>
                                    <th align="left" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Total Night :</strong></th>
                                    <th align="center" style="padding: 10px; background: var(--secondary-color); color: #fff; text-align: center; font-size: 15px;" valign="top"><strong>Amount :</strong></th>
                                    
                                </tr>
                                <tr>
                                    <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['checkin'] }}</td>
                                    <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['checkout'] }}</td>
                                    <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                    <td align="left" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{{$booking['total_night'] }}</td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['amount'],2)}}</td>
                                </tr>
                                
                                
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Rent </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['rent'],2)}}</td>
                                </tr>
                                
                                
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Rent Taxes</td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['rentTaxes'],2)}}</td>
                                </tr>
                                
                                 @if($main_data['extraGuestsFeeAmount']!=0)
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Extra Guests Fee </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['extraGuestsFeeAmount'],2)}}</td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Extra Guest Tax </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['extraGuestFeeTaxes'],2)}}</td>
                                </tr>
                                

                                @endif

                                
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Cleaning Fee </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['cleaningFeeAmount'],2)}}</td>
                                </tr>
                                 @foreach($main_data['customFees'] as $c)
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> {{ ucfirst($c['name'])}} </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($c['amount'],2)}}</td>
                                   </tr>
                                
                                 @endforeach
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Total </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['totalWithoutTaxes'],2)}}</td>
                                </tr>
                                
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Tax ({{number_format($main_data['taxationRate'],2)}}%) </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['totalWithTaxes']-$main_data['totalWithoutTaxes'],2)}}</td>
                                </tr>
                                
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Total with tax </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['totalWithTaxes'],2)}}</td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Security Deposit Amount </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['securityDepositAmount'],2)}}</td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Total with Taxes and Security Deposit </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['totalWithTaxesAndSecDeposit'],2)}}</td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top"> Amount to Pay </td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-bottom:0px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['amountToPay'],2)}}</td>
                                </tr>
                                @if($booking['next_payment_date'])
                                <tr>
                                    <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color);" valign="top"> Next Payment ({{ $booking['next_payment_date'] }} )</td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color);" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($main_data['totalWithTaxesAndSecDeposit']-$main_data['amountToPay'],2)}}</td>
                                </tr>

                                @endif

                                @if($booking['is_pet']=="yes")
                                <tr>
                                    <td align="left" colspan="4"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color);"  valign="top"> Pet</td>
                                    <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color);" valign="top">{!! $booking['pet_no'] !!}</td>
                                </tr>
                                    @if($booking['pet_no']==1)
                                    <tr>
                                        <td align="left" colspan="4"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color);"  valign="top">First Pet Weight</td>
                                        <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color);" valign="top">{!! $booking['first_pet_weight'] !!}</td>
                                    </tr>
                                    @endif
                                    @if($booking['pet_no']==2)
                                    <tr>
                                        <td align="left" colspan="4"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color); border-right:0px solid var(--secondary-color);"  valign="top">Second Pet Weight</td>
                                        <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid var(--secondary-color);" valign="top">{!! $booking['second_pet_weight'] !!}</td>
                                    </tr>
                                    @endif
                                @endif

          
        
                            </tbody>
                        </table>
                            </div>
                            </div>
                            

            </div>

        </div>

    </section>

    

@stop