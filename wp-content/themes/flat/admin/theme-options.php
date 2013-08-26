<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array 
 */
global $flat_default_options;
$flat_default_options = array(
	'pickedcolor' => '00A19E',
	'pickedcolor2' => 'BDC900',
	'content_font_size' => '12',
	'show_author' => 0,
	'show_category' => 1,
	'show_tag' => 1,
	'show_date' => 1,
	'show_comment' => 1,
	'show_comment_time' => 1,
	'show_next_post' => 1,
	'show_return_top' => 1,
	'show_bread_crumb' => 1,
	'show_search' => 1,
	'show_rss' => 1,
	'show_site_desc' => 1,
        'information_title' => 'INFORMATION',
        'information_contents' => __('Change this sentence and title from admin Theme option page.', 'flat'),
	'pager'  => 'pager',
	'twitter_url' => '',
	'facebook_url' => '',
	'custom_search_id' => '',
	'logotop' => 0,
	'logoleft' => 0,
	'header_bg_image' => false,
	'pickedcolor3' => '00A19E',
	'pickedcolor4' => 'BBBBBB',
	'pickedcolor5' => '888888',
	'pickedcolor6' => ''
);

/**
 * テーマオプションを返す
 * @global array $flat_default_options
 * @return array 
 */
function get_flat_option(){
	global $flat_default_options;
	return shortcode_atts($flat_default_options, get_option('flat_options', array()));
}


// javascriptの読み込み
add_action('admin_print_scripts', 'my_admin_print_scripts');
function my_admin_print_scripts() {
  wp_enqueue_script('jscolor', get_template_directory_uri().'/admin/jscolor.js');
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/jquery.cookieTab.js');
}



// 画像アップロードの準備
function wp_gear_manager_admin_scripts() {
wp_enqueue_script('flat-image-manager', get_template_directory_uri().'/admin/image-manager.js', array('jquery', 'jquery-ui-draggable', 'imgareaselect'));
}
function wp_gear_manager_admin_styles() {
wp_enqueue_style('imgareaselect');
}
add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



// 登録
function theme_options_init(){
 register_setting( 'flat_options', 'flat_options', 'theme_options_validate' );
}


