<?php get_header(); $options = get_flat_option(); ?>

   <?php if ( have_posts() ) : ?>

   <div id="archive_headline">
    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php if (is_category()) { ?>
    <h2><?php printf(__('Archive for the &#8216;<span id="keyword"> %s </span>&#8217; Category', 'flat'), single_cat_title('', false)); ?></h2>

    <?php } elseif( is_tag() ) { ?>
    <h2><?php printf(__('Posts Tagged &#8216;<span id="keyword"> %s </span>&#8217;', 'flat'), single_tag_title('', false) ); ?></h2>

    <?php } elseif (is_day()) { ?>
    <h2><?php printf(__('Archive for &#8216;<span id="keyword"> %s </span>&#8217;', 'flat'), get_the_time(__('F jS, Y', 'flat'))); ?></h2>

    <?php } elseif (is_month()) { ?>
    <h2><?php printf(__('Archive for &#8216;<span id="keyword"> %s </span>&#8217;', 'flat'), get_the_time(__('F, Y', 'flat'))); ?></h2>

    <?php } elseif (is_year()) { ?>
    <h2><?php printf(__('Archive for &#8216;<span id="keyword"> %s </span>&#8217;', 'flat'), get_the_time(__('Y', 'flat'))); ?></h2>

    <?php } elseif (is_author()) { ?>
    <h2><?php _e('Author Archive', 'flat'); ?></h2>

    <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h2><?php _e('Blog Archives', 'flat'); ?></h2>
    <?php } ?>
   </div><!-- END #archive_headline -->

   <?php while ( have_posts() ) : the_post(); ?>

   <div class="post_wrap clearfix">
    <div class="post">
     <h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
     <div class="post_content">
      <?php the_content(__('Read more', 'flat')); ?>
      <?php wp_link_pages(); ?>
     </div>
     <?php if ($options['show_category'] or $options['show_tag']) { ?>
     <div class="post_meta clearfix">
      <?php if ($options['show_category']): ?>
      <ul class="post-category clearfix">
       <li><?php the_category(',</li><li>'); ?></li>
      </ul>
      <?php endif; ?>
      <?php if ($options['show_tag']): ?><?php the_tags('<ul class="post-tag clearfix"><li>',',</li><li>','</li></ul>'); ?><?php endif; ?>
     </div>
     <?php }; ?>
    </div>
    <div class="meta">
     <?php if ($options['show_date'] or $options['show_author'] or $options['show_comment']) { ?>
     <ul>
      <?php if ($options['show_date']): ?>
      <li class="post_date clearfix">
       <span class="date"><?php echo get_post_time('d'); ?></span>
       <span class="month"><?php echo get_post_time('M'); ?></span>
       <span class="year"><?php echo get_post_time('Y'); ?></span>
      </li>
      <?php endif; ?>
      <?php if ($options['show_author']): ?><li class="post_author"><?php the_author_posts_link(); ?></li><?php endif; ?>
      <?php if ($options['show_comment']): ?><li class="post_comment"><?php comments_popup_link(__('Write comment', 'flat'), __('1 comment', 'flat'), __('% comments', 'flat')); ?></li><?php endif; ?>
      <?php edit_post_link(__('EDIT', 'flat'), '<li class="post_edit">', '</li>' ); ?>
     </ul>
     <?php }; ?>
    </div>
   </div>

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

   <?php if ($options['pager'] == 'pager') { ?>
   <div id="page_navi">
    <?php include('navigation.php'); ?>
   </div>
   <?php } else { ?>
   <div id="previous_next_post">
    <div class="clearfix">
     <p id="previous_post"><?php next_posts_link( __( 'Older posts', 'flat' ) ); ?></p>
     <p id="next_post"><?php previous_posts_link( __( 'Newer posts', 'flat' ) ); ?></p>
    </div>
   </div>
   <?php }; ?>

<?php get_footer(); ?>