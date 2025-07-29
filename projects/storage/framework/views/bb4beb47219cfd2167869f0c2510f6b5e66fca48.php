
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
        if($data->image){
            $bannerImage=asset($data->image);
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





    <section class="Blog-details">

        <div class="container">
            <div class="blog-info">
           <h2><?php echo e($data->title); ?></h2>

           <img src="<?php echo e(asset($data->featureImage)); ?>" class="img-fluid" alt="" />
              <div class="feat_blog_con">

                        <p>

                            <span><i class="fas fa-calendar-alt" aria-hidden="true"></i> <?php echo e(date('d M Y',strtotime($data->created_at))); ?></span>



                            &nbsp;&nbsp;

                            <?php $category=App\Models\Blogs\BlogCategory::where("id",$data->blog_category_id)->first(); ?>

                            <?php if($category): ?>

                            <span><i class="fas fa-globe" aria-hidden="true"></i><a href="<?php echo e(url('blogs/category/'.$category->seo_url)); ?>/"> <?php echo e($category->title); ?></a></span>

                            <?php endif; ?>

                        </p>

                      </div>
            <?php echo $data->longDescription; ?>

            </div>
        </div>

    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/group/single.blade.php ENDPATH**/ ?>