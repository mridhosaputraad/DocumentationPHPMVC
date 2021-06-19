<?php 

class Mahasiswa_model {
    private $dbh,      // Driver PDO = php data object karena lebih fleksibel (database handler)
            $stmt;      // Buat nyimpen query

    // Koneksi ke database
    public function __construct()
    {
        // data source name buat identitas server
        // $dsn = 'mysql:host=localhost;dbname=phpmvc'; atau cara kedua
        $dsn = 'mysql:host=127.0.0.1;dbname=phpmvc';

        // Cek koneksinya apakah berhasil atau tidak
        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllMahasiswa()
    {
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}