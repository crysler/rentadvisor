<?php
function imprimir($imprime){
	
	//echo ($imprime).'<br><br>';
}

function imprimir2($imprime){
	
	echo ($imprime).'<br><br>';
}

?>
 
<?php
    include "conexion.php";
 
    //leer el archivo json file 
    $jsondata = file_get_contents('dataExtraida.json');

    // cargar el archivo en memoria
    $data = json_decode($jsondata, true);

	$i=0; //contamos la cantidad de post existentes
	$j=0; //contamos la cantidad total de comentarios existentes, sin discriminar
	
    foreach ($data['feed']['data'] as $row) {	
//--------------------------------------------------------------------------	   
//------- insertando en la tabla post
//--------------------------------------------------------------------------	   
     imprimir2("insertando post #: ".$i); 
	  if ( !empty($row['message']))
	     $titlePost=addslashes($row['message']);
	  $iduser=$row['from']['id'];
	  $nameuser=$row['from']['name'];
	  $created_time=$row['created_time'];
      $dateInsert=date('l jS \of F Y h:i:s A'); //esta es la hora y fecha en que se inserto la consulta
	  $idobject='NULL'; //reservados para uso futuro
	  $content='NULL';//reservados para uso futuro
 	  $comment='NULL';//reservados para uso futuro
	  //impresiones
	  imprimir($titlePost);
	  imprimir($iduser);
	  imprimir($nameuser);
	  imprimir($created_time);
	  imprimir($dateInsert);
	  imprimir($idobject);
	  imprimir($content);
	  imprimir($comment);
	 
	 //creo la consulta para insertar en la tabla post 
      $sql = "INSERT INTO post(idpost, idobject,titlePost,nameuser, iduser, created_time, dateInsert, content,comment)
	  VALUES('NULL','$idobject','$titlePost','$nameuser','$iduser','$created_time','$dateInsert', '$content','$comment')";	 
 	 imprimir($sql);
	//  inserto en tabla post  
 	 if(!mysql_query($sql,$con))
	 {
		die('Error : ' . mysql_error());
	 }
	  //tomo el ultimo Id de esta tabla para luego llevarlo a la pintura
	  $id_DB_Post=mysql_insert_id();
//--------------------------------------------------------------------------	   
//------- insertando en la tabla pictures
//--------------------------------------------------------------------------	   

	  //validando sino existe la pintura:
	  if (!empty($row['picture'])){
	     $pathImage=$row['picture'];
		 $idobject=$row['id'];
		 imprimir($pathImage);
		 imprimir($idobject);
         
		 //creo la consulta para insertar en la tabla picture
		$sql = "INSERT INTO picture(idpicture,idobject,pathImage,created_time, dateInsert, content,comment)
		VALUES('NULL', '$idobject','$pathImage','$created_time', '$dateInsert', '$content','$comment')";	 

		 if(!mysql_query($sql,$con))
		 {
			die('Error : ' . mysql_error());
		 }
		 $id_DB_picture=mysql_insert_id();
//--------------------------------------------------------------------------	   
//------- insertando en la tabla post_has_picture
//--------------------------------------------------------------------------	   
		 
         //insertar en la tabla asociativa post_has_picture
		 $sql = "INSERT INTO post_has_picture(post_idpost,picture_idpicture) VALUES('$id_DB_Post','$id_DB_picture')";
         if(!mysql_query($sql,$con))
		 {
			die('Error : ' . mysql_error());
		 }	 
		 
	  }
//--------------------------------------------------------------------------	   
//------- insertando en la tabla comment
//--------------------------------------------------------------------------	   
		 // validacion con  FOR para evitar explosiones en caso de que el post no tenga replies
		 if ( !empty($row['comments']['data'])){
			 foreach ( $row['comments']['data'] as $row2) {
                
	            $iduser=$row2['from']['id'];
				$nameuser=$row2['from']['name'];
				$created_time=$row2['created_time'];
				$dateInsert=date('l jS \of F Y h:i:s A'); //esta es la hora y fecha en que se inserto la consulta
				$idobject=$row2['id']; 
			    $content='NULL';//reservados para uso futuro
				$comments=addslashes($row2['message']);
                $post_idpost=$id_DB_Post;				
				imprimir($iduser);
				imprimir($nameuser);
				imprimir($created_time);
				imprimir($content);
				imprimir($idobject);
				imprimir($comments);				
				
				//creo la consulta para insertar en la tabla comment 
				$sql = "INSERT INTO comment(idcomment, idobject,nameuser, iduser, created_time, dateInsert, content,comment,post_idpost)
				 VALUES('NULL', '".$idobject."','".$nameuser."','".$iduser."', '".$created_time."', '".$dateInsert."', '".$content."','".$comments."','".$post_idpost."')";	 
				 
				// inserto en tabla comments  
				 if(!mysql_query($sql,$con))
				 {
					die('Error : ' . mysql_error());
				 }
				 //tomo el ultimo Id de esta tabla para luego llevarlo a la pintura
				 $id_DB_comment=mysql_insert_id();
				 
//--------------------------------------------------------------------------	   
//------- insertando en la tabla replie
//--------------------------------------------------------------------------	   
				 if ( !empty($row2['comments']['data'])){
					 foreach ( $row2['comments']['data'] as $row3) {	           
						$iduser=$row3['from']['id'];
						$nameuser=$row3['from']['name'];
						$created_time=$row3['created_time'];
						$dateInsert=date('l jS \of F Y h:i:s A'); //esta es la hora y fecha en que se inserto la consulta
						$idobject=$row3['id']; 
						$content='NULL';//reservados para uso futuro
						if(!empty($row3['message']))
						   $comments=addslashes($row3['message']);
						$comment_idcomment=$id_DB_comment;				
						imprimir($iduser);
						imprimir($nameuser);
						imprimir($created_time);
						imprimir($content);
						imprimir($idobject);
						imprimir($comments);				
						
						//creo la consulta para insertar en la tabla replie 
						$sql = "INSERT INTO replie(idreplie, idobject,nameuser, iduser, created_time, dateInsert, content,comment,comment_idcomment)
						 VALUES('NULL', '$idobject','$nameuser','$iduser', '$created_time', '$dateInsert', '$content','$comments','$comment_idcomment')";	 
						 
						 //inserto en tabla replie  
						 if(!mysql_query($sql,$con))
						 {
							die('Error : ' . mysql_error());
						 }
						  
					 }
				 }

			   $j++;
			 }
		} 
		
	  $i++;
	}
	imprimir("total de post Creados: ".strval($i));
	imprimir("total de comenarios escritos: ".strval($j));
?>