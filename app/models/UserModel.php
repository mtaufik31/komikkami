<?php

class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByUsername($username) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function tambahUser($username, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', 
        '$hashed_password', '$role')";
        return mysqli_query($this->conn, $query);
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users ORDER BY id_users DESC";
        $result = mysqli_query($this->conn, $query);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id_users = '$id'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updateUser($id, $username, $password, $role) {
        if ($password != '') {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET username = '$username', 
            password = '$hashed_password', role = '$role' 
            WHERE id_users = '$id'";
        } else {
            $query = "UPDATE users SET username = '$username', 
            role = '$role' 
            WHERE id_users = '$id'";
        }
        return mysqli_query($this->conn, $query);
    }

    public function hapusUser($id) {
        $query = "DELETE FROM users WHERE id_users = '$id'";
        return mysqli_query($this->conn, $query);
    }
}
?>