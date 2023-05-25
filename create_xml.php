<?php
require_once __DIR__ . '/functions.php';
header('Content-Type: text/plain');
//connect to db
$mysqli = conn();

if ($mysqli->connect_errno) {
   echo "Connect failed ".$mysqli->connect_error;
   exit();
}
$query = "SELECT post_id, title, content, user_id, date FROM posts";
$postsArray = array();
if ($result = $mysqli->query($query)) {
    /* fetch associative array */
	
    while ($row = $result->fetch_assoc()) {
       array_push($postsArray, $row);
    }
	
  if(count($postsArray)){
         createXMLfile($postsArray);
     }
    /* free result set */
    $result->free();
}
	/* close connection */
	$mysqli->close();

function createXMLfile($postsArray){
  
   $dom  = new DOMDocument('1.0', 'utf-8'); 
    $root  = $dom->createElement('posts'); 
   for($i=0; $i<count($postsArray); $i++){ //ari8mos posts
     //inserting values
     $post_id =  $postsArray[$i]['post_id'];  
     $post_title = htmlspecialchars($postsArray[$i]['title']);
     $post_content =  htmlspecialchars($postsArray[$i]['content']);
     $user_id =  $postsArray[$i]['user_id']; 
     $date =  $postsArray[$i]['date'];
	 //creating xml
     $post = $dom->createElement('post');
     $post->setAttribute('post_id', $post_id);
     $post_title = $dom->createElement('post_title', $post_title ); 
     $post->appendChild($post_title ); 
     $post_content   = $dom->createElement('post_content', $post_content); 
     $post->appendChild($post_content); 
     $user_id = $dom->createElement('user_id', $user_id); 
     $post->appendChild($user_id); 
     $date = $dom->createElement('date', $date); 
     $post->appendChild($date); 
	   //comments tou post
	   
	   //connect to db
		$mysqli = conn();
		$query_com = "SELECT * FROM comments WHERE post_id= ".$post_id." ORDER BY date ";
		$commentsArray = array();
		if ($result_com = $mysqli->query($query_com)) {
			/* fetch associative array */
			
			while ($row_com = $result_com->fetch_assoc()) {
			array_push($commentsArray, $row_com);
			}
			
		if(count($commentsArray)){
			for($j=0; $j<count($commentsArray); $j++){
			//inserting values
			$com_id =  $commentsArray[$j]['com_id'];  
			$com_content =  htmlspecialchars($commentsArray[$j]['content']);
			$user_com_id =  $commentsArray[$j]['user_id']; 
			$com_date =  $commentsArray[$j]['date'];
			//creating xml
			$comment = $dom->createElement('comment');
			$comment->setAttribute('com_id', $com_id);
			$com_content   = $dom->createElement('com_content', $com_content); 
     		$comment->appendChild($com_content);
			$user_com_id   = $dom->createElement('user_com_id', $user_com_id); 
     		$comment->appendChild($user_com_id);
			$com_date   = $dom->createElement('com_date', $com_date); 
     		$comment->appendChild($com_date);
			$post->appendChild($comment);
			
		
			} 
		}
		/* free result set */
		$result_com->free();
		/* close connection */
		$mysqli->close();
		}
	  
     $root->appendChild($post);
   }
	$dom->appendChild($root); 
	//workaround gia print se xml format kai oxi aplo string save->load->save->echo
	$outXML = $dom->saveXML(); 
	$dom = new DOMDocument(); 
	$dom->preserveWhiteSpace = false; 
	$dom->formatOutput = true; 
	$dom->loadXML($outXML); 
	$outXML = $dom->saveXML(); 
	echo $outXML;
	
}
	

?>