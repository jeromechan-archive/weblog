<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/28/14
 * @time 8:38 PM
 * @description sitemap_gen.php
 */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.aboutcoder.com/sitemap.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);

var_dump($output);
file_put_contents('./sitemap.xml', $output);

curl_close($ch);