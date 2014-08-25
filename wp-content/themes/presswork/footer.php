<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main-wrapper ul and the #body-wrapper div.
 * Includes all the action blocks for the footer.
 *
 * @since PressWork 1.0
 */
 ?>
   	</ul> <!-- end #main-wrapper ul -->
	<footer id="footer-main" class="clearfix fl" role="contentinfo"> <!-- begin footer -->
		<?php pw_actionBlock('pw_footer'); ?>
	</footer> <!-- end footer -->
</div> <!-- end #body-wrapper -->
<?php pw_actionCall('pw_body_bottom'); ?>
<?php wp_footer(); ?>
<!-- PressWork framework created by c.bavota & Brendan Sera-Shriar - http://presswork.me -->

<!-- 加载jquery.lazyload plugin. added by chenjinlong -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/admin/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("img").lazyload({
                "effect" : "fadeIn",
                "placeholder" : "<?php bloginfo('template_url'); ?>/admin/images/loader.gif",
                "threshold" : 200
            }
        );
    });
</script>
</body>
</html>