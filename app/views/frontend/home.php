<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KomikKami</title>
    <link rel="stylesheet" href="public/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-4">
        <?php if (isset($_GET['error']) && $_GET['error'] == 'akses') : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Akses Ditolak!</strong> Halaman ini hanya dapat diakses oleh administrator.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

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
            <?php unset($_SESSION['success']);
            ?>
        <?php endif; ?>
        <nav class="bg-danger rounded-4 px-4 py-3 d-flex justify-content-between align-items-center">

            <h4 class="text-white mb-0 title">KomikKami</h4>

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
                        echo "Login";
                    }
                    ?>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                    <?php if (!isset($_SESSION['role'])) : ?>

                        <!-- Belum Login -->
                        <li>
                            <a class="dropdown-item" href="?aksi=login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?aksi=register">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Register
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
                        <!-- Semua yang sudah login -->
                        <li>
                            <a class="dropdown-item" href="/projekbpw">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="?aksi=logout">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>
            </div>
        </nav>

        <main class="flex-grow-1 my-4 d-flex flex-wrap gap-3" style="padding-bottom: 40px;">
            <?php $no = 1;
            foreach ($komik as $k): ?>
                <a href="?aksi=detail&id=<?= $k['id_komik']; ?>" class="card-link-custom">
                    <div class="card mb-3" style="max-width: 419px;">
                        <div class="row g-0 h-100">
                            <div class="col-md-4 d-flex">
                                <img src="img/<?= $k['gambar']; ?>"
                                    class="rounded-start w-100 object-fit-cover"
                                    style="object-fit: cover; min-height: 150px;"
                                    alt="<?= $k['judul']; ?>">
                            </div>

                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100 px-3 py-3">
                                    <h5 class="card-title mb-2">
                                        <?= $k['judul']; ?>
                                    </h5>
                                    <p class="card-text text-secondary text-clamp-2 mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 0.875rem; line-height: 1.4;">
                                        <?= $k['sinopsis']; ?>
                                    </p>
                                    <div class="mt-auto">
                                        <div class="mb-2">
                                            <span class="badge bg-success rounded-2 px-3 py-2 <?= $k['status'] == 'Ongoing' ? 'bg-danger' : 'bg-success' ?>">
                                                <?= strtoupper($k['status']); ?>
                                            </span>
                                        </div>
                                        <p class="small text-muted mb-1">
                                            <strong>Author</strong> :
                                            <?= $k['author']; ?>
                                        </p>
                                        <p class="small text-muted mb-0">
                                            <strong>Publisher</strong> :
                                            <?= $k['publisher']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </main>

        <footer class="bg-danger text-white py-3 mt-4 fixed-bottom">
            <div class="container d-flex justify-content-between align-items-center">
                <strong class="mb-0 text-bold">&copy; KomikKami 2026</strong>
                <p class="mb-0">Dibuat dengan kasih sayang 🤗 </p>
                <p class="mb-0">(plis tinggiin nilai saya bang)</p>
            </div>
        </footer>

    </div>
    <script src="public/assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>