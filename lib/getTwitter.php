<?php
require_once('api/twitter.php');
	$settings	= array(
		'oauth_access_token'		=> "562399084-GhQP4ZEoatu7eAdZJjaRRn7cjoQTNvTjc4vxbfuV",
		'oauth_access_token_secret' => "iyOUvlZ8FV82E1jvj2cYMxEm6zhfaeA5rH8je5aXnTd2w",
		'consumer_key' 				=> "OdalChSj6xVPBTV6a5e3reLBC",
		'consumer_secret' 			=> "80MfIeCcRk3eahzvE1WNjFBzW9By31mvZ0rvpgroC6nVesqQgU"
	);
	$url			= 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield 		= '?screen_name='.$twitter_id.'&count=10';
	$requestMethod 	= 'GET';
	$twitter 		= new TwitterAPIExchange($settings);
	$twitterRes		= $twitter->setGetfield($getfield)
             				  ->buildOauth($url, $requestMethod)
             				  ->performRequest();

	$twitterRes = json_decode($twitterRes);
	$twitterFeed= array();
	
	foreach ($twitterRes as $i => $tweet)
	{	
		if (array_key_exists("retweeted_status", $tweet)){ 		//checks if the Tweet is a retweet.  If so, use original publisher's info
			$twitterFeed[$i]['user']['name'] 		= $tweet->retweeted_status->user->name;
			$twitterFeed[$i]['user']['screen_name'] = $tweet->retweeted_status->user->screen_name;
			$twitterFeed[$i]['user']['user_photo']	= $tweet->retweeted_status->user->profile_image_url;
			
			$twitterFeed[$i]['tweet']['id']			= $tweet->retweeted_status->id;
			$twitterFeed[$i]['tweet']['tweet']		= $tweet->retweeted_status->text;
			$twitterFeed[$i]['tweet']['time'] 		= date("Y/m/d H:i:s", strtotime($tweet->retweeted_status->created_at));
			
			if (array_key_exists("media",$tweet->retweeted_status->entities ))
			{
				foreach ($tweet->retweeted_status->entities->media as $photo)
				{
					$twitterFeed[$i]['tweet']['image'] = $photo->media_url;
				}
			}
			else
			{
				$twitterFeed[$i]['tweet']['image'] = null;
			}			
		}
		else
		{
			$twitterFeed[$i]['user']['name'] 		= $tweet->user->name;
			$twitterFeed[$i]['user']['screen_name'] = $tweet->user->screen_name;
			$twitterFeed[$i]['user']['user_photo']	= $tweet->user->profile_image_url;
			
			$twitterFeed[$i]['tweet']['id']			= $tweet->id;
			$twitterFeed[$i]['tweet']['tweet']		= $tweet->text;
			$twitterFeed[$i]['tweet']['time'] 		= date("Y/m/d H:i:s", strtotime($tweet->created_at));
			
			if (array_key_exists("media",$tweet->entities ))
			{
				foreach ($tweet->entities->media as $photo)
				{
					$twitterFeed[$i]['tweet']['image'] = $photo->media_url;
				}
			}
			else
			{
				$twitterFeed[$i]['tweet']['image'] 	= null;
			}	
		}
		$twitterFeed[$i]['tweet']['retweet_count'] 	= $tweet->retweet_count;
		$twitterFeed[$i]['tweet']['favorite_count'] = $tweet->favorite_count;	
	}
?>