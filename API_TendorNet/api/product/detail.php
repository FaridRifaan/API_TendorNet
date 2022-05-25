<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $paket = new Paket($db);

  // Get ID
  $paket->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $paket->read_single();

  // Create array
  $paket_arr = array(
    'nama_paket' => $paket->nama_paket,
    'kategori_paket' => $paket->kategori_paket,
    'harga_paket' => $paket->harga_paket
  );

  // Make JSON
  print_r(json_encode($paket_arr));
