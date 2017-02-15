<?php

echo "take this";
asdfdsfd
require_once __DIR__ .'php-graph-sdk-5.4/src/Facebook/autoload.php';
echo __DIR__ .'php-graph-sdk-5.4/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '258909491147805',
  'app_secret' => '73c9b803fd23c9494a51fd2f6bcef96c',
  'default_graph_version' => 'v2.8',
]);

$request = new FacebookRequest(
  $session,
  'GET',
  '/100383537152885/friends',
  array(
    'fields' => 'birthday,location,name,id,hometown,email'
  )
);

$response = $request->execute();
$graphObject = $response->getGraphObject();
/* handle the result */
echo $graphObject ;
?>