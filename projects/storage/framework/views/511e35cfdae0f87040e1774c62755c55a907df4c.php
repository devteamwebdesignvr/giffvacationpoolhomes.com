
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("logo",$data->image); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>

    <?php
        $name=$data->name;
        $bannerImage=asset('front/images/b1.jpg');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    ?>
	<!-- start banner sec -->

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

    <section class="contact-page-section">
        <div class="container">
            <div class="row">
                <!-- Contact Info Box -->
                <div class="contact-info-box col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1500">
                    <div class="box-inner">
                        <h5>Address</h5>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo $setting_data['address'] ?? '#'; ?></p>
                    </div>
                </div>
                <div class="contact-info-box col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1500">
                    <div class="box-inner">
                        <h5>Phone</h5>
                        <p><i class="fa-solid fa-phone"></i><a href="tel:<?php echo $setting_data['mobile'] ?? '#'; ?>"> <?php echo $setting_data['mobile'] ?? '#'; ?></a></p>
                    </div>
                </div>
                <div class="contact-info-box col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="1500">
                    <div class="box-inner">
                        <h5>Email address</h5>
                        <p><i class="fa-solid fa-envelope"></i><a href="mailto:<?php echo $setting_data['email'] ?? '#'; ?>"> <?php echo $setting_data['email'] ?? '#'; ?></a></p>
                    </div>
                </div>
            </div>
            <!-- Sec Title -->
            <div class="row mt-md-5">
                <div class="col-md-6">
                    <div class="inner-container" data-aos="fade-up" data-aos-duration="1500">
                        <div class="sec-title">
                            <h3 data-aos="fade-left" data-aos-duration="1500">Feel free to contact us</h3>
                            <div class="line">  </div>
                        </div>
                        <div class="contact-form">
                            <?php if(Session::has("success1")): ?>
                                <div class="alert alert-success" id="success-message"><?php echo e(Session::get("success1")); ?></div>
                                <br />
                            <?php endif; ?>
                            <?php if(Session::has("danger1")): ?>
                                <div class="alert alert-danger" id="error-message"><?php echo e(Session::get("danger1")); ?></div>
                                <br />
                            <?php endif; ?>
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
                                        <input type="text" name="mobile" id="form_phone" placeholder="Phone" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Message *</label>
                                        <textarea class="" name="message" id="msg" placeholder="Message" required=""></textarea>
                                    </div>  
                                      <div class="form-group mt-4 mb-4">
                                            <div class="captcha">
                                                <span><?php echo captcha_img(); ?></span>
                                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                                    &#x21bb;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                        </div>
                                         <?php if($errors->has('captcha')): ?>
                                              <div class="text-danger">
                                                  <strong><?php echo e($errors->first('captcha')); ?></strong>
                                              </div>
                                          <?php endif; ?>
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
                                        <button type="submit" name="submit" class="main-btn"> <span class="content-wrapper"> <span class="icon"> <i class="fa-solid fa-arrow-right"></i></span> <span class="button-text">Send Message</span> </span></span></button>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-map" data-aos="fade-up" data-aos-duration="1500">
                        <iframe src="<?php echo $setting_data['map'] ?? '#'; ?>" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


  
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<script>
    $(function(){
        $("#reload").click();
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/static/contact.blade.php ENDPATH**/ ?>