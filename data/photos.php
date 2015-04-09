<?php
/**
 * Created by PhpStorm.
 * User: dom
 * Date: 2/28/15
 * Time: 7:13 PM
 */
require_once 'instagram.class.php';
require_once '/usr/share/php/instagram/config.php';

$instagram = new Instagram(API_KEY);
$tag = 'jackieanddomgethitched';
$limit = 20;

// Get latest photos according to #hashtag keyword
$media = $instagram->getTagMedia($tag, 25);

if (sizeof($media->data) < 10){
    $limit = sizeof($media->data);
}

$i = 0;
$images = array();
foreach ($media->data as $post){
    $images[] = $post->images->standard_resolution->url;
}

echo json_encode($images);
exit;
