<?php get_header(); $options = get_flat_option(); ?>

   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

   <div class="post_wrap clearfix">
    <div class="post">
     <h3 class="title"><span><?php the_title(); ?></span></h3>
     <div class="post_content">
      <?php the_content(__('Read more', 'flat')); ?>
      <?php wp_link_pages(); ?>
     </div>
    </div>
    <div class="meta">
     <?php if ($options['show_date'] or $options['show_comment']) { ?>
     <ul>
      <?php if ($options['show_comment']): ?><li class="post_comment"><?php comments_popup_link(__('Write comment', 'flat'), __('1 comment', 'flat'), __('% comments', 'flat')); ?></li><?php endif; ?>
      <?php edit_post_link(__('EDIT', 'flat'), '<li class="post_edit">', '</li>' ); ?>
     </ul>
     <?php }; ?>
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

   <?php if ($options['show_comment']): ?>
   <div id="comments_wrapper">
    <?php if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); } ?>
   </div>
   <?php endif; ?>

<?php get_footer(); ?>