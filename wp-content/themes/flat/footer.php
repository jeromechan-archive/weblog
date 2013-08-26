<?php $options = get_flat_option(); ?>



  </div><!-- END #left_col -->



  <div id="container"></div>



  <?php if(!is_page_template('page-noside.php')&&!is_page_template('page-noside-nocomment.php')) { ?>

  <div id="right_col">

   <?php get_sidebar(); ?>

  </div>

  <?php }; ?>



  <div id="footer">

   <ul id="copyright">

    <?php _e('Copyright &copy;&nbsp;2013&nbsp; ', 'flat'); ?>

<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>

    <!--<li><?php _e('Theme designed by <a class="target_blank" href="http://www.mono-lab.net/">mono-lab</a>','flat'); ?></li>

    <li class="last"><?php _e('Powered by <a class="target_blank" href="http://wordpress.org/">WordPress</a>','flat'); ?></li>-->

   </ul>

  </div>



 </div><!-- END #main_content -->





 <?php if ($options['show_return_top']) : ?>

 <p id="return_top"><a href="#header">return top</a></p>

 <?php endif; ?>



<?php wp_footer(); ?>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4418c855f31d691ab6c4e837e3a01022' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>