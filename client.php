<?php
    require_once('lib/nusoap.php');
    $result = array();
    $wsdl = "http://localhost/nusoap/server.php?wsdl";
    $client = new nusoap_client($wsdl, true);
    $err = $client->getError();
    if($err){
        echo '<h2>Constructor error'.$err;
        exit();
    }
    try{
        $result = $client->call('getBookData');
        $result = json_decode($result);
    }catch(Exception $e){
        echo 'caught exception : '. $e->getMessage() . "\n";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Book Store Web Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <h2>Books Store SOAP Web Service</h2>
  <a href="tambah.php">
    <button type="button" class="btn btn-primary" style="float: right;"><i class="fas fa-plus"></i> Tambah</button>
  </a>
   <br />
   <h2>Book Information</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
        <th>ISBN</th>
        <th>Category</th>
        <th>#</th>
    </thead>
    <tbody>
    <?php if(count($result)) {
        foreach ($result as $key) {
        ?>
        <tr>
            <td><?php echo $key->title; ?></td>
            <td><?php echo $key->author_name; ?></td>
            <td><?php echo $key->price; ?></td>
            <td><?php echo $key->isbn; ?></td>
            <td><?php echo $key->category; ?></td>
            <td><a href="hapus.php?id=<?php echo $key->id?>">hapus</a>|</td>
        </tr>
        <?php } }
        else{?>   
            <tr>
                <td colspan='5'>NO data</td>
            </tr> 
        <?php } ?>    
    </tbody>
    <tbody>
	</tbody>
  </table>
</div>

</body>
</html>

