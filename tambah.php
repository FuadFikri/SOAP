<table>
	<form action="" method="POST">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="title"></td>
		</tr>
		<tr>
			<td>Author name:</td>
			<td><input type="text" name="author_name"></td>
		</tr>
		<tr>
			<td>Price:</td>
			<td><input type="text" name="price"></td>
		</tr>
		<tr>
			<td>ISBN:</td>
			<td><input type="text" name="isbn"></td>
		</tr>
		<tr>
			<td>Category:</td>
			<td><input type="text" name="category"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="aksi" value="tambah"></td>
		</tr>
	</form>
</table>
<?php
	if(@$_POST['aksi'] == 'tambah'){
		require_once('lib/nusoap.php');
		$wsdl = "http://localhost/nusoap/server.php?wsdl";
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
			
			$result = $client->call('insertBook',array($title,$author_name,$price,$isbn,$category));
			//print_r($result);
			echo $result;
			//print_r($result);
		}catch(Exception $e) {
			echo 'Caught exception: '.$e->getMessage()."\n";
		}
	}