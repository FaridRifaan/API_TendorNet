<?php 
  class Paket {
    // DB stuff
    private $conn;
    private $table = 'paket';

    // Paket Properties
    public $id;
    public $nama_paket;
    public $kategori_paket;
    public $harga_paket;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Paket
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY Id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Paket Satu satu
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE Id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->nama_paket = $row['nama_paket'];
          $this->kategori_paket = $row['kategori_paket'];
          $this->harga_paket = $row['harga_paket'];
    }

    // Buat Paket
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET nama_paket = :nama_paket, kategori_paket = :kategori_paket, harga_paket = :harga_paket';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nama_paket = htmlspecialchars(strip_tags($this->nama_paket));
        $this->kategori_paket = htmlspecialchars(strip_tags($this->kategori_paket));
        $this->harga_paket = htmlspecialchars(strip_tags($this->harga_paket));

        // Bind data
        $stmt->bindParam(':nama_paket', $this->nama_paket);
        $stmt->bindParam(':kategori_paket', $this->kategori_paket);
        $stmt->bindParam(':harga_paket', $this->harga_paket);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Perbarui Paket
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                            SET nama_paket = :nama_paket, kategori_paket = :kategori_paket, harga_paket = :harga_paket
                            WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->nama_paket = htmlspecialchars(strip_tags($this->nama_paket));
      $this->kategori_paket = htmlspecialchars(strip_tags($this->kategori_paket));
      $this->harga_paket = htmlspecialchars(strip_tags($this->harga_paket));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':nama_paket', $this->nama_paket);
      $stmt->bindParam(':kategori_paket', $this->kategori_paket);
      $stmt->bindParam(':harga_paket', $this->harga_paket);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Hapus Paket
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    } 

  }
