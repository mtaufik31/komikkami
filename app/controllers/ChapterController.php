<?php
require_once 'app/models/ChapterModel.php';
require_once 'app/models/KomikModel.php'; // Butuh ini untuk menampilkan judul komik

class ChapterController {
    private $model;
    private $komikModel;

    public function __construct($db) {
        $this->model = new ChapterModel($db);
        $this->komikModel = new KomikModel($db);
    }

    public function index() {
        $id_komik = $_GET['id_komik'];
        $komik = $this->komikModel->getKomikById($id_komik);
        $chapters = $this->model->getChaptersByKomik($id_komik);
        
        include 'app/views/admin/chapter_list.php';
    }

    public function create() {
        $id_komik = $_GET['id_komik'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomor_chapter = $_POST['nomor_chapter'];
            $judul_chapter = $_POST['judul_chapter'];

            $zipFile = $_FILES['file_zip']['tmp_name'];
            $namaZip = $_FILES['file_zip']['name'];

            $folder_path = "img/chapters/komik_" . $id_komik . "_ch_" . $nomor_chapter . "/";

            if (!is_dir($folder_path)) {
                mkdir($folder_path, 0777, true);
            }

            $zip = new ZipArchive;
            if ($zip->open($zipFile) === TRUE) {
                $zip->extractTo($folder_path); 
                $zip->close();

                $this->model->tambahChapter($id_komik, $nomor_chapter, $judul_chapter, $folder_path);
                
                $_SESSION['alert'] = "Chapter $nomor_chapter berhasil diupload!";
                header("Location: ?aksi=admin_chapter&id_komik=$id_komik");
                exit();
            } else {
                $_SESSION['error'] = "Gagal membaca file ZIP!";
            }
        }
        
        include 'app/views/admin/chapter_add.php';
    }

    public function delete() {
        $id_chapter = $_GET['id_chapter'];
        $id_komik = $_GET['id_komik'];
        
        $this->model->hapusChapter($id_chapter);
        $_SESSION['alert'] = "Chapter berhasil dihapus!";
        header("Location: ?aksi=admin_chapter&id_komik=$id_komik");
        exit();
    }
    public function read() {
        $id_chapter = $_GET['id_chapter'];
        $chapter = $this->model->getChapterById($id_chapter);
        
        $folder_path = $chapter['content_path'];
        $images = [];
        
        if (is_dir($folder_path)) {
            $files = scandir($folder_path);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $images[] = $file;
                }
            }
        }
        $komik = $this->komikModel->getKomikById($chapter['id_komik']);
        
        include 'app/views/frontend/read_chapter.php';
    }
}
?>