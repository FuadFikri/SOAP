<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input data</title>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<div class="container">
    
 <form action="" method="POST">
    <div class="form-group">
        <label>title</label>
        <input type="text" name="title" class="form-control" >
    </div>
    <div class="form-group">
        <label>author</label >
        <input type="text"  name="author_name" class="form-control" >
    </div>
    <div class="form-group">
        <label>price</label>
        <input type="text"name="price"  class="form-control" >
    </div>
    <div class="form-group">
        <label>isbn</label>
        <input type="text" name="isbn" class="form-control" >
    </div>
    <div class="form-group">
        <label>category</label>
        <input type="text" name="category" class="form-control" >
    </div>
  
     <input type="submit" name="tambah" class="btn btn-default" value="simpan">
</form> 
</div>

</body>
</html>
<?php
if(!empty($_POST['tambah'])){
        require_once('lib/nusoap.php');
        $result = array();
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
            //$result = json_decode($result);
            //print_r($result);
        }catch(Exception $e) {
            echo 'Caught exception: '.$e->getMessage()."\n";
        }

        }


?>