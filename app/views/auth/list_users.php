<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - List User</title>
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
                <h4 class="text-white mb-0 title">Daftar User</h4>

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
                        <li>
                            <a class="dropdown-item" href="/projekbpw">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>

                        <?php if (!isset($_SESSION['role'])) : ?>
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

            <div class="container-fluid px-4">
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">Daftar Pengguna</h3>
                            <p class="text-secondary mb-0">Kelola hak akses pengguna sistem dengan bijak.</p>
                        </div>
                        <a href="?aksi=admin_user_add" class="btn btn-danger">Tambah User Baru</a>
                    </div>

                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert alert-success fw-medium shadow-sm">
                            <i class="bi bi-check-circle me-2"></i> <?= $_SESSION['alert'];
                                                                    unset($_SESSION['alert']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm border-1">
                        <div class="card-body">
                            <table class="table table-bordered table-hover align-middle table-striped">
                                <thead class="table-danger">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Username</th>
                                        <th width="20%">Role</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($users as $u): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="fw-bold"><?= $u['username']; ?></td>
                                            <td>
                                                <span class="badge py-2 <?= $u['role'] == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                                    <?= strtoupper($u['role']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="?aksi=admin_user_delete&id=<?= $u['id_users']; ?>" class="btn btn-sm btn-outline-danger bi bi-trash" onclick="return confirm('Yakin ingin menghapus user ini?');"> Hapus</a>
                                                <a href="?aksi=admin_user_edit&id=<?= $u['id_users']; ?>" class="btn btn-sm btn-outline-warning bi bi-pencil"> Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>