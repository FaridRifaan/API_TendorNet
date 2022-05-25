<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $paket = new Paket($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $paket->nama_paket = $data->nama_paket;
  $paket->kategori_paket = $data->kategori_paket;
  $paket->harga_paket = $data->harga_paket;

  // Create post
  if($paket->create()) {
    echo json_encode(
      array('message' => 'Paket Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Paket Not Created')
    );
  }