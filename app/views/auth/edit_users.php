<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <div class="d-flex">

        <aside class="bg-danger text-white d-flex flex-column shadow"
            style="width:250px; min-height:100vh;">

            <div class="p-4 border-bottom">
                <h3 class="fw-bold mb-0">KomikKami</h3>
            </div>

            <div class="nav flex-column p-3">
                <a href="?aksi=admin_komik"
                    class="nav-link text-white rounded mb-2">
                    <i class="bi bi-book me-2"></i>
                    Komik
                </a>
                <a href="?aksi=admin_user"
                    class="nav-link text-white active bg-white bg-opacity-25 rounded">
                    <i class="bi bi-people me-2"></i>
                    User
                </a>
            </div>

        </aside>

        <main class="flex-grow-1">

            <nav class="bg-danger rounded-4 m-4 px-4 py-3 d-flex justify-content-between align-items-center">
                <h4 class="text-white mb-0 title">Manajemen User</h4>

                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle px-4 py-2 rounded-2 shadow-sm"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <i class="bi bi-person-circle me-2"></i>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo htmlspecialchars($_SESSION['username']);
                        } else {
                            echo "Guest";
                        }
                        ?>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

                        <!-- Selalu tampil -->
                        <li>
                            <a class="dropdown-item" href="/projekbpw">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>

                        <?php if (!isset($_SESSION['role'])) : ?>

                            <!-- Belum Login -->
                            <li>
                                <a class="dropdown-item" href="?aksi=login">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                            </li>

                        <?php else : ?>

                            <?php if ($_SESSION['role'] == 'admin') : ?>

                                <!-- Hanya Admin -->
                                <li>
                                    <a class="dropdown-item" href="?aksi=admin_komik">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>

                            <?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Semua yang sudah login -->
                            <li>
                                <a class="dropdown-item text-danger" href="?aksi=logout">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4 mx-2">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">Edit Data User</h3>
                        <p class="text-secondary mb-0">Ubah detail akun pengguna yang tersimpan di sistem.</p>
                    </div>
                    <a href="?aksi=admin_user" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger shadow-sm">
                        <i class="bi bi-exclamation-triangle me-2"></i> <?= $_SESSION['error'];
                                                                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <form action="?aksi=admin_user_update" method="POST">

                            <input type="hidden" name="id_users" value="<?= $user['id_users']; ?>">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text"
                                    name="username"
                                    class="form-control"
                                    value="<?= $user['username']; ?>"
                                    required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Password Baru</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Ketik password baru">
                                    <div class="form-text text-danger">Biarkan kosong jika tidak ingin mengubah password saat ini.</div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User Biasa</option>
                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="mt-2 mb-4">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="?aksi=admin_user" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-floppy me-1"></i> Perbarui User
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>