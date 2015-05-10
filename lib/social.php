<?php
// Retrieve information from the database and return it in JSON format
// Written by Matt Neill, January 2015 for POET

//require_once("dbconfig.php");  // database configuration
header( "Content-Type: application/json; charset=utf-8" );
error_reporting(0);
date_default_timezone_set("America/Toronto");

$output		= (object) array();
/*$key 	   	= $_REQUEST["key"];

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_errno)
{
	echo "No connection.";
}
else
{
	$manufacturer 		= "SELECT manufacturer_name, manufacturer_location FROM manufacturers WHERE api_key='$key'";
	$manufacturer_info 	= $conn->query($manufacturer);
	$manufacturer_row  	= $manufacturer_info->num_rows;	
	$manufacturer_info 	= $manufacturer_info->fetch_assoc();
	$manufacturer_name 	= $manufacturer_info['manufacturer_name'];
	$manufacturer_loc  	= $manufacturer_info['manufacturer_location'];
			
	/*------------------------------Config------------------------------*
	$configquery = str_replace("%man%", $manufacturer_name, $configquery);
	$conf = $conn->query("SET NAMES utf8");
	$conf = $conn->query($configquery);	
	
	if ($conf){
		$output->config 			= $conf->fetch_assoc();		*/
	/*------------------------------Social feeds------------------------------*/
		/*Instagram*/
		$instagram_id = 'ryoung73';
		if ($instagram_id){
			include_once('getInstagram.php');
			$output->instagram = $instaFeed;
		}
		
		/*Twitter*/
		$twitter_id = 'batmanifesto';
		if ($twitter_id)
		{
			include_once('getTwitter.php');
			$output->twitter = $twitterFeed;
		}	
	
	/*------------------------------Output------------------------------*/
	unset($output->config);
	echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);  // return JSON object to client side

?>