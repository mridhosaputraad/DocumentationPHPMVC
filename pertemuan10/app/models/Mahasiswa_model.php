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

    // Method tambah data
    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa
                    VALUES
                  ('', :nama, :nim, :email, :jurusan)";

        // Jalankan query
        $this->db->query($query);

        // Lalu binding
        $this->db->bind('nama', htmlspecialchars($data['nama']));
        $this->db->bind('nim', htmlspecialchars($data['nim']));
        $this->db->bind('email', htmlspecialchars($data['email']));
        $this->db->bind('jurusan', htmlspecialchars($data['jurusan']));

        // Eksekusi
        $this->db->execute();

        // Mengembalikan nilai
        return $this->db->rowCount();
    }
}