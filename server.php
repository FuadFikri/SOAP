<?php
    require_once('koneksi.php');
    require_once('lib/nusoap.php');
    $server = new nusoap_server();

    function getBookData(){
        global $dbconn;
        $sql = "Select * from books";

        // prepare sql and bind parameters
        $statement = $dbconn->prepare($sql);
        // insert a row
        $statement->execute();
        $data = $statement->fetchAll();
        return json_encode($data);
        $dbconn = null; //nutup koneksi
    }

    function insertBook($title,$author_name,$price,$isbn,$category){
        global $dbconn;
        $sql = "INSERT into books set (title,author_name,price,isbn,category) VALUES ('$title','$author_name','$price','$isbn','$category')";

        $stmt = $dbconn->prepare($sql);
        // insert row
        $stmt->execute();
        return "berhasil berhasil oke";
        $dbconn = null;
    }

    $server->configureWSDL('Toko Buku', 'urn:book');
    $server->register('getBookData',
                        array('params'  => 'xsd:'),  //parameter  cuma buat dokumentasi   
                        //  array('id'  => 'xsd:integer')  contohnya
                        array('data'    => 'xsd:Array'), //output
                        'urn:book', //namespace
                        'urn:book#getBookData');  //soap action
    $server->register('insertBook',
                        array('title' => 'xsd:String',
                            'author_name' => 'xsd:String',
                            'price' => 'xsd:String',
                            'isbn' => 'xsd:String',
                            'category' => 'xsd:String'),  //parameter  cuma buat dokumentasi   
                        array('status'    => 'xsd:String'), //output
                        'urn:book', //namespace
                        'urn:book#insertBook');  //soap action                        
    
    $server->service(file_get_contents("php://input"));

?>  