<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("header-section"); ?>
   <?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("css"); ?>
   <link href="<?php echo e(asset('front/royalslider.css')); ?>" rel="stylesheet">
   <link href="<?php echo e(asset('front/rs-defaulte166.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>
<?php
   $name=$data->name;
   $bannerImage=asset('front/images/internal-banner.webp');;
?>
   <style>pre{   white-space: pre-line; word-break: break-word; font-family: var(--primary-font); font-size: 16px; text-align: justify;}</style>
   <section class="page-title" style="background-image: url(<?php echo e($bannerImage); ?>);">
      <div class="auto-container">
         <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate"><?php echo e($name); ?></h1>
         <div class="checklist">
             <p>
                 <a href="<?php echo e(url('/')); ?>" class="text"><span>Home</span></a>
                 <a class="g-transparent-a"><?php echo e($name); ?></a>
             </p>
         </div>
      </div>
   </section>
   <a href="#book" class="sticky main-btn book1">BOOK NOW</a>
   <section id="property" class="padding_top padding_bottom_half">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 listing1 property-details">
               <div class="upper-box">
                   <div class="row">
                       <div class="col-lg-9 col-md-10 col-8 col-sm-8">
                           <?php $reviews=$data->reviews;?>
                           <?php if($reviews): ?>
                              <div class="rating" data-aos="fade-up" data-aos-duration="1500">
                                  <?php $reviews=json_decode($data->reviews,true);?>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <?php echo e($reviews['total'] ?? '0'); ?>+ Review
                              </div>
                           <?php endif; ?>
                           <h3 data-aos="fade-right" data-aos-duration="1500"><?php echo e($data->name); ?></h3> 
                           <div class="hotel-info d-none" data-aos="fade-up" data-aos-duration="1500">
                              <i class="fas fa-map-marker-alt"></i><?php echo e($data->address1); ?> <?php echo e($data->address2); ?>

                           </div>
                       </div>
                       <div class="col-lg-3 col-md-2 col-4 col-sm-4">
                            <div class="price" style="display:none;">
                                <?php echo $data->currency; ?><?php echo e($data->dailyRate); ?> <span>/ Night</span>
                            </div>
                       </div>
                   </div>
                    <ul class="food-list" data-aos="fade-up" data-aos-duration="1500">
                       <li><i class="fa fa-bed" aria-hidden="true"></i>  <?php echo e($data->beds); ?> Beds</li>
                       <li><i class="fa fa-home" aria-hidden="true"></i>  <?php echo e($data->bedrooms); ?> Bedrooms</li>
                       <li><i class="fa fa-bathtub" aria-hidden="true"></i>  <?php echo e($data->bathrooms); ?> Bathrooms</li>
                       <li><i class="fa fa-users" aria-hidden="true"></i>  <?php echo e($data->maxGuests); ?> Sleeps </li>
                       <li><i class="fa-solid fa-maximize pe-2"></i> Size <?php echo e($data->area_size); ?> <?php echo e(str_replace("_"," ",$data->area_unitType)); ?></li>
                   </ul>
               </div>
                 <?php 
                  $images = [];
                  $i=0;
                 /** if($data->pictureLink){
                    $images[$i]['url'] = $data->pictureLink;
                    $images[$i]['description'] = $data->name;
                  } **/
                  $imageList = App\Models\HostFully\HostFullyPropertyPhoto::where("property_uid",$data->uid)->orderBy("displayOrder","asc")->get();                  
                  if(count($imageList)>0){
                   foreach($imageList as $img){
                     $images[] = $img;
                   }
                  }
                 ?>
               <section class="blog-details-area ptb-90">
                  <div class="container-fluid" style="" id="calender_nrj">
                     <div class="row">
                        <div class="col-md-12 col-xs-12 col-lg-12  col-sm-12 main-content"style="padding-right: 0px;padding-left: 0px;">
                           <div  class="page wrapper main-wrapper">
                              <div class="row clearfix">
                                 <div class="col span_6 fwImage"style="text-align: center;">
                                    <div id="gallery-1" class="royalSlider rsDefault">
                                          <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <a class="rsImg"   data-rsBigImg="<?php echo e(asset($c['url'])); ?>" href="<?php echo e(asset($c['url'])); ?>">
                                                <img width="126" height="82" class="rsTmb" src="<?php echo e(asset($c['url'])); ?>" alt="<?php echo e($c['description']); ?>"/>
                                                <span><?php echo e($c['description']); ?></span>
                                             </a>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <?php $description=App\Models\HostFully\HostFullyPropertyDescription::where(["property_uid"=>$data->uid])->first();?>
                  <?php if($description): ?>
                  <div class="property_meta">
                     <div class="propert-box-sec">
                        <div class="tab-content">
                           <h3 class="heading-2">Overview</h3>
                        </div>
                        <hr class="hr">
                     </div>
                     <div class="overview-content">
                        <?php echo $description->summary; ?>

                     </div>
                     <div class="cta-btn" id="overview-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="overview-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                     <?php if($description->space): ?>
                       <div class="propert-box-sec mt-4">
                           <div class="tab-content">
                              <h3 class="heading-2">space</h3>
                           </div>
                           <hr class="hr">
                        </div>
                        <div class="space-content">
                        <pre><?php echo $description->space; ?></pre>
                     </div>
                       <div class="cta-btn" id="space-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="space-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                     <?php endif; ?>
                  </div>
                 <?php endif; ?>
                  <div id="amenities" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-30">
                        <div class="tab-content">
                           <h3 class="heading-2">Amenities</h3>
                        </div>
                        <hr class="hr">
                        <div class="amenities-content">
                        <div class="row">
                           <?php $__currentLoopData = App\Models\HostFully\HostFullyPropertyAmenity::where("property_uid",$data->uid)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <ul class="amenities">
                                    <li><i class="fa fa-check"></i> <?php echo e(Helper::camelCaseToSnakeCase($c1['amenity'])); ?></li>
                                 </ul>
                              </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php $__currentLoopData = App\Models\HostFully\HostFullyPropertyCustomAmenity::where("property_uid",$data->uid)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <ul class="amenities">
                                 <li><i class="fa fa-check"></i> <?php echo e($c1->name); ?></li>
                              </ul>
                           </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        </div>
                        <div class="cta-btn" id="amenities-more">
                        <a class="main-btn mt-4">Show All</a>
                     </div>
                     <div class="cta-btn" id="amenities-less">
                        <a class="main-btn mt-4">Show Less</a>
                     </div>
                     </div>
                  </div>
                  <?php if($description): ?>
                     <div class="property_meta">
                        <?php if($description->notes): ?>
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">Notes</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          
                           <div class="notes-content">
                        <pre><?php echo $description->notes; ?></pre>
                     </div>
                       <div class="cta-btn" id="notes-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="notes-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                        <?php endif; ?>
                        <?php if($description->houseManual): ?>
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">House manual</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre><?php echo $description->houseManual; ?></pre>
                        <?php endif; ?>
                        <?php if($description->access): ?>
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">Access</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre><?php echo $description->access; ?></pre>
                        <?php endif; ?>
                        <?php if($description->interaction): ?>
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">interaction</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre><?php echo $description->interaction; ?></pre>
                        <?php endif; ?>
                        <?php if($description->neighbourhood): ?>
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">neighbourhood</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre><?php echo $description->neighbourhood; ?></pre>
                        <?php endif; ?>
                     </div>
                  <?php endif; ?>
                  <div id="availability" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-40">
                        <h3 class="heading-2">Availability</h3>
                        <hr class="hr">
                     </div>
                     <div class="calender">
                         <iframe src="<?php echo e(url('fullcalendar-demo/'.$data->id)); ?>"  width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                  </div>
                   <?php if(App\Models\HostFully\HostFullyPropertyReview::where("property_uid",$data->uid)->count()>0): ?>
                     <div id="reviews" class="abouttext" style="margin-top: 30px;">
                        <div class="inside-properties mb-50">
                           <div class="tab-content">
                              <h3 class="heading-2">Review</h3>
                           </div>
                           <hr class="hr">
                           <div class="comments">
                              <div class="comment">
                                 <?php $__currentLoopData = App\Models\HostFully\HostFullyPropertyReview::where("property_uid",$data->uid)->orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="comment-content">
                                       <div class="comment-meta">
                                          <?php if($c->title): ?>
                                             <h3 style="margin-bottom: 18px;"><?php echo e($c->title); ?></h3>
                                          <?php endif; ?>
                                          <?php if($c->rating): ?>
                                             <span style="font-size: 14px;"><?php echo e($c->rating); ?>/5</span>
                                             <?php for($i=0;$i<=$c->rating;$i++): ?>
                                                <span class="fa fa-star checked"></span>
                                             <?php endfor; ?>
                                          <?php endif; ?>
                                       </div>
                                       <div class="comment-meta" style="margin-top: 18px;">
                                          <h3 style=""><?php echo e($c->author); ?></h3>
                                       </div>
                                       <p style="font-size: 14px;line-height: 20px;margin-top: 18px;"></p>
                                       <p><?php echo $c->content; ?></p>
                                       <span style="font-size: 14px;font-weight: 500;">Stayed <?php echo e(date('F Y',strtotime($c->date))); ?></span>
                                    </div>
                                    <hr class="hr">
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
               <div class="col-lg-4" id="book">
                   <div class="get-quote">
                       <?php echo $data->bookng_widget; ?>

                       
                     </div>
                  </div>
               </div>
            </div>
      </section>

<?php if($data->footer_section): ?>

     <section class="attraction-sec">
        <div class="container">
            <?php echo $data->footer_section; ?>

        </div>
    </section>
<?php endif; ?>
   <?php if($data->map): ?>
      <div class="map" id="#map">
          <iframe src="<?php echo $data->map; ?>" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
   <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>  
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="gaurav-new-modal-days-area">
        Modal body..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Additional Fee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="gaurav-new-modal-service-area">
        Modal body..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo e(asset('front/jquery.royalslider.minf76d.js')); ?>"></script> 
<script src="https://rawgit.com/jedfoster/Readmore.js/master/readmore.js"></script>
<script>
    function functiondec($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        if(val>0){
            val=val-1;
        }
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        $($show).val($show_actual_data);
        ajaxCallingData();
    }
    function functioninc($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        person2=parseInt($($cal).val());
         if((val+person2)<<?php echo e($data->maxGuests); ?>){
            val=val+1;
         }
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        $($show).val($show_actual_data);
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        ajaxCallingData();
    }

  $('.more').readmore({speed: 75, collapsedHeight:312, moreLink: '<a class="ac" href="#">Show more</a>', lessLink: '<a class="kapat" href="#">Show Less</a>', });
</script>

<script src="<?php echo e(asset('front/js/showmore.js')); ?>"></script>

