<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
error_reporting(E_ALL); ini_set('display_errors', '1');
require_once __DIR__ . '/functions.php';
$mysqli = conn();

if(isset($_GET{'num_per_page'})){ //o xristis alazi ari8mo posts
	$num_per_page = $_GET{'num_per_page'};
	$_SESSION{'num_per_page'} = $num_per_page; //posa ana selida 
	$num_per_page = (int) $_SESSION{'num_per_page'};
	$page=1;
}else{
		if(isset($_GET{'page'})){ //o xristis alazi selida
			$num_per_page = (int) $_SESSION{'num_per_page'}; //poses selides
			$page=$_GET{'page'};
		}else{ //o xristis protompeni sti selida
			$num_per_page=5;
			$_SESSION{'num_per_page'} = $num_per_page ;
			$page=1;
		}
}


$start_from=($page-1)*$num_per_page; //pou na arxisi to limit

if(isset($_POST{'search'})){ //search bar (den apo8ikebete h o ari8mos posts ana selida)
	$search=mysqli_real_escape_string($mysqli,$_POST['search']);
	$sql = "SELECT * FROM posts WHERE content LIKE '%".$search."%' OR title LIKE '%".$search."%' ORDER BY date DESC LIMIT $start_from,$num_per_page";
	$result = mysqli_query($mysqli,$sql);
}else{
	$sql = "SELECT * FROM posts ORDER BY date DESC LIMIT $start_from,$num_per_page";
	$result = mysqli_query($mysqli,$sql);
}
   

?>
<!DOCTYPE html>
<html>
<style>
	tr > td:nth-child(1)
{
    text-align: center;
	width:50px;
}
tr > td:nth-child(2)
{
    text-align: center;
}
	
th{
	height:50px;	
	}
	
th{
height:50px;	
}
td {
	vertical-align: center;
	border-bottom: 2px solid black;
	border-top: 2px solid black;
	border-spacing: 20;
	border-collapse: collapse;
	text-align: left;
	width: 40px;
	max-width: 40px;
	height:40px;
	max-height:40px;
	 white-space: nowrap;
	  overflow: hidden;
  text-overflow: ellipsis;
}
	</style>

<head>
	<link rel="stylesheet" href="main.css">
	<meta charset+"UTF-8"> 
	<title>Questions</title>
	       <link rel = "icon" href = 
"https://thumbs.dreamstime.com/z/computer-logo-pc-logo-vector-computer-logo-pc-logo-vector-142583250.jpg" 
        type = "image/x-icon">
</head>
<body>
<?php include 'nav.php';?>
<div class="accordion">
  <div class="accordion-item">
    <div class="accordion-header">
      <button class="accordion-btn"></button>
    </div>
    <div class="accordion-content">
    		<?php include 'accordion.php';?>
    </div>
  </div>
</div>
	
	<hr>
	<h3 class="center" >Questions</h3>
	<form method="POST" action="forum.php" >
  <div class="container">    
		<label for="search"><b>Search</b></label>
    	<input type="text" placeholder="By title or content" name="search" required> 
	</div>
	</form>
	<p>
	
	<?php
	$n1 = 5;
	$n2 = 15;
	echo '<a href="forum.php?num_per_page='.$n1.' "class = "numbers2"> '.$n1.'</a>'; //print posa post ana selida
	echo '<a href="forum.php?num_per_page='.$n2.' "class = "numbers2"> '.$n2.'</a>'; 
	?>
		</p>
		<table width="70%" class="table-bordered" >
			<tr>
				<th>Title</th>
				<th>Post</th>
				<th>User ID</th>
				<th>Date</th>
			</tr>
		<?php
		while($rows=mysqli_fetch_array($result)) //posts
		{ ?>
			<tr>
				<td><?php echo '<a href="posta.php?post_id=' . $rows['post_id'] . '">' . $rows['title'] . '</a>' ?> </td>
				<td><?php echo $rows{'content'} ?></td>
				<td><?php echo $rows{'user_id'} ?></td>
				<td><?php echo $rows{'date'} ?></td>
				
			</tr>
		<?php
		}
		?>
	</table>
	<?php 
	$sql="SELECT * from posts";
	if(isset($_POST{'search'})){
	$sql = "SELECT * FROM posts WHERE content LIKE '%".$search."%' OR title LIKE '%".$search."%'"; 
	}  
	
	$result = mysqli_query($mysqli,$sql);
	$total_num = mysqli_num_rows($result);
	$total_pages =ceil($total_num/$num_per_page); //round diadiko pros ta apano
	for($i=1;$i<=$total_pages;$i++)
	{
		echo '<a href="forum.php?page='.$i.' "class = "numbers"> '.$i.'</a>'; //print poses selides sinolika
	}
	
	?>
	
	

	<p>
	<img src="https://di.ionio.gr/images/content/og_image.jpg" width="600" height="600">
	</p>
<script src="main.js">
</script>
</body>
</html>