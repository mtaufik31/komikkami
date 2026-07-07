<?php
class KomikModel {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllKomik()
    {
        $query = mysqli_query($this->conn, "SELECT * FROM komik ORDER BY id_komik DESC");
        
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getKomikById($id)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM komik WHERE id_komik = '$id'");
        return mysqli_fetch_assoc($query);
    }

    public function tambahKomik($data, $gambar)
    {
        $judul = $data['judul'];
        $sinopsis = $data['sinopsis'];
        $genre = $data['genre'];
        $author = $data['author'];
        $artist = $data['artist'];
        $publisher = $data['publisher'];
        $tahun_rilis = $data['tahun_rilis'];
        $status = $data['status'];

        $query = "INSERT INTO komik (judul, sinopsis, genre, 
        author, artist, publisher, tahun_rilis, status, gambar) 
                  VALUES ('$judul', '$sinopsis', '$genre', '$author', '$artist', '$publisher', '$tahun_rilis', '$status', '$gambar')";
        
        return mysqli_query($this->conn, $query);
    }

    public function update($id_komik, $judul, $sinopsis, $genre, $author, $artist, $publisher, $tahun_rilis, $status, $gambar) {
        $query = "UPDATE komik SET
                    judul='$judul',
                    sinopsis='$sinopsis',
                    genre='$genre',
                    author='$author',
                    artist='$artist',
                    publisher='$publisher',
                    tahun_rilis='$tahun_rilis',
                    status='$status',
                    gambar='$gambar'
                  WHERE id_komik='$id_komik'";

        return mysqli_query($this->conn, $query);
    }

    public function hapusKomik($id)
    {
        $query = "DELETE FROM komik WHERE id_komik = '$id'";
        return mysqli_query($this->conn, $query);
    }

    // Ambil chapter untuk halaman detail
    public function getChaptersByKomik($id_komik)
    {
        $query = "SELECT * FROM chapters WHERE id_komik = '$id_komik' ORDER BY nomor_chapter DESC";
        $result = mysqli_query($this->conn, $query);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}