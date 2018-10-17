<?php
	require_once('lib/nusoap.php');
	$result = array();
	$wsdl = "http://10.33.34.151/server.php?wsdl";
	$client = new nusoap_client($wsdl, true);
	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2>' . $err;
		exit();
	}
	try {
		@$id = $_GET['id'];
		$result = $client->call('getBook',array($id));
		//print_r($result);
		$result = json_decode($result);
		//print_r($result);
	}catch(Exception $e) {
		echo 'Caught exception: '.$e->getMessage()."\n";
	}
	
	if(count($result) == 1){
?>
<table>
	<form action="" method="POST">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="title" value="<?php echo $result[0]->title?>"></td>
		</tr>
		<tr>
			<td>Author name:</td>
			<td><input type="text" name="author_name" value="<?php echo $result[0]->author_name?>"></td>
		</tr>
		<tr>
			<td>Price:</td>
			<td><input type="text" name="price" value="<?php echo $result[0]->price?>"></td>
		</tr>
		<tr>
			<td>ISBN:</td>
			<td><input type="text" name="isbn" value="<?php echo $result[0]->isbn?>"></td>
		</tr>
		<tr>
			<td>Category:</td>
			<td><input type="text" name="category" value="<?php echo $result[0]->category?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="aksi" value="update"></td>
		</tr>
	</form>
</table>
<?php
		if(@$_POST['aksi'] == 'update'){
			require_once('lib/nusoap.php');
			$wsdl = "http://10.33.34.151/server.php?wsdl";
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				exit();
			}
			try {
				$title = $_POST['title'];
				$author_name = $_POST['author_name'];
				$price = $_POST['price'];
				$isbn = $_POST['isbn'];
				$category = $_POST['category'];
				
				$result = $client->call('updateBook',array($title,$author_name,$price,$isbn,$category,$id));
				//print_r($result);
				echo $result;
				//print_r($result);
			}catch(Exception $e) {
				echo 'Caught exception: '.$e->getMessage()."\n";
			}
		}
	}else{
		echo 'invalid id';
	}
?>