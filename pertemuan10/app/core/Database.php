<?php 

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Digunakan ketika ingin mengomptimasi koneksi ke database
        $option = [
            PDO::ATTR_PERSISTENT => true, // untuk membuat koneksi database terjaga
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // Menjalankan query
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binding data untuk menghindari sql injection
    public function bind($param, $value, $type = null)
    {
        if( is_null($type) ) {
            switch( true ) {
                // Jika tipenya integer
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                // Jika tipenya boolean
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                // Jika null
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                // Selain dari itu
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Baru di eksekusi
    public function execute() {
        $this->stmt->execute();
    }

    // Menampilkan datanya (ini datanya banyak) ini adalah wrappernya ini bisa digunakan untuk menampilkan tabel manapun nantinya
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Jika ingin menampilkan datanya cuman satu
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menghitung berapa baris yang berubah di dalam tabel
    public function rowCount() // row count ini punya kita
    {
        return $this->stmt->rowCount(); // row count ini punya PDO
    }

}