<!DOCTYPE html>
<html>
	<head>
    <?php echo $__env->make("front.layouts.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldContent("header-section"); ?>
        <?php echo ModelHelper::getDataFromSetting('google-analytics'); ?>

        <?php echo ModelHelper::getDataFromSetting('google-tag-master'); ?>

        <?php echo ModelHelper::getDataFromSetting('facebook-pixel-code'); ?>

        <?php echo ModelHelper::getDataFromSetting('other-thing-on-head'); ?>

        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PXTK4TFF');</script>
<!-- End Google Tag Manager -->
<meta name="google-site-verification" content="OF-_dxTYV8FOAeEcNDiyiBT8YmdVsVPVtksy_92l5h8" />
	</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PXTK4TFF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    

    	<?php echo ModelHelper::getDataFromSetting('after-body-open-tag'); ?>

	  <?php echo $__env->make("front.layouts.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


	  <?php echo $__env->yieldContent('container'); ?>

	<?php echo $__env->make("front.layouts.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

<?php echo $__env->yieldContent("footer-section"); ?>
    	<?php echo ModelHelper::getDataFromSetting('chat-bot'); ?>

</body>
</html><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/layouts/master.blade.php ENDPATH**/ ?>