// ロード
function theme_options_add_page() {
 add_theme_page( __( 'Theme Options', 'flat' ), __( 'Theme Options', 'flat' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


/**
 * ラジオボックスの初期設定
 * @var array 
 */
global $pager_options;
$pager_options = array(
 'pager' => array(
  'value' => 'pager',
  'label' => __( 'Use pager', 'flat' ),
  'img' => 'pager'
 ),
 'normal_link' => array(
  'value' => 'normal_link',
  'label' => __( 'Use normal link', 'flat' ),
  'img' => 'normal_link'
 )
);




// テーマオプション画面の作成
function theme_options_do_page() {
 global $pager_options, $monolab_upload_error;
 $options = get_flat_option(); 

 if ( ! isset( $_REQUEST['settings-updated'] ) )
  $_REQUEST['settings-updated'] = false;

  // TinyMCEの準備
  wp_enqueue_script( 'common' );
  wp_enqueue_script( 'jquery-color' );
  wp_print_scripts('editor');
  if (function_exists('add_thickbox')) add_thickbox();
  wp_print_scripts('media-upload');
  if (function_exists('wp_tiny_mce')) wp_tiny_mce();
  wp_admin_css();
  wp_enqueue_script('utils');
  do_action("admin_print_styles-post-php");
  do_action('admin_print_styles');


?>

<div class="wrap">
 <?php screen_icon(); echo "<h2>" . __( 'Theme Options', 'flat' ) . "</h2>"; ?>

 <?php // 更新時のメッセージ
       if ( false !== $_REQUEST['settings-updated'] ) :
 ?>
 <div class="updated fade"><p><strong><?php _e('Updated', 'flat');  ?></strong></p></div>
 <?php endif; ?>

 <?php /* ファイルアップロード時のメッセージ */ if(!empty($monolab_upload_error['message'])): ?>
  <?php if($monolab_upload_error['error']): ?>
   <div id="error" class="error"><p><?php echo $monolab_upload_error['message']; ?></p></div>
  <?php else: ?>
   <div id="message" class="updated fade"><p><?php echo $monolab_upload_error['message']; ?></p></div>
  <?php endif; ?>
 <?php endif; ?>
 
 <script type="text/javascript">
  jQuery(document).ready(function($){
   $('#my_theme_option').cookieTab({
    tabMenuElm: '#theme_tab',
    tabPanelElm: '#tab-panel'
   });
  });
 </script>

 <div id="my_theme_option">

 <div id="theme_tab_wrap">
  <ul id="theme_tab" class="cf">
   <li><a href="#tab-content1"><?php _e('Basic Setup', 'flat');  ?></a></li>
   <li><a href="#tab-content2"><?php _e('Logo', 'flat');  ?></a></li>
   <li><a href="#tab-content3"><?php _e('Header image', 'flat');  ?></a></li>
  </ul>
 </div>

<form method="post" action="options.php" enctype="multipart/form-data">
 <?php settings_fields( 'flat_options' ); ?>

 <div id="tab-panel">

  <!-- #tab-content1 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content1">

   <?php // サイトカラー ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Site main color', 'flat');  ?></h3>
    <div class="theme_option_input">
     <input type="text" class="color" name="flat_options[pickedcolor]" value="<?php esc_attr_e( $options['pickedcolor'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color"><?php _e('Default color', 'flat');  ?> ：00A19E</p>
   </div>

   <?php // サイトカラー２ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Site secondary color', 'flat');  ?></h3>
    <p><?php _e('We use this color for link hover effect.', 'flat');  ?></p>
    <div class="theme_option_input">
     <input type="text" class="color" name="flat_options[pickedcolor2]" value="<?php esc_attr_e( $options['pickedcolor2'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color2"><?php _e('Default color', 'flat');  ?> ：BDC900</p>
   </div>

   <?php // フォントサイズ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font size', 'flat');  ?></h3>
    <p><?php _e('Font size of single post and wp-page.', 'flat');  ?></p>
    <div class="theme_option_input">
     <input id="flat_options[content_font_size]" class="font_size" type="text" name="flat_options[content_font_size]" value="<?php esc_attr_e( $options['content_font_size'] ); ?>" /><span>px</span>
    </div>
   </div>

   <?php // 投稿者名・タグ・コメント ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display Setup', 'flat');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li><label><input id="flat_options[show_author]" name="flat_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?> /> <?php _e('Display author name', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_category]" name="flat_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?> /> <?php _e('Display category', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_tag]" name="flat_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_tag'] ); ?> /> <?php _e('Display tags', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_date]" name="flat_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?> /> <?php _e('Display date', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_comment]" name="flat_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /> <?php _e('Display comment', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_comment_time]" name="flat_options[show_comment_time]" type="checkbox" value="1" <?php checked( '1', $options['show_comment_time'] ); ?> /> <?php _e('Display comment time', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_next_post]" name="flat_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /> <?php _e('Display next previous post link at single page', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_bread_crumb]" name="flat_options[show_bread_crumb]" type="checkbox" value="1" <?php checked( '1', $options['show_bread_crumb'] ); ?> /> <?php _e('Display breadcrumb at single page', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_return_top]" name="flat_options[show_return_top]" type="checkbox" value="1" <?php checked( '1', $options['show_return_top'] ); ?> /> <?php _e('Display return top link  at bottom of the page', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_search]" name="flat_options[show_search]" type="checkbox" value="1" <?php checked( '1', $options['show_search'] ); ?> /> <?php _e('Display search form at sidebar', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_rss]" name="flat_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?> /> <?php _e('Display rss at sidebar', 'flat');  ?></label></li>
      <li><label><input id="flat_options[show_site_desc]" name="flat_options[show_site_desc]" type="checkbox" value="1" <?php checked( '1', $options['show_site_desc'] ); ?> /> <?php _e('Display site description under site title', 'flat');  ?></label></li>
     </ul>
    </div>
   </div>

   <?php // サイドのインフォメーションエリア ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Side information setting', 'flat');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Please make this field blank if you don\'t want to display at the site.', 'flat');  ?></p>
     <div style="margin:0 0 5px 0;">
      <label style="display:inline-block; min-width:140px;"><?php _e('Title of information area', 'flat');  ?></label>
      <input id="flat_options[information_title]" class="regular-text" type="text" name="flat_options[information_title]" value="<?php esc_attr_e( $options['information_title'] ); ?>" />
     </div>
     <div id="poststuff" style="margin:0 0 15px 0;">
      <?php the_editor(stripslashes( $options['information_contents'] ), $id = 'flat_options[information_contents]', $class = 'large-text' ); ?>
     </div>
    </div>
   </div>

   <?php // ページナビの種類 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Pager type', 'flat');  ?></h3>
    <div class="theme_option_input pager_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Pager type', 'flat');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $pager_options as $option ) {
          $pager_setting = $options['pager'];
           if ( '' != $pager_setting ) {
            if ( $options['pager'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="flat_options[pager]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php bloginfo('template_url'); ?>/admin/<?php echo $option['img']; ?>.gif" alt="" title="" />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>

   <?php // facebook twitter ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('twitter and facebook setup', 'flat');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('When it is blank, twitter and facebook icon will not displayed on a site.', 'flat');  ?></p>
     <ul>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your twitter URL', 'flat');  ?></label>
       <input id="flat_options[twitter_url]" class="regular-text" type="text" name="flat_options[twitter_url]" value="<?php esc_attr_e( $options['twitter_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your facebook URL', 'flat');  ?></label>
       <input id="flat_options[facebook_url]" class="regular-text" type="text" name="flat_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

   <?php // 検索の設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Using Google custom search', 'flat');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you want to use google custom search for your wordpress, enter your google custom search ID.<br /><a href="http://www.google.com/cse/" target="_blank">Read more about Google custom search page.</a>', 'flat');  ?></p>
     <label style="display:inline-block; margin:0 20px 0 0;"><?php _e('Google custom search ID', 'flat');  ?></label>
     <input id="flat_options[custom_search_id]" class="regular-text" type="text" name="flat_options[custom_search_id]" value="<?php esc_attr_e( $options['custom_search_id'] ); ?>" />
    </div>
   </div>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'flat' ); ?>" /></p>

  </div><!-- END #tab-content1 -->




  <!-- #tab-content2 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content2">

   <?php // ステップ１ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 1 : Upload image to use for logo.', 'flat');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Upload image to use for logo from your computer.<br />You can resize your logo image in step 2 and adjust position in step 3.', 'flat');  ?></p>
     <div class="button_area">
      <label for="dp_image"><?php _e('Select image to use for logo from your computer.', 'flat');  ?></label>
      <input type="file" name="dp_image" id="dp_image" value="" />
      <input type="submit" class="button" value="<?php _e('Upload', 'flat');  ?>" />
     </div>
     <?php if(dp_logo_exists()): $info = dp_logo_info(); ?>
     <div class="uploaded_logo">
      <h4><?php _e('Uploaded image.', 'flat');  ?></h4>
      <div class="uploaded_logo_image" id="original_logo_size">
       <?php dp_logo_img_tag(false, '', '', 9999); ?>
      </div>
      <p><?php printf(__('Original image size : width %1$dpx, height %2$dpx', 'flat'), $info['width'], $info['height']); ?></p>
     </div>
     <?php else: ?>
     <div class="uploaded_logo">
      <h4><?php _e('The image has not been uploaded yet.<br />A normal text will be used for a site logo.', 'flat');  ?></h4>
     </div>
     <?php endif; ?>
    </div>
   </div>

   <?php // ステップ２ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 2 : Resize uploaded image.', 'flat');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('You can resize uploaded image.<br />If you don\'t need to resize, go to step 3.', 'flat');  ?></p>
     <div class="uploaded_logo">
      <h4><?php _e('Please drag the range to cut off.', 'flat');  ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_resize_base(9999); ?>
      </div>
      <div class="resize_amount">
       <label><?php _e('Ratio', 'flat');  ?>: <input type="text" name="dp_resize_ratio" id="dp_resize_ratio" value="100" />%</label>
       <label><?php _e('Width', 'flat');  ?>: <input type="text" name="dp_resized_width" id="dp_resized_width" />px</label>
       <label><?php _e('Height', 'flat');  ?>: <input type="text" name="dp_resized_height" id="dp_resized_height" />px</label>
      </div>
      <div id="resize_button_area">
       <input type="submit" class="button-primary" value="<?php _e('Resize', 'flat'); ?>" />
      </div>
     </div>
     <?php if($info = dp_logo_info(true)): ?>
     <div class="uploaded_logo">
      <h4><?php printf(__('Resized image : width %1$dpx, height %2$dpx', 'flat'), $info['width'], $info['height']); ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_img_tag(true, '', '', 9999); ?>
      </div>
     </div>
     <?php endif; ?>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // ステップ３ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 3 : Adjust position of logo.', 'flat');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('Drag the logo image and adjust the position.', 'flat');  ?></p>
     <div id="flat-logo-adjuster" class="ratio-<?php echo '1000-1000'; ?>">
      <?php if(dp_logo_resize_tag(1000, 1000, $options['logotop'], $options['logoleft'])): ?>
      <?php else: ?>
      <span><?php _e('Logo size is too big. Please resize your logo image.', 'flat');  ?></span>
      <?php endif; ?>
     </div>
     <div class="hide">
      <label><?php _e('Top', 'flat');  ?>: <input type="text" name="flat_options[logotop]" id="dp-options-logotop" value="<?php esc_attr_e( $options['logotop'] ); ?>" />px </label>
      <label><?php _e('Left', 'flat');  ?>: <input type="text" name="flat_options[logoleft]" id="dp-options-logoleft" value="<?php esc_attr_e( $options['logoleft'] ); ?>" />px </label>
      <input type="button" class="button" id="dp-adjust-realvalue" value="adjust" />
     </div>
     <p><input type="submit" class="button" value="<?php _e('Save the position', 'flat');  ?>" /></p>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // 画像の削除 ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Delete logo image.', 'flat');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you delete the logo image, normal text will be used for a site logo.', 'flat');  ?></p>
     <p><a class="button" href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_image_'.  get_current_user_id()); ?>" onclick="if(!confirm('<?php _e('Are you sure to delete logo image?', 'flat'); ?>')) return false;"><?php _e('Delete Image', 'flat');  ?></a></p>
    </div>
   </div>
   <?php endif; ?>

  </div><!-- END #tab-content2 -->




  <!-- #tab-content3 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content3">

   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Register header background image or select background color', 'flat');  ?></h3>
    <div class="image_box cf">

     <?php if($options['pickedcolor6']||$options['header_bg_image']) { echo '<div class="hide">'; }; ?>
     <div class="header_bg_image_color">
      <h4><?php _e('Background Image', 'flat');  ?></h4>
      <div class="hide"><input type="text" size="36" name="flat_options[header_bg_image]" value="<?php esc_attr_e( $options['header_bg_image'] ); ?>" /></div>
      <input type="file" name="header_bg_image_file" id="header_bg_image_file" />
      <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
     </div>
     <?php if($options['pickedcolor6']||$options['header_bg_image']) { echo '</div>'; }; ?>

     <?php if($options['header_bg_image']) { echo '<div class="hide">'; }; ?>
     <div class="header_bg_image_color">
      <h4><?php _e('Background Color', 'flat');  ?></h4>
      <input type="text" id="color6" class="color {required:false}" name="flat_options[pickedcolor6]" value="<?php esc_attr_e( $options['pickedcolor6'] ); ?>" />
      <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
      <?php if($options['pickedcolor6']) { ?>
      <p><?php _e('Make this field blank to delete background color.', 'flat'); ?></p>
      <?php  }; ?>
     </div>
     <?php if($options['header_bg_image']) { echo '</div>'; }; ?>

     <?php if($options['header_bg_image']||$options['pickedcolor6']) { ?>
      <style type="text/css">
       <?php if($options['pickedcolor6']){ ?>
       #header_bg_image { background:#<?php esc_attr_e( $options['pickedcolor6'] ); ?>; }
       <?php } elseif($options['header_bg_image']) { ?>
       #header_bg_image { background:url(<?php esc_attr_e( $options['header_bg_image'] ); ?>) left top; }
       <?php }; ?>
       .logo_text a { color:#<?php esc_attr_e( $options['pickedcolor3'] ); ?>; }
       #site_description {  border-top:1px solid #<?php esc_attr_e( $options['pickedcolor4'] ); ?>; color:#<?php esc_attr_e( $options['pickedcolor5'] ); ?>; }
      </style>
      <div id="header_bg_area">
       <div id="header_bg_wrap">
        <?php the_dp_logo(); ?>
        <div id="header_bg_image"></div>
       </div>
      </div>
      <?php if(dp_is_uploaded_img($options['header_bg_image'])){ ?>
      <div class="delete_uploaded_banner_image">
       <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_header_bg_image') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
      </div>
      <?php }; ?>
     <?php }; ?>

    </div>
   </div>

   <?php if($options['pickedcolor6']) { ?>
   <script type="text/javascript">
    jQuery(function($){
     $("#color6").change(function(){
      var color6 = $('#color6').val();
      $('#header_bg_image').css("background-color",'#'+color6);
     });
     $("#color3").change(function(){
      var color3 = $('#color3').val();
      $('.logo_text a').css("color",'#'+color3);
     });
     $("#color4").change(function(){
      var color4 = $('#color4').val();
      $('#site_description').css("border-color",'#'+color4);
     });
     $("#color5").change(function(){
      var color5 = $('#color5').val();
      $('#site_description').css("color",'#'+color5);
     });
    });
   </script>
   <?php }; ?>

   <?php if(!$options['header_bg_image'] and !$options['pickedcolor6']) { echo '<div class="hide">'; }; ?>
   <?php // サイトカラー３ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Logo text color', 'flat');  ?></h3>
    <div class="theme_option_input">
     <input type="text" id="color3" class="color" name="flat_options[pickedcolor3]" value="<?php esc_attr_e( $options['pickedcolor3'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color"><?php _e('Default color', 'flat');  ?> ：00A19E</p>
   </div>

   <?php // サイトカラー４ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Border color', 'flat');  ?></h3>
    <div class="theme_option_input">
     <input type="text" id="color4" class="color" name="flat_options[pickedcolor4]" value="<?php esc_attr_e( $options['pickedcolor4'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color3"><?php _e('Default color', 'flat');  ?> ：BBBBBB</p>
   </div>

   <?php // サイトカラー５ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Description text color', 'flat');  ?></h3>
    <div class="theme_option_input">
     <input type="text" id="color5" class="color" name="flat_options[pickedcolor5]" value="<?php esc_attr_e( $options['pickedcolor5'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'flat' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color4"><?php _e('Default color', 'flat');  ?> ：888888</p>
   </div>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'flat' ); ?>" /></p>
   <?php if(!$options['header_bg_image'] and !$options['pickedcolor6']) { echo '</div>'; }; ?>

  </div><!-- END #tab-content3 -->


  </div><!-- END #tab-panel -->

 </form>

</div>

</div>

<?php

 }


/**
 * チェック
 */
function theme_options_validate( $input ) {
 global $pager_options;

 // 色の設定
 $input['pickedcolor'] = wp_filter_nohtml_kses( $input['pickedcolor'] );
 $input['pickedcolor2'] = wp_filter_nohtml_kses( $input['pickedcolor2'] );
 $input['pickedcolor3'] = wp_filter_nohtml_kses( $input['pickedcolor3'] );
 $input['pickedcolor4'] = wp_filter_nohtml_kses( $input['pickedcolor4'] );
 $input['pickedcolor5'] = wp_filter_nohtml_kses( $input['pickedcolor5'] );
 $input['pickedcolor6'] = wp_filter_nohtml_kses( $input['pickedcolor6'] );

 // フォントサイズ
 $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );

 // 項目の表示設定
 if ( ! isset( $input['show_author'] ) )
  $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_category'] ) )
  $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_tag'] ) )
  $input['show_tag'] = null;
  $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_comment'] ) )
  $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_comment_time'] ) )
  $input['show_comment_time'] = null;
  $input['show_comment_time'] = ( $input['show_comment_time'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_date'] ) )
  $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_bread_crumb'] ) )
  $input['show_bread_crumb'] = null;
  $input['show_bread_crumb'] = ( $input['show_bread_crumb'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_return_top'] ) )
  $input['show_return_top'] = null;
  $input['show_return_top'] = ( $input['show_return_top'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_next_post'] ) )
  $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_search'] ) )
  $input['show_search'] = null;
  $input['show_search'] = ( $input['show_search'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_rss'] ) )
  $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_site_desc'] ) )
  $input['show_site_desc'] = null;
  $input['show_site_desc'] = ( $input['show_site_desc'] == 1 ? 1 : 0 );

 // ページナビの設定
 if ( ! isset( $input['pager'] ) )
  $input['pager'] = null;
 if ( ! array_key_exists( $input['pager'], $pager_options ) )
  $input['pager'] = null;

 // twitter,facebook URL
 $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );

 // 検索の設定
 $input['custom_search_id'] = wp_filter_nohtml_kses( $input['custom_search_id'] );

 // サイドのインフォメーションエリア
 $input['information_title'] = wp_filter_post_kses( $input['information_title'] );
 $input['information_contents'] = $input['information_contents'];

 //ロゴの位置
 if(isset($input['logotop'])){
	 $input['logotop'] = intval($input['logotop']);
 }
 if(isset($input['logoleft'])){
	 $input['logoleft'] = intval($input['logoleft']);
 }

 // ヘッダーの背景画像
 $input['header_bg_image'] = wp_filter_nohtml_kses( $input['header_bg_image'] );

 //ファイルアップロード
 if(isset($_FILES['dp_image'])){
	$message = _dp_upload_logo();
	add_settings_error('flat_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //画像リサイズ
 if(isset($_REQUEST['dp_logo_resize_left'], $_REQUEST['dp_logo_resize_top']) && is_numeric($_REQUEST['dp_logo_resize_left']) && is_numeric($_REQUEST['dp_logo_resize_top'])){
	$message = _dp_resize_logo();
	add_settings_error('flat_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //背景画像の登録
	 if(isset($_FILES['header_bg_image_file'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['header_bg_image_file']['error'] === 0){
			 $name = sanitize_file_name($_FILES['header_bg_image_file']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('flat_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'flat'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['header_bg_image_file']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['header_bg_image'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'flat'), dp_logo_basedir()), 'error');
				}
			 }
		 }elseif($_FILES['header_bg_image_file']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['header_bg_image_file']['error']), 'error');
		 }
	 }

 return $input;
}

?>