<?php 
/**
 * Instagram PHP API
 *
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */
require 'api/instagram.php';
use MetzWeb\Instagram\Instagram;


$instagram 		= new Instagram('28029766d2d84253b3a4f3d1e3fa8c62');
$getUser 		= $instagram->searchUser($instagram_id, 1);
$instauserid	= $getUser->data[0]->id;

$getMedia 		= $instagram->getUserMedia($instauserid, 10);
$last10			= $getMedia->data;

$instaFeed = array();

foreach ($last10 as $i => $post)
{	
	$instaFeed[$i]['user']['user_name'] 	= $post->caption->from->username;
	$instaFeed[$i]['user']['user_photo']	= $post->caption->from->profile_picture;
	$instaFeed[$i]['post']['image_url']		= $post->images->standard_resolution->url;
	$instaFeed[$i]['post']['thumbnail_url']	= $post->images->thumbnail->url;
	$instaFeed[$i]['post']['likes'] 		= $post->likes->count;
	$instaFeed[$i]['post']['caption'] 		= $post->caption->text;
	$instaFeed[$i]['post']['tags'] 			= $post->tags;	
	$instaFeed[$i]['post']['time'] 			= date("Y/m/d H:i:s", $post->caption->created_time);	
}
?>