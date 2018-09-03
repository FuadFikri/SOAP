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

    $server->configureWSDL('Toko Buku', 'urn:book');
    $server->register('getBookData',
                        array('params'  => 'xsd:'),  //parameter  cuma buat dokumentasi   
                        //  array('id'  => 'xsd:integer')  contohnya
                        array('data'    => 'xsd:Array'), //output
                        'urn:book', //namespace
                        'urn:book#getBookData');  //soap action
    
    $server->service(file_get_contents("php://input"));

?>  