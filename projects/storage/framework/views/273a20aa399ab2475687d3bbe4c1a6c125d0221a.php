
<footer id="foot">
        <div class="footer_overlay"></div>
        <div class="container">
            <div class="footer-upper">
               <h2>Giff Vacation Pool Homes</h2>
            </div>
             </div>
            <div class="main wait" id="main">
                 <div class="container">
                     <div class="row content-area">
                <div class="col-md-3 first">
                    <div class="footer_box">
                        <!--<h4>The group</h4>-->
                        <div class="footer-badge">
                            <img src="<?php echo e(asset('front')); ?>/images/logo1.png" alt="" class="img-fluid" />
                        </div>
                         <div class="airbnb-badge">
                           <a href="<?php echo $setting_data['AirBnb'] ?? '#'; ?>" target="_blank">
                            <img src="<?php echo e(asset('front')); ?>/images/air.png" alt="" class="img-fluid" />
                           </a>  
                        </div>
                    </div>
                </div>
                <div class="col-md-3 second">
                    <div class="footer_box">
                        <div class="footer_links">
                            <h4>Quick Links</h4>
                            <ul class="footer_link">
                                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                <li><a href="<?php echo e(url('/about-us')); ?>">About</a></li>
                                   
                                <li ><a  href="<?php echo e(url('/properties')); ?>">Rental Villas</a></li>
                                    
                                <li><a href="<?php echo e(url('/attractions')); ?>">Attractions</a></li>
                                <li><a href="<?php echo e(url('property-management')); ?>">Property Management</a></li>
                                <li class="d-none"><a href="<?php echo e(url('car-rentals')); ?>">Car Rental</a></li>
                                <li><a href="<?php echo e(url('/blogs')); ?>">Blogs</a></li>
                                <li><a href="<?php echo e(url('/contact-us')); ?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 third" >
                     <div class="footer_box">
                        <div class="footer_links">
                            <h4>Social</h4>
                           
                            <ul>
                                <li>
                                   <a href="<?php echo $setting_data['facebook'] ?? '#'; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                                </li>
                                <li>
                                   <a href="<?php echo $setting_data['instagram'] ?? '#'; ?>" target="_blank"><i class="fa-brands fa-instagram"></i> Instagram</a>
                                </li>
                                
                                <li class="d-none">
                                   <a href="<?php echo $setting_data['linkedin'] ?? '#'; ?>" target="_blank"><i class="fa-brands fa-linkedin"></i> Linkedin</a>
                                </li>
                                 <li>
                                   <a href="<?php echo $setting_data['TikTok'] ?? '#'; ?>" target="_blank"><i class="fa-brands fa-tiktok"></i> TikTok</a>
                                </li>
                            </ul>
                        
                             </div>
                    </div>
                </div>
                
                 <div class="col-md-3 fourth" >
                   
                    <div class="footer_box">
                        <div class="footer_links">
                            <h4>Find us</h4>
                            <ul class="footer_link">
                                <li><i class="fa-solid fa-location-dot"></i> <?php echo $setting_data['address'] ?? '#'; ?></li>
                                <li><a href="tel:<?php echo $setting_data['mobile'] ?? '#'; ?>"><i class="fa-solid fa-phone"></i> <?php echo $setting_data['mobile'] ?? '#'; ?></a></li>
                                <li><a href="mailto:<?php echo $setting_data['email'] ?? '#'; ?>"><i class="fa-solid fa-envelope"></i> <?php echo $setting_data['email'] ?? '#'; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
       </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left_copyright">
                            <p><?php echo $setting_data['copyright'] ?? '#'; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right_copyright">
                            <p>Designed & Developed by <a href="https://www.webdesignvr.com/" target="_blank"><img src="<?php echo e(asset('front')); ?>/images/footer_1.png" alt="" /></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


<?php echo $__env->make("front.layouts.js", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent("js"); ?>
<?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/layouts/footer.blade.php ENDPATH**/ ?>