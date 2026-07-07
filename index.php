<?php
session_start();

require_once 'config/koneksi.php';
require_once 'app/controllers/KomikController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/ChapterController.php';

$komikController = new KomikController($conn);
$userController = new UserController($conn);
$chapterController = new ChapterController($conn);

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'home';

if (strpos($aksi, 'admin_') === 0) {
    if (!isset($_SESSION['role'])) {
        header("Location: ?aksi=login");
        exit();
    }
    if ($_SESSION['role'] !== 'admin') {
        header("Location: ?aksi=home&error=akses");
        exit();
    }
}

switch ($aksi) {
    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'admin_komik':
        $komikController->index();
        break;
    case 'admin_komik_add':
        $komikController->create();
        break;
    case 'admin_komik_edit':
        $komikController->edit();
        break;
    case 'admin_komik_update':
        $komikController->update();
        break;
    case 'admin_komik_delete':
        $komikController->delete($_GET['id']);
        break;
    case 'admin_user':
        $userController->index();
        break;
    case 'admin_user_add':
        $userController->create();
        break;
    case 'admin_user_edit':
        $userController->edit();
        break;
    case 'admin_user_update':
        $userController->update();
        break;
    case 'admin_user_delete':
        $userController->delete($_GET['id']);
        break;
    case 'admin_chapter':
        $chapterController->index();
        break;
    case 'admin_chapter_add':
        $chapterController->create();
        break;
    case 'admin_chapter_delete':
        $chapterController->delete();
        break;
    case 'home':
        $komikController->home();
        break;
    case 'detail':
        $komikController->detailKomik();
        break;
    case 'read':
        $chapterController->read();
    default:
        echo "Halaman tidak ditemukan (404)";
        break;
}
