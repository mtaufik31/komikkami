<?php
require_once 'app/models/KomikModel.php';

class KomikController {
    private $model;

    public function __construct($db)
    {
        $this->model = new KomikModel($db);
    }

    public function home()
    {
        $komik = $this->model->getAllKomik();
        include 'app/views/frontend/home.php';
    }

    public function index()
    {
        $komik = $this->model->getAllKomik();
        include 'app/views/admin/komik_list.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gambar = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];
            $path = "img/" . $gambar;

            if (move_uploaded_file($tmp, $path)) {
                $this->model->tambahKomik($_POST, $gambar);
                $_SESSION['alert'] = "Komik berhasil ditambahkan!";
                header("Location: ?aksi=admin_komik");
                exit();
            } else {
                $_SESSION['error'] = "Gagal upload gambar!";
            }
        }
        include 'app/views/admin/komik_add.php';
    }

    public function edit()
    {
        $id = $_GET['id'];
        $komik = $this->model->getKomikById($id);

        include 'app/views/admin/komik_edit.php';
    }

    public function update()
    {
        $id_komik = $_POST['id_komik'];
        $judul = $_POST['judul'];
        $sinopsis = $_POST['sinopsis'];
        $genre = $_POST['genre'];
        $author = $_POST['author'];
        $artist = $_POST['artist'];
        $publisher = $_POST['publisher'];
        $tahun_rilis = $_POST['tahun_rilis'];
        $status = $_POST['status'];

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        if ($gambar != '') {
            move_uploaded_file($tmp, 'img/' . $gambar);
        } else {
            $data = $this->model->getKomikById($id_komik);
            $gambar = $data['gambar'];
        }

        $this->model->update(
            $id_komik,
            $judul,
            $sinopsis,
            $genre,
            $author,
            $artist,
            $publisher,
            $tahun_rilis,
            $status,
            $gambar
        );

        $_SESSION['alert'] = "Komik berhasil diperbarui!";
        header('Location: ?aksi=admin_komik');
        exit();
    }

    public function delete($id)
    {
        $this->model->hapusKomik($id);
        $_SESSION['alert'] = "Komik berhasil dihapus!";
        header("Location: ?aksi=admin_komik");
        exit();
    }

    public function detailKomik()
    {
        $id = $_GET['id'];
        $komik = $this->model->getKomikById($id);     
        $chapters = $this->model->getChaptersByKomik($id);
        include 'app/views/frontend/detail.php';
    }
}
