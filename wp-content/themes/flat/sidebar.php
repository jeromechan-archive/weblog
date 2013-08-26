<?php get_header(); $options = get_flat_option(); ?>

<?php if ($options['information_contents']) : ?>
<div id="info_area<?php if(!$options['show_search'] && !$options['show_rss'] && !$options['twitter_url'] && !$options['facebook_url']) { echo '2'; }; ?>">
 <div class="side_box clearfix" id="info_content">
  <?php if ($options['information_title']) : ?>
  <h3 class="side_title"><?php echo ($options['information_title']); ?></h3>
  <?php endif; ?>
  <div class="desc">
   <?php echo wpautop($options['information_contents']); ?>
  </div>
 </div>
</div>
<?php endif; ?>

<?php if($options['show_search'] || $options['show_rss'] || $options['twitter_url'] || $options['facebook_url']) { ?>
<div class="side_box clearfix" id="side_meta_content">

 <?php if($options['show_rss'] || $options['twitter_url'] || $options['facebook_url']) { ?>
 <ul id="social_link" class="clearfix">
  <?php if ($options['show_rss']) : ?>
  <li class="rss_button"><a class="target_blank" href="<?php bloginfo('rss2_url'); ?>">rss</a></li>
  <?php endif; ?>
  <?php if ($options['twitter_url']) : ?>
  <li class="twitter_button"><a class="target_blank" href="<?php echo $options['twitter_url']; ?>">twitter</a></li>
  <?php endif; ?>
  <?php if ($options['facebook_url']) : ?>
  <li class="facebook_button"><a class="target_blank" href="<?php echo $options['facebook_url']; ?>">facebook</a></li>
  <?php endif; ?>
 </ul>
 <?php }; ?>

 <?php if ($options['show_search']) : ?>
 <div id="search_area">
  <?php if ($options['custom_search_id']) { ?>
  <form action="http://www.google.com/cse" method="get" id="searchform">
   <div>
    <input id="search_button" class="rollover" type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" name="sa" alt="<?php _e('SEARCH','flat'); ?>" title="<?php _e('SEARCH','flat'); ?>" />
    <input type="hidden" name="cx" value="<?php echo $options['custom_search_id']; ?>" />
    <input type="hidden" name="ie" value="UTF-8" />
   </div>
   <div><input id="search_input" type="text" value="<?php _e('SEARCH','flat'); ?>" name="q" onfocus="if (this.value == '<?php _e('SEARCH','flat'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','flat'); ?>';" /></div>
  </form>
  <?php } else { ?>
  <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
   <div><input id="search_button" class="rollover" type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" alt="<?php _e('SEARCH','flat'); ?>" title="<?php _e('SEARCH','flat'); ?>" /></div>
   <div><input id="search_input" type="text" value="<?php _e('SEARCH','flat'); ?>" name="s" onfocus="if (this.value == '<?php _e('SEARCH','flat'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','flat'); ?>';" /></div>
  </form>
  <?php }; ?>
 </div>
 <?php endif; ?>

</div>
<?php }; ?>

<?php if(is_active_sidebar('top')||is_active_sidebar('bottom')||is_active_sidebar('left')||is_active_sidebar('right')){ ?>

<div id="side_top">

 <?php dynamic_sidebar('top'); ?>
</div>
<div id="side_middle" class="clearfix">
 <div id="side_left">
  <?php dynamic_sidebar('left'); ?>
 </div>
 <div id="side_right">
  <?php dynamic_sidebar('right'); ?>
 </div>
</div>
<div id="side_bottom">
 <?php dynamic_sidebar('bottom'); ?>
</div>

<?php } else { ?>

<div id="side_top">
 <div class="side_box">
  <h3 class="side_title"><?php _e('RECENT ENTRY','flat'); ?></h3>
  <ul>
   <?php $myposts = get_posts('numberposts=5'); foreach($myposts as $post) : ?>
   <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
   <?php endforeach; ?>
  </ul>
 </div>
</div>
<div id="side_middle" class="clearfix">
 <div id="side_left">
  <div class="side_box_short">
   <h3 class="side_title"><?php _e('CATEGORY','flat'); ?></h3>
   <ul>
    <?php wp_list_categories('title_li='); ?>
   </ul>
  </div>
 </div>
 <div id="side_right">
  <div class="side_box_short">
   <h3 class="side_title"><?php _e('ARCHIVES','flat'); ?></h3>
   <ul>
    <?php wp_get_archives('type=monthly'); ?>
   </ul>
  </div>
 </div>
</div><!-- END #side_middle -->
<div id="side_bottom">
 <div class="side_box">
  <h3 class="side_title"><?php _e('LINKS','flat'); ?></h3>
  <ul>
   <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
  </ul>
 </div>
</div>

<?php }; ?>