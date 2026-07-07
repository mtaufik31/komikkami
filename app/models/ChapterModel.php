<?php
class ChapterModel {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getChaptersByKomik($id_komik)
    {
        $query = "SELECT * FROM chapters WHERE id_komik = '$id_komik' ORDER BY nomor_chapter ASC";
        $result = mysqli_query($this->conn, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getChapterById($id_chapter)
    {
        $query = "SELECT * FROM chapters WHERE id_chapter = '$id_chapter'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function tambahChapter($id_komik, $nomor_chapter, $judul_chapter, $content_path)
    {
        $query = "INSERT INTO chapters (id_komik, nomor_chapter, judul_chapter, content_path) 
                  VALUES ('$id_komik', '$nomor_chapter', '$judul_chapter', '$content_path')";
        return mysqli_query($this->conn, $query);
    }

    public function hapusChapter($id_chapter)
    {
        $query = "DELETE FROM chapters WHERE id_chapter = '$id_chapter'";
        return mysqli_query($this->conn, $query);
    }
}
