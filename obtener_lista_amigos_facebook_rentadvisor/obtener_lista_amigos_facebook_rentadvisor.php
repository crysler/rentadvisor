<?php
session_start();
//verificar esta variable de sesion 


include_once "sensivility_data.php"; 

$request = new Facebook\FacebookRequest(
          $fbApp,
		  $_SESSION['fb_access_token'],
		  'GET',
		  "/".$id_user."/friends",
			['fields' => 'birthday,location,name,id,hometown,email'
		  ]);

$requestNomnbre = new Facebook\FacebookRequest(
          $fbApp,
		  $_SESSION['fb_access_token'],
		  'GET','/'.$id_user.'?fields=name');
// con esta funcion permito hacer varios llamados sin repetir codigo
function retornarGrafo($request,$fb){
	$response ="";
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
	} 
return $response;

}
 
	
//haciendo el request, y guardandolo en otra variable para usarlo luego
$response=retornarGrafo($request,$fb);

$response2=retornarGrafo($requestNomnbre,$fb);
 
//llamando al objeto solicitado, aqui uso el getGraphEdge para varios resultados
$graphEdge = $response->getGraphEdge();
//un solo resultado individual uso el getGraphNode
$graphEdge2 = $response2->getGraphNode();
echo "<br> los amigos de <b>".$graphEdge2['name']."</b> son:"; 
echo "<br>";
 for ($i=0;$i< sizeOf($graphEdge);$i++){
    echo 'nombre: '.$graphEdge[$i]['name'].' idCodigo: '.$graphEdge[$i]['id'];
	echo "<br>";
 }

?>