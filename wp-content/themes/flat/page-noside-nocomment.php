<?php
/*
Template Name:No sidebar no comment
*/
?>
<?php get_header(); $options = get_flat_option(); ?>

   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

   <div class="post_wrap clearfix" id="no_comment_page">
    <div class="post">
     <h3 class="title"><span><?php the_title(); ?></span></h3>
     <div class="post_content">
      <?php the_content(__('Read more', 'flat')); ?>
      <?php wp_link_pages(); ?>
     </div>
    </div>
    <div class="meta">
     <ul>
      <?php edit_post_link(__('EDIT', 'flat'), '<li class="post_edit">', '</li>' ); ?>
     </ul>
    </div>
   </div><!-- END .post_wrap -->

   <?php endwhile; else: ?>

   <div class="post_wrap clearfix" id="no_post">
    <div class="post">
     <h3 class="title"><?php _e("Sorry, but you are looking for something that isn't here.","flat"); ?></h3>
     <div class="post_content">
      <a class="back" href="<?php echo esc_url(home_url('/')); ?>"><?php _e("RETURN HOME","flat"); ?></a>
     </div>
    </div>
    <div class="meta">
    </div>
   </div>

   <?php endif; ?>

<?php get_footer(); ?>