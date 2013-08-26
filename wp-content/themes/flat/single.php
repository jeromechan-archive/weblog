<?php get_header(); $options = get_flat_option();

// Notice: If you want to add something in post area, please add into <div class="post_content">

?>

   <?php if ($options['show_bread_crumb']) : ?>
   <div id="bread_crumb">
    <ul class="clearfix">
     <li id="bc_home"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php _e('HOME','flat'); ?>"><?php _e('HOME','flat'); ?></a></li>
     <?php if ($options['show_category']): ?><li id="bc_cat"><?php if (is_attachment()) { $parent_id = $post->post_parent; $cat = get_the_category($parent_id); echo get_category_parents($cat[0],TRUE, '', FALSE); } else { $category = get_the_category(); $ID = $category[0]->cat_ID; echo get_category_parents($ID, TRUE, '', FALSE ); }; ?></li><?php endif; ?>
     <li class="last"><?php the_title(); ?></li>
    </ul>
   </div>
   <?php endif; ?>

   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

   <div class="post_wrap clearfix" id="single">
    <div class="post">
     <h3 class="title"><span><?php the_title(); ?></span></h3>
     <div class="post_content">
      <?php the_content(__('Read more', 'flat')); ?>
      <?php wp_link_pages(); ?>
     </div><!-- END .post_content -->
    </div>
    <div class="meta">
     <?php if ($options['show_date'] or $options['show_author'] or $options['show_comment'] or $options['show_category'] or $options['show_tag']) { ?>
     <ul>
      <?php if ($options['show_date']): ?>
      <li class="post_date clearfix">
       <span class="date"><?php echo get_post_time('d'); ?></span>
       <span class="month"><?php echo get_post_time('M'); ?></span>
       <span class="year"><?php echo get_post_time('Y'); ?></span>
      </li>
      <?php endif; ?>
      <?php if ($options['show_author']): ?><li class="post_author"><?php the_author_posts_link(); ?></li><?php endif; ?>
      <?php if ($options['show_category']): ?><li class="post_category"><?php the_category('</li><li>'); ?></li><?php endif; ?>
      <?php if ($options['show_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
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

   <?php if ($options['show_next_post']): ?>
   <div id="previous_next_post_single">
    <div class="clearfix">
     <?php previous_post_link( '<p id="previous_post">%link</p>' ); ?>
     <?php next_post_link( '<p id="next_post">%link</p>' ); ?>
    </div>
   </div>
   <?php endif; ?>

<?php get_footer(); ?>