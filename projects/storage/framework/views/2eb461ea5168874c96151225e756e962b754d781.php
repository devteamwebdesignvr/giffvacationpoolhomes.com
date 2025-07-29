
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("css"); ?>
    <style>
        .left-sec_appr {
            width: 100%;
        }
        .sub-footer{
            display:none;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection("container"); ?>

    <?php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    ?>
 
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
    <!-- end banner sec -->

    <!-- start about section -->
        
      <!-- About Section -->
      <section class="about_wrapper management">
         <div class="container">
            <div class="row m-0">

                    <?php echo $data->mediumDescription; ?>

                    <?php echo $data->longDescription; ?>


              
            </div>
         </div>
      </section>
      
      <section class="about_wrapper pro-mg">
         <div class="container">
    <div class="row">
                <div class="col-md-6">
                    <div class="inner-container" data-aos="fade-up" data-aos-duration="1500">
                        <div class="sec-title">
                            <h3 data-aos="fade-left" data-aos-duration="1500">Feel free to contact us</h3>
                            <div class="line">  </div>
                        </div>
                        <div class="contact-form">
                            <?php echo Form::open(["route"=>"contactPost"]); ?>

                                <div class="row clearfix">
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label>Full Name *</label>
                                        <input type="text" name="name" id="form_fname" placeholder="Full name" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label>Email *</label>
                                        <input type="email" name="email" id="form_email" placeholder="Email *" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Phone *</label>
                                        <input type="number" name="mobile" id="form_phone" placeholder="Phone" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Message *</label>
                                        <textarea class="" name="message" id="msg" placeholder="Message" required=""></textarea>
                                    </div>  
                                     <?php if($setting_data['g_captcha_enabled']): ?>
                                        <?php if($setting_data['g_captcha_enabled']=="yes"): ?>
                                            <?php if($setting_data['google_captcha_site_key']!="" && $setting_data['google_captcha_secret_key']!=""): ?>
                                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <div class="g-recaptcha" data-sitekey="<?php echo e($setting_data['google_captcha_site_key']); ?>"></div>
                                             </div>  
                                             <?php endif; ?>
                                        <?php endif; ?>
                                     <?php endif; ?>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" name="submit" class="main-btn"><span class="content-wrapper">
                                    <span class="icon">
                                    <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="button-text">Send Message</span>
                                    </span></button>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inner-column" data-aos="zoom-in-left" data-aos-duration="1500">
                        <div class="image ">
                            <img src="<?php echo e(asset($data->image)); ?>" class="attachment-full size-full " alt="aboutus">
                        </div>
                    </div>
                </div>
            </div>
</div>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/static/property-management.blade.php ENDPATH**/ ?>