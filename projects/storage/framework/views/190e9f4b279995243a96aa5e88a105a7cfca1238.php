
<!-- slick js file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" ></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Bootstrao 5 cdn js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- main js -->
<script type="text/javascript" src="<?php echo e(asset('front')); ?>/js/main.js"></script>

<script src="<?php echo e(asset('toastr/toastr.js')); ?>"></script>

<script>

$(document).ready(function(){
  $(".gst").click(function(){
    $("#guestsss").css("display", "block");
  });
   $(".close1").click(function(){
    $("#guestsss").css("display", "none");
  });
});
$(document).ready(function(){


    <?php if(Session::has("success")): ?>
        toastr.success("<?php echo e(Session::get('success')); ?>", 'Success',{timeOut: 60000});
    <?php endif; ?>
    <?php if(Session::has("danger")): ?>
        toastr.error("<?php echo e(Session::get('danger')); ?>", 'Error',{timeOut: 60000});
    <?php endif; ?>


});

$(document).ready(function(){
    var revealElement = $('footer .wait');
$(window).scroll(function() {
if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
$(revealElement).addClass('animate');
}else if($(revealElement).hasClass('animate') && $(window).scrollTop() + $(window).height() > $(document).height() - 150) {
 $(revealElement).removeClass('animate');
 }
});
});  


</script>
<script>
$('#reload').click(function () {
    $.ajax({
        type: 'GET',
        url: "<?php echo e(url('reload-captcha')); ?>",
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    });
});

$(document).ready(function(){
  $("#menu-toggle1").click(function(){
    $("#tag1").css("transform", "translateX(0em)");
  });
  $("#close-menu1").click(function(){
    $("#tag1").css("transform", "translateX(-38em)");
  });
});

function playVideo() {
            $('#mob').trigger('play');
        }
        function pauseVideo() {
            $('#mob').trigger('pause');
        }
        
        $(document).ready(function(){
  $("#pause").click(function(){
    $("#play").css("display", "block");
     $("#pause").css("display", "none");
  });
  $("#play").click(function(){
    $("#pause").css("display", "block");
     $("#play").css("display", "none");
  });
});


</script><?php /**PATH /home/giffvacationpoolhomes/htdocs/www.giffvacationpoolhomes.com/projects/resources/views/front/layouts/js.blade.php ENDPATH**/ ?>