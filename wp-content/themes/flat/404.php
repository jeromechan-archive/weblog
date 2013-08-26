<?php get_header(); $options = get_flat_option(); ?>

   <div class="post_wrap clearfix" id="no_post">
    <div class="post">
     <h3 class="title"><span><?php _e("Error 404 Not Found.","flat"); ?></span></h3>
     <div class="post_content">
      <a class="back" href="<?php echo esc_url(home_url('/')); ?>"><?php _e("RETURN HOME","flat"); ?></a>
     </div>
    </div>
    <div class="meta">
    </div>
   </div><!-- END .post_wrap -->

<?php get_footer(); ?>