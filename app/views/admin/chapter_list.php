<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - List Komik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <div class="d-flex">

        <!-- Sidebar -->
        <aside class="bg-danger text-white d-flex flex-column shadow"
            style="width:250px; min-height:100vh;">

            <div class="p-4 border-bottom">
                <h3 class="fw-bold mb-0">KomikKami</h3>
            </div>

            <div class="nav flex-column p-3">

                <a href="?aksi=admin_komik"
                    class="nav-link text-white active bg-white bg-opacity-25 rounded mb-2">

                    <i class="bi bi-book me-2"></i>
                    Komik

                </a>

                <a href="?aksi=admin_user"
                    class="nav-link text-white rounded">

                    <i class="bi bi-people me-2"></i>
                    User

                </a>

            </div>

        </aside>

        <!-- Content -->
        <main class="flex-grow-1">

            <!-- Navbar -->
            <nav class="bg-danger rounded-4 m-4 px-4 py-3 d-flex justify-content-between align-items-center">

                <h4 class="text-white mb-0 title">Daftar Komik</h4>

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

            <div class="container-fluid px-4">

                <?php if (isset($_SESSION['success'])) : ?>
                    <?php if ($_SESSION['success'] == 'login') : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>Selamat Datang!</strong> Anda berhasil login sebagai <?= htmlspecialchars($_SESSION['username']); ?>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php elseif ($_SESSION['success'] == 'logout') : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <strong>Berhasil!</strong> Anda telah logout dari sistem.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php unset($_SESSION['success']); // Hapus session agar tidak muncul terus-menerus 
                    ?>
                <?php endif; ?>
                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">Daftar Chapter: <?= $komik['judul']; ?></h3>
                            <a href="?aksi=admin_komik" class="text-danger text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke List Komik</a>
                        </div>
                        <a href="?aksi=admin_chapter_add&id_komik=<?= $komik['id_komik']; ?>" class="btn btn-danger">Upload Chapter ZIP</a>
                    </div>

                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['alert'];
                                                            unset($_SESSION['alert']); ?></div>
                    <?php endif; ?>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-danger">
                                    <tr>
                                        <th width="10%">Chapter</th>
                                        <th>Judul Chapter</th>
                                        <th>Path Folder</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($chapters)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada chapter diupload.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($chapters as $c): ?>
                                            <tr>
                                                <td class="fw-bold text-center">Ch. <?= $c['nomor_chapter']; ?></td>
                                                <td><?= $c['judul_chapter']; ?></td>
                                                <td><code><?= $c['content_path']; ?></code></td>
                                                <td>
                                                    <a href="?aksi=admin_chapter_delete&id_chapter=<?= $c['id_chapter']; ?>&id_komik=<?= $komik['id_komik']; ?>"
                                                        class="btn btn-sm btn-outline-danger bi bi-trash"
                                                        onclick="return confirm('Yakin hapus chapter ini?');"> Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>

    <script src="public/assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>