@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        $amount=$booking['total_amount'];
    @endphp
     @if($booking['discount'])
        @if($booking['discount']!="")
            @if($booking['discount']!=0)
            @php $amount=$booking['after_discount_total']; @endphp
            @endif
        @endif
    @endif
    @php
  $payment_currency= $setting_data['payment_currency'];
    @endphp
      @if($booking['amount_data'])
            @php
                $amount_data=json_decode($booking['amount_data'],true);
            @endphp
            @if(is_array($amount_data))
                @foreach($amount_data as $c)
                    @php $status='';@endphp
                    @if(isset($c['status']))
                  
                    @else
                        @php $amount=$c['amount'];break; @endphp
                    @endif
          
                @endforeach
            @endif
        @endif
    <!-- start banner sec -->
    @php //$amount=1; @endphp
    
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

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="left" valign="top">
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Property Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <td align="right" style="padding: 10px;" valign="top"><strong>Property Name :</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$property->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="5" align="center" style="padding: 10px;" valign="top"><strong>Booking Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkin :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkout :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Guest :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Night :</strong></th>
                                        <th align="right" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkin'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkout'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_night'] }}</td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['gross_amount'],2) }}</td>
                                    </tr>
                                    
                                    	@if($booking['rest_guests'])
								    @if($booking['rest_guests']>0)
								        @if($booking['guest_fee'])
								            @if($booking['guest_fee']>0)
								            <tr>
            									<td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">({{$booking['total_night']}} nights * {!! $setting_data['payment_currency'] !!}{{$booking['single_guest_fee']}} * {{$booking['rest_guests']}} Guests)</span></strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['guest_fee'],2) }}</td>
            								</tr>
								            @endif
								        @endif
								    @endif
								@endif
								
								
								@if($booking['total_pets'])
								    @if($booking['total_pets']>0)
								        @if($booking['pet_fee'])
								            @if($booking['pet_fee']>0)
								            <tr>
            									<td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong>Pet Fee :</strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['pet_fee'],2) }}</td>
            								</tr>
								            @endif
								        @endif
								    @endif
								@endif
								
                                    @foreach(json_decode($booking['before_total_fees']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['sub_amount'],2) }}</td>
                                    </tr>
                                    
                                    @foreach(json_decode($booking['after_total_fees']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['total_amount'],2) }}</td>
                                    </tr>
                                      	@php $gaurav_discount=0;@endphp
							    @if($booking['discount'])
                                    @if($booking['discount']!="")
                                        @if($booking['discount']!=0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Discount ({{ $booking['discount_coupon'] }}):</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
							    @if($booking['extra_discount'])
                                    @if($booking['extra_discount']!="")
                                        @if($booking['extra_discount']>0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['extra_discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
								@if($gaurav_discount==1)
								    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency']  !!}{{number_format($booking['after_discount_total'],2) }}</td>
                                    </tr>
								@endif
                                    

                                    @if($booking['amount_data'])
                                        @php
                                            $amount_data=json_decode($booking['amount_data'],true);
                                        @endphp
                                        @if(is_array($amount_data))
                                            @foreach($amount_data as $c)
                                                @php $status='';@endphp
                                                @if(isset($c['status']))
                                                    @php $status='(<span style="color:green;">Paid</span>)'; @endphp
                                                @endif
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c['message']}} {!! $status !!}:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c['amount'],2) }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif



                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
 @php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp
<!-- Company Overview section START -->
<section class="container-fluid " >
    <div class="card-panel">
        <div class="media wow fadeInUp" data-wow-duration="1s"> 
            <div class="companyIcon">
            </div>
            <div class="media-body">
                
                <div class="container">
                    @if(session('success_msg'))
                    <div class="alert alert-success fade in alert-dismissible show">                
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        {{ session('success_msg') }}
                    </div>
                    @endif
                    @if(session('error_msg'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>    
                        {{ session('error_msg') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Payment</h1>
                        </div>                       
                    </div>    
                    <div class="row">                        
                        <div class="col-xs-12 col-md-12" style=" border-radius: 5px; padding: 10px;">
                            <div class="panel panel-primary">                                       
                                <div class="creditCardForm">                                    
                                    <div class="payment">
                                        <form id="payment-card-info" method="post" action="{{ route('authorize.submit',[$booking['id']]) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group owner col-md-12">
                                                    <label for="owner">Card Holder Name</label>
                                                    <input type="text" class="form-control" id="owner" name="owner" value="{{ old('owner') }}" required>
                                                    
                                                </div>
                                                
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-4" id="card-number-field">
                                                    <label for="cardNumber">Card Number</label>
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" required>
                                                    <
                                                </div>
                                                <div class="form-group col-md-4 d-none" >
                                                    <label for="amount">Amount</label>
                                                    <input type="text" class="form-control" id="amount" name="amount" min="1" value="{{ $amount }}" required>
                                                   
                                                </div>
                                                <div class="form-group CVV col-md-4">
                                                    <label for="cvv">CVV</label>
                                                    <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                                    
                                                </div>
                                                <div class="form-group col-md-4" id="expiration-date">
                                                    <label>Expiration Date</label><br/>
                                                    <select class="form-control" id="expiration-month" name="expiration-month" style="float: left; width: 100px; margin-right: 10px;">
                                                        @foreach($months as $k=>$v)
                                                            <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>                                                        
                                                        @endforeach
                                                    </select>  
                                                    <select class="form-control" id="expiration-year" name="expiration-year"  style="float: left; width: 100px;">
                                                        
                                                        @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>            
                                                        @endfor
                                                    </select>
                                                </div> 
                                            </div>    
                                          
                                            <div class="form-group" id="pay-now">
                                                <button type="submit" class="btn btn-success themeButton" id="confirm-purchase">Confirm Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                        </div>   
                      
                           
                    </div>
                </div>
            </div>

        </div>
    </div> 
    <div class="clearfix"></div>
</section>
                


            </div>

        </div>

    </section>

   

@stop
@section("js")


@stop
@section("css")

@stop