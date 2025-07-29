
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>
	<?php
        $name=$data->title;
        $bannerImage='https://ga4prozbj7-flywheel.netdna-ssl.com/wp-content/themes/aspenhomes/dist/images/trees-bg-600x350.jpg';
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

    

    <section class="Blog-sec">

        <div class="container">

            <div class="row">


          
  <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-4 col-12">
                                <?php $date=$b->publish_date; if($date){}else{$date=$b->created_at;} ?>
                    <div class="blog">

                            <?php if($b->featureImage): ?>
                            <img src="<?php echo e(asset($b->featureImage)); ?>" alt="<?php echo e($b->title); ?>" class="img-fluid"  />
                                  <?php endif; ?>
                            <div class="content-blog">
                            <h3><?php echo e($b->title); ?></h3>
                            <p><?php echo e(Str::limit($b->shortDescription,100)); ?></p>
                            <a href="<?php echo e(url('blog/'.$b->seo_url)); ?>/" class="main-btn mt-4" role="button"> <span class="content-wrapper"> <span class="icon"><i class="fa-solid fa-arrow-right"></i></span><span class="button-text">Read More</span> </span></a>
                            </div>


                    </div>
                </div>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

         <div class="alert alert-danger">No any Blogs Found.</div>

         <?php endif; ?>

      </div>

      <div class="row"><?php echo e($blogs->links()); ?></div>




        </div>

    </section>

    

    



<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/group/category.blade.php ENDPATH**/ ?>