<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Komik</title>
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
            <nav class="bg-danger rounded-4 mx-4 mt-4 mb-3 px-4 py-3 d-flex justify-content-between align-items-center">

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

            <div class="container-fluid p-2">

                <div class="container-fluid px-4">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>
                            <h3 class="fw-bold mb-1">
                                Tambah Komik Baru
                            </h3>

                            <p class="text-secondary mb-0">
                                Tambahkan data komik ke dalam sistem.
                            </p>
                        </div>

                        <a href="?aksi=admin_komik" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>

                    </div>

                    <?php if (isset($_SESSION['error'])): ?>

                        <div class="alert alert-danger">

                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>

                        </div>

                    <?php endif; ?>

                    <div class="card shadow-sm border-0">

                        <div class="card-body p-4">

                            <form action="?aksi=admin_komik_add" method="POST" enctype="multipart/form-data">

                                <!-- Judul -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Judul Komik
                                    </label>

                                    <input type="text"
                                        name="judul"
                                        class="form-control"
                                        placeholder="Masukkan judul komik"
                                        required>

                                </div>

                                <!-- Author Artist -->
                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-semibold">
                                            Author
                                        </label>

                                        <input type="text"
                                            name="author"
                                            class="form-control"
                                            placeholder="Nama author"
                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label fw-semibold">
                                            Artist
                                        </label>

                                        <input type="text"
                                            name="artist"
                                            class="form-control"
                                            placeholder="Nama artist"
                                            required>

                                    </div>

                                </div>

                                <!-- Publisher -->
                                <div class="row">

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label fw-semibold">
                                            Publisher
                                        </label>

                                        <input type="text"
                                            name="publisher"
                                            class="form-control"
                                            placeholder="Publisher"
                                            required>

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label fw-semibold">
                                            Tahun Rilis
                                        </label>

                                        <input type="number"
                                            name="tahun_rilis"
                                            class="form-control"
                                            placeholder="2025"
                                            required>

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label fw-semibold">
                                            Status
                                        </label>

                                        <select name="status" class="form-select">

                                            <option value="Ongoing">
                                                Ongoing
                                            </option>

                                            <option value="Completed">
                                                Completed
                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <!-- Genre -->
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Genre
                                    </label>

                                    <input type="text"
                                        name="genre"
                                        class="form-control"
                                        placeholder="Drama, Romance, Mystery"
                                        required>

                                    <div class="form-text">
                                        Pisahkan genre menggunakan tanda koma (,)
                                    </div>

                                </div>

                                <!-- Sinopsis -->
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Sinopsis
                                    </label>

                                    <textarea
                                        name="sinopsis"
                                        rows="6"
                                        class="form-control"
                                        placeholder="Masukkan sinopsis komik..."
                                        required></textarea>

                                </div>

                                <!-- Cover -->
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Cover Komik
                                    </label>

                                    <input type="file"
                                        name="gambar"
                                        class="form-control"
                                        accept="image/*"
                                        required>

                                </div>

                                <hr>

                                <div class="d-flex justify-content-end gap-2">

                                    <a href="?aksi=admin_komik"
                                        class="btn btn-outline-secondary">

                                        Batal

                                    </a>

                                    <button type="submit"
                                        class="btn btn-danger">

                                        <i class="bi bi-floppy me-1"></i>

                                        Simpan Komik

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>