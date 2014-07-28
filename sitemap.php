<?php
/**
 * Copyright © 2014 Tuniu Inc. All rights reserved.
 *
 * @author chenjinlong
 * @date 7/28/14
 * @time 7:41 PM
 * @description sitemap.php
 */
?>
<?php require('wp-blog-header.php');
header('Content-type: text/xml; charset=' . get_settings('blog_charset'), true);?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!-- generator="http://www.socialpatterns.com/"-->
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84
http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
    <url>
        <loc><?php bloginfo('url') ?></loc>
        <lastmod><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false); ?></lastmod>
        <changefreq>always</changefreq>
        <priority>1.0</priority>
    </url>
    <?php $sitemap = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' ORDER by post_modified DESC"); ?>
    <?php foreach ($sitemap as $sitemap) { ?>
        <url>
            <loc><?php echo get_permalink($sitemap->ID); ?></loc>
            <lastmod><?php echo mysql2date('Y-m-d\TH:i:s\Z', $sitemap->post_modified, false); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    <?php } ?>
</urlset>