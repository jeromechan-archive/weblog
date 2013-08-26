<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php
global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );
$site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'flat' ), max( $paged, $page ) );
?></title>
<meta name="description" content="<?php echo bloginfo('description'); ?>" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/comment-style.css" type="text/css" />
<?php if (strtoupper(get_locale()) == 'JA'): ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/japanese.css" type="text/css" />
<?php endif; ?>

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rollover.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie7.css" type="text/css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie8.css" type="text/css" />
<![endif]-->

<?php $options = get_flat_option(); ?>

<style type="text/css">
a, .post .title a:hover, .post_meta a:hover, #bread_crumb ul li a:hover, #previous_post a:hover, #next_post a:hover, .post a.more-link:hover, #right_col li a:hover, #copyright li a:hover, #archive_headline #keyword,
   #comments_wrapper a:hover, #comment_header_right .comment_switch_active a, #comment_header_right .comment_switch_active a:hover, #comment_pager .current
   { color:#<?php echo $options['pickedcolor']; ?>; }

#no_post a.back:hover, #wp-calendar td a:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, .page_navi a:hover, #submit_comment:hover
 { background-color:#<?php echo $options['pickedcolor']; ?>; }

#guest_info input:focus, #comment_textarea textarea:focus
 { border:1px solid #<?php echo $options['pickedcolor']; ?>; }

a:hover
 { color:#<?php echo $options['pickedcolor2']; ?>; }

body { font-size:<?php echo $options['content_font_size']; ?>px; }

<?php if($options['header_bg_image']||$options['pickedcolor6']) { ?>
<?php if($options['pickedcolor6']) { ?>
#header { background:#<?php echo $options['pickedcolor6']; ?>; }
<?php } else { ?>
#header { background:url(<?php esc_attr_e( $options['header_bg_image'] ); ?>) left top; }
<?php }; ?>
.logo_text a { color:#<?php echo $options['pickedcolor3']; ?>; }
#site_description {  border-top:1px solid #<?php echo $options['pickedcolor4']; ?>; color:#<?php echo $options['pickedcolor5']; ?>; }
<?php }; ?>

<?php if(is_admin_bar_showing()) { ?>
#header { top:28px; }
#main_content { top:28px; }
<?php }; ?>

</style>

</head>

<body<?php if(is_page_template('page-noside.php')||is_page_template('page-noside-nocomment.php')) { echo ' id="no_side"'; }; ?>>

 <div id="header">
  <div class="header_menu">
  <?php if (has_nav_menu('header-menu')) { ?>
  <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'header-menu' , 'container' => '' ) ); ?>
  <?php }; ?>
  </div>
  <!-- logo -->
  <?php the_dp_logo(); ?>
 </div>

 <div id="main_content" class="clearfix">

  <div id="left_col">