<?php 

class Mahasiswa_model {
    private $table = 'mahasiswa',
            $db; // untuk menampung database

    // Konek ke database
    public function __construct()
    {
        $this->db = new Database;
    }

    // Jalankan query
    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id'); // untuk menghindari sql injection
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}