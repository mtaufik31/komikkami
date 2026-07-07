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
                            <h3 class="fw-bold mb-1">Upload Chapter Baru</h3>
                            <p class="text-secondary mb-0">Format file yang diterima hanya berupa arsip (.zip).</p>
                        </div>
                        <a href="?aksi=admin_chapter&id_komik=<?= $_GET['id_komik']; ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'];
                                                        unset($_SESSION['error']); ?></div>
                    <?php endif; ?>

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form action="?aksi=admin_chapter_add&id_komik=<?= $_GET['id_komik']; ?>" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Nomor Chapter</label>
                                        <input type="number" step="0.1" name="nomor_chapter" class="form-control" placeholder="Contoh: 1, 1.5, 2" required>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label fw-semibold">Judul Chapter (Opsional)</label>
                                        <input type="text" name="judul_chapter" class="form-control" placeholder="Contoh: Pertemuan Tak Terduga" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">File ZIP Chapter</label>
                                    <input type="file" name="file_zip" class="form-control" accept=".zip" required>
                                    <div class="form-text text-danger">Pastikan di dalam ZIP langsung berisi gambar berurutan (01.jpg, 02.jpg, dst), jangan di dalam folder lagi.</div>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-upload me-1"></i> Ekstrak & Simpan Chapter</button>
                                </div>
                            </form>
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