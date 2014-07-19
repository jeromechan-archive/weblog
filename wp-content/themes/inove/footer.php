	</div>
	<!-- main END -->

	<?php
		$options = get_option('inove_options');
		global $inove_nosidebar;
		if(!$options['nosidebar'] && !$inove_nosidebar) {
			get_sidebar();
		}
	?>
	<div class="fixed"></div>
</div>
<!-- content END -->

<!-- footer START -->
<div id="footer">
	<a id="gotop" href="#" onclick="MGJS.goTop();return false;"><?php _e('Top', 'inove'); ?></a>
<!--	<a id="powered" href="http://wordpress.org/">WordPress</a>-->
	<div id="copyright">
		<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'inove') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';

				echo $copyright;
				bloginfo('name');
			}
            printf(__(' | Powered by <a href="%1$s">WordPress</a> | UI Redesigned by <a href="%2$s">Jerome Chan', 'inove'), 'http://wordpress.org/','http://weblog.cn/?page_id=20');
		?>
	</div>

<!--	<div id="themeinfo">-->
<!--	</div>-->

</div>
<!-- footer END -->

</div>
<!-- container END -->
</div>
<!-- wrap END -->

<?php
	wp_footer();

	$options = get_option('inove_options');
	if ($options['analytics']) {
		echo($options['analytics_content']);
	}
?>

    <!--站长统计 BEGIN-->
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1252898702'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1252898702%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
    <!--站长统计 END-->
</body>
</html>