<script>
   $(function(){ $(".datepicker").datepicker();});
   <?php $new_data_blocked=LiveCart::iCalDataCheckInCheckOut($data->uid);$checkin=$new_data_blocked['checkin'];$checkout=$new_data_blocked['checkout'];?>
   var checkin = <?php echo json_encode($checkin);  ?>;
   var checkout = <?php echo json_encode($checkout);  ?>;
   $(function() {
        $("#txtFrom").datepicker({
            numberOfMonths: 1,
            minDate: '@minDate',
            maxDate:"<?php echo e(date('Y-m-d', strtotime('+2 year'))); ?>",
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkin.indexOf(string) == -1];
            },
            onSelect: function(selected) {
                $("#submit-button-gaurav-data").hide();
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#txtTo").datepicker("option", "minDate", dt);
                $("#txtTo").val('');
            },
            onClose: function() {
                $("#txtTo").datepicker("show");
            }
        });

        $("#txtTo").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd', 
            maxDate:"<?php echo e(date('Y-m-d', strtotime('+2 year'))); ?>",
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkout.indexOf(string) == -1];
            },
            onSelect: function(selected) {
               var dt = new Date(selected);
               dt.setDate(dt.getDate() - 1);
               $("#txtFrom").datepicker("option", "maxDate", dt);
               ajaxCallingData();
            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });

   $("#reset-button-gaurav-data").click(function(){
      $("#txtFrom").val('');
      $("#txtTo").val('');
      $("#adults-area").val('');
      $("#child-area").val('');
      $("#adults-data").val(0);
      $("#child-data").val(0);
      $("#show-target-data").val(null);
      $("#submit-button-gaurav-data").hide();
      $("#gaurav-new-modal-days-area").html('');
      $("#gaurav-new-modal-service-area").html('');
      $("#gaurav-new-data-area").html('');
      $("#adults-data-show").html("Adult");
      $("#child-data-show").html("Child");
      $("#pet_fee_data_guarav").val(0)
      $("#txtFrom").datepicker("option", "maxDate",  '2043-10-10');
   });
                       
   <?php if(Request::get("start_date")): ?>
      <?php if(Request::get("end_date")): ?>
         $(document).ready(function(){ajaxCallingData();});     
      <?php endif; ?>
   <?php endif; ?>
    
    $(document).on("change","#pet_fee_data_guarav",function(){
        ajaxCallingData();
    });
    
    function ajaxCallingData(){
        // pet_fee_data_guarav=$("#pet_fee_data_guarav").val()
        // adults=$("#adults-data").val();
        // childs=$("#child-data").val();
        //  if($("#txtFrom").val()!=""){
        //      if($("#txtTo").val()!=""){
        //          $.post("<?php echo e(route('checkajax-get-quote')); ?>",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),pet_fee_data_guarav:pet_fee_data_guarav,adults:adults,childs:childs,book_sub:true,property_id:<?php echo e($data->id); ?>},function(data){
        //             if(data.status==400){
        //                 $("#submit-button-gaurav-data").hide();
        //                 toastr.error(data.message);
        //             }else{
        //                 $("#submit-button-gaurav-data").show();
        //                 $("#gaurav-new-modal-days-area").html(data.modal_day_view);
        //                 $("#gaurav-new-modal-service-area").html(data.modal_service_view);
        //                 $("#gaurav-new-data-area").html(data.data_view);
        //             }
        //         });
        //      }
        //  }                      
    }

   jQuery(document).ready(function($) {
      $('#gallery-1').royalSlider({
          fullscreen: {
              enabled: true,
              nativeFS: true
          },
          controlNavigation: 'thumbnails',
          autoScaleSlider: true, 
          autoScaleSliderWidth: 800,     
          autoScaleSliderHeight: 550,
          loop: true,
          imageScaleMode: 'fit-if-smaller',
          navigateByClick: true,
          numImagesToPreload:2,
          arrowsNav:true,
          arrowsNavAutoHide: true,
          arrowsNavHideOnTouch: true,
          keyboardNavEnabled: true,
          fadeinLoadedSlide: true,
          globalCaption: true,
          globalCaptionInside: false,
          thumbs: {
              appendSpan: true,
              firstMargin: true,
              paddingBottom: 4
          }
      });
      
      $('.rsContainer').on('touchmove touchend', function(){});
         
      $("#overview-more").click(function(){
         $("#overview-less").css("display", "block");
         $("#overview-more").css("display", "none");
         $(".overview-content").css("height", "100%");
      });
     
      $("#overview-less").click(function(){
         $("#overview-less").css("display", "none");
         $("#overview-more").css("display", "block");
         $(".overview-content").css("height", "230px");
      });
      if($(".overview-content").height() <= 230) {
             $("#overview-more").css("display", "none");
             $("#overview-less").css("display", "none");
        }
         else {
            $("#overview-more").css("display", "block");
            $(".overview-content").css("height", "230px");
        }
         $("#space-more").click(function(){
         $("#space-less").css("display", "block");
         $("#space-more").css("display", "none");
         $(".space-content").css("height", "100%");
      });
     
      $("#space-less").click(function(){
         $("#space-less").css("display", "none");
         $("#space-more").css("display", "block");
         $(".space-content").css("height", "265px");
      });
      if($(".space-content").height() <= 265) {
             $("#space-more").css("display", "none");
             $("#space-less").css("display", "none");
        }
         else {
            $("#space-more").css("display", "block");
            $(".space-content").css("height", "265px");
        }
        $("#amenities-more").click(function(){
         $("#amenities-less").css("display", "block");
         $("#amenities-more").css("display", "none");
         $(".amenities-content").css("height", "100%");
      });
     
      $("#amenities-less").click(function(){
         $("#amenities-less").css("display", "none");
         $("#amenities-more").css("display", "block");
         $(".amenities-content").css("height", "265px");
      });
      if($(".amenities-content").height() <= 265) {
             $("#amenities-more").css("display", "none");
        }
         else {
            $("#amenities-more").css("display", "block");
            $(".amenities-content").css("height", "265px");
        }
        $("#notes-more").click(function(){
         $("#notes-less").css("display", "block");
         $("#notes-more").css("display", "none");
         $(".notes-content").css("height", "100%");
      });
     
      $("#notes-less").click(function(){
         $("#notes-less").css("display", "none");
         $("#notes-more").css("display", "block");
         $(".notes-content").css("height", "265px");
      });
      if($(".notes-content").height() <= 265) {
             $("#notes-more").css("display", "none");
        }
         else {
            $("#notes-more").css("display", "block");
            $(".notes-content").css("height", "265px");
        }
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/property/singleHostFully.blade.php ENDPATH**/ ?>