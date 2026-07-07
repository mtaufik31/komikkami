<?php
require_once 'app/models/UserModel.php';

class UserController {
    private $model;

    public function __construct($db)
    {
        $this->model = new UserModel($db);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['id_users'] = $user['id_users'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                $_SESSION['success'] = "login";

                if ($user['role'] == 'admin') {
                    header("Location: ?aksi=admin_komik");
                } else {
                    header("Location: ?aksi=home");
                }
                exit();
            } else {
                $_SESSION['error'] = "Username atau password salah!";
            }
        }
        require 'app/views/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usernameTerpakai = $this->model->getByUsername($_POST['username']);

            if ($usernameTerpakai) {
                $_SESSION['error'] = "Username sudah digunakan! Silahkan pilih nama lain.";
                header("Location: ?aksi=register");
                exit(); 
            }

            $this->model->tambahUser($_POST['username'], $_POST['password'], 'user');
            $_SESSION['success'] = "Registrasi berhasil, silakan login.";
            header("Location: ?aksi=login");
            exit();
        }
        include 'app/views/auth/register.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        session_start();
        $_SESSION['success'] = "logout";

        header("Location: ?aksi=home");
        exit();
    }

    public function index()
    {
        $users = $this->model->getAllUsers();
        require 'app/views/auth/list_users.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usernameTerpakai = $this->model->getByUsername($_POST['username']);

            if ($usernameTerpakai) {
                $_SESSION['error'] = "Username sudah terdaftar di sistem!";
                header("Location: ?aksi=admin_user_add");
                exit();
            }

            $this->model->tambahUser($_POST['username'], $_POST['password'], $_POST['role']);
            $_SESSION['alert'] = "User berhasil ditambahkan!";
            header("Location: ?aksi=admin_user");
            exit();
        }
        include 'app/views/auth/add_users.php';
    }

    public function edit()
    {
        $id = $_GET['id'];
        $user = $this->model->getUserById($id);
        require 'app/views/auth/edit_users.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_users'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $this->model->updateUser($id, $username, $password, $role);
            $_SESSION['alert'] = "Data User berhasil diupdate!";
            header("Location: ?aksi=admin_user");
            exit();
        }
    }

    public function delete($id)
    {
        if ($id == $_SESSION['id_users']) {
            $_SESSION['alert'] = "Gagal! Anda tidak bisa menghapus akun yang sedang Anda pakai.";
        } else {
            $this->model->hapusUser($id);
            $_SESSION['alert'] = "User berhasil dihapus!";
        }
        header("Location: ?aksi=admin_user");
        exit();
    }
}
