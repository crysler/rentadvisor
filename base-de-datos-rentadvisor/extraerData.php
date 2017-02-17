<?php
/*$c = curl_init('https://graph.facebook.com/v2.8/315802298617016?fields=feed.limit(175){from,message,name,picture,comments{from,id,message,comments{from,id,created_time,message},created_time},id,created_time}&access_token=EAAG3bjIe4rcBALZB67HChysz3TZA0vmE5ODghy0YzAY9pGy2ZAZCCuVxsfOscfnojYgTiNxvGNiE1inZBWcOPc3AmzJbpGlmUNgeXkZAMDv5ZANwwYndf1ZAQhxtlBdWYBKTmEIIiYLBTSPORPoEuGp4');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
echo $page;*/
?>

<?php
echo "Codigo de php que descarga la pagina del grupo de facebook y la
guarda en un archivo.";
 
//abrimos un fichero donde guardar la descarga de la web
$fp=fopen("dataExtraida.json", "w");
 
// Se crea un manejador CURL
$ch=curl_init();
 
//token que cambia 
$tokenazo="EAAG3bjIe4rcBALZB67HChysz3TZA0vmE5ODghy0YzAY9pGy2ZAZCCuVxsfOscfnojYgTiNxvGNiE1inZBWcOPc3AmzJbpGlmUNgeXkZAMDv5ZANwwYndf1ZAQhxtlBdWYBKTmEIIiYLBTSPORPoEuGp4"; 


$tokan= "https://graph.facebook.com/v2.8/315802298617016?fields=feed.limit(175){from,message,name,picture,comments{from,id,message,comments{from,id,created_time},created_time},id,created_time}&access_token=";
$url=$tokan.$tokenazo;

// Se establece la URL y algunas opciones
curl_setopt($ch, CURLOPT_URL, $url);


//determina si descargamos las cabeceras del servidor [0-No mostramos|1-mostramos]
curl_setopt($ch, CURLOPT_HEADER, 0);
//determina si mostramos el resultado en el nevagador [0-mostramos|1-NO mostramos]
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//determina donde guardar el fichero
curl_setopt($ch, CURLOPT_FILE, $fp);
 
// Se obtiene la URL indicada
curl_exec($ch);
 
// Se cierra el recurso CURL y se liberan los recursos del sistema
curl_close($ch);
 
//se cierra el manejador de ficheros
fclose($fp);
?>
