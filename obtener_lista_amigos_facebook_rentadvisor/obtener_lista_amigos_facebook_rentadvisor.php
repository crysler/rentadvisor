<?php
session_start();
//verificar esta variable de sesion 
$_SESSION['fb_access_token']="258909491147805|WlrtIwRuahmP7sJboxbJKsdKLEs";

require_once __DIR__ .'/php-graph-sdk-5.4/src/Facebook/autoload.php';
 
use Facebook\FacebookRequest;


/* 
// Send the request to Graph
try {
  $response = $fb->getClient()->sendRequest($request);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}*/
 
$graphNode = $response->getGraphNode();
  
/*
echo 'User name: ' . $graphObject['name'];
echo 'birthday: ' . $graphObject['birthday'];
*/
print_r($graphNode);


?>