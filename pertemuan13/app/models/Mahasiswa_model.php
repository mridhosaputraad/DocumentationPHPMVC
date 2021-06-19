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

    // Method hapus data
    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // Method ubah data
    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET
                    nama = :nama,
                    nim = :nim,
                    email = :email,
                    jurusan = :jurusan
                  WHERE id = :id";

        // Jalankan query
        $this->db->query($query);

        // Lalu binding
        $this->db->bind('id', htmlspecialchars($data['id']));
        $this->db->bind('nama', htmlspecialchars($data['nama']));
        $this->db->bind('nim', htmlspecialchars($data['nim']));
        $this->db->bind('email', htmlspecialchars($data['email']));
        $this->db->bind('jurusan', htmlspecialchars($data['jurusan']));

        // Eksekusi
        $this->db->execute();

        // Mengembalikan nilai
        return $this->db->rowCount();
    }

    // Method cara data
    public function cariDataMahasiswa()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE :keyword";

        // Jalankan query
        $this->db->query($query);
        
        // Binding
        $this->db->bind('keyword', "%$keyword%");

        // Mengembalikan nilai
        return $this->db->resultSet();
    }
}