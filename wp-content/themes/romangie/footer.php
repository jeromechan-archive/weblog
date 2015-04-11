<?php wp_footer(); ?>
	<div class="footer row">
			<div class="col-md-3 col-md-offset-1 col-sm-4 info sidebar">
				<?php dynamic_sidebar( 'leftfooter' ); ?>
			</div>
			<div class="col-md-3 col-md-offset-1 col-sm-4 info sidebar">
				<?php dynamic_sidebar( 'middlefooter' ); ?>
			</div>
			<div class="col-md-3 col-md-offset-1 col-sm-4 info sidebar">
				<?php dynamic_sidebar( 'rightfooter' ); ?>
			</div>
	</div>	
	<div class="siteinfo row">
		<div class="col-xs-10 col-xs-offset-1">
		<p><?php printf( __( 'Copyright &copy; %1$s. Powered by <a href="%2$s">WordPress</a> &amp; <a href="%3$s">Romangie Theme</a>.'), date('Y'), 'http://www.wordpress.org/', 'http://themes.tobscore.com/romangie/'); ?></p>
		</div>
	</div>
</div> <!-- /footer -->
<?php wp_footer(); ?>

<!-- 加载jquery.lazyload plugin. added by chenjinlong -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("img").lazyload({
                "effect" : "fadeIn",
                "placeholder" : "<?php bloginfo('template_url'); ?>/images/loader.gif",
                "threshold" : 200
            }
        );
    });
</script>

<!--站长统计 BEGIN added by chenjinlong-->
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1252898702'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1252898702%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
<!--站长统计 END-->

</body>
</html>
