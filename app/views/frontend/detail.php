<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Komik - KomikKami</title>
    <link rel="stylesheet" href="public/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-4" style="padding-bottom: 40px;">
        <!-- Navbar -->
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
                            <li>
                                <a class="dropdown-item" href="?aksi=admin_komik">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                        <?php endif; ?>
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
        <!-- Main Content Section -->
        <main class="bg-white rounded-4 mt-4 p-4 shadow-sm border">
            <div class="row g-4 align-items-start">

                <!-- Cover -->
                <div class="col-md-4 col-lg-3 text-center">
                    <img src="img/<?= $komik['gambar']; ?>"
                        alt="<?= $komik['judul']; ?>"
                        class="img-fluid rounded-4 shadow-sm border border-black"
                        style="max-width:240px; width:100%; object-fit:cover;">
                </div>

                <!-- Informasi -->
                <div class="col-md-8 col-lg-9">

                    <!-- Judul -->
                    <h2 class="fw-bold mb-3">
                        <?= $komik['judul']; ?>
                    </h2>

                    <!-- Status -->
                    <span class="badge rounded-2 px-3 py-2 <?= $komik['status'] == 'Ongoing' ? 'bg-danger' : 'bg-success'; ?>">
                        <?= strtoupper($komik['status']); ?>
                    </span>

                    <!-- Detail -->
                    <table class="table table-borderless mt-4 mb-4">
                        <tbody>

                            <tr>
                                <td width="140" class="text-muted">
                                    <i class="bi bi-person-fill me-2"></i>Author
                                </td>
                                <td>: <?= $komik['author']; ?></td>
                            </tr>

                            <tr>
                                <td class="text-muted">
                                    <i class="bi bi-pencil-fill me-2"></i>Artist
                                </td>
                                <td>: <?= $komik['artist']; ?></td>
                            </tr>

                            <tr>
                                <td class="text-muted">
                                    <i class="bi bi-building me-2"></i>Publisher
                                </td>
                                <td>: <?= $komik['publisher']; ?></td>
                            </tr>

                            <tr>
                                <td class="text-muted">
                                    <i class="bi bi-calendar3 me-2"></i>Released
                                </td>
                                <td>: <?= $komik['tahun_rilis']; ?></td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Genre -->
                    <div>
                        <h6 class="fw-bold mb-3">Genres</h6>

                        <div class="d-flex flex-wrap gap-2">

                            <?php foreach (explode(',', $komik['genre']) as $g): ?>

                                <span class="badge genre-badge rounded-2 bg-light text-danger border border-danger">
                                    <?= trim($g); ?>
                                </span>

                            <?php endforeach; ?>

                        </div>
                    </div>

                </div>

            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">Synopsis</h5>

            <p class="text-secondary lh-lg" style="text-align:justify;">
                <?= nl2br($komik['sinopsis']); ?>
            </p>

            <hr class="my-4 text-muted">

            <div class="mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Daftar Chapter</h5>

                    <stron class="text-muted small">Total: <strong><?= count($chapters); ?> </strong>Chapter</stron>
                </div>


                <?php if (isset($_SESSION['id_users'])) : ?>
                    <div class="list-group shadow-sm" style="max-height: 400px; overflow-y: auto;">

                        <?php if (empty($chapters)) : ?>
                            <div class="text-center py-4 text-muted">
                                Belum ada chapter yang tersedia untuk komik ini.
                            </div>
                        <?php else : ?>

                            <?php foreach ($chapters as $c) : ?>
                                <a href="?aksi=read&id_chapter=<?= $c['id_chapter']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <strong class="d-block text-dark">Chapter <?= $c['nomor_chapter']; ?></strong>

                                        <small class="text-muted">
                                            <?= $c['judul_chapter'] != '' ? $c['judul_chapter'] : 'Tanpa Judul'; ?>
                                        </small>
                                    </div>
                                    <span class="badge bg-danger rounded-2 py-2 px-2">Baca <i class="bi bi-arrow-right ms-1"></i></span>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php else :  ?>
                    <?php foreach ($chapters as $c) : ?>
                        <a href="?aksi=login" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <div>
                                <strong class="d-block text-dark">Chapter <?= $c['nomor_chapter']; ?></strong>

                                <small class="text-muted">
                                    <?= $c['judul_chapter'] != '' ? $c['judul_chapter'] : 'Tanpa Judul'; ?>
                                </small>
                            </div>
                            <span class="badge bg-danger py-2 px-4 rounded-2">Baca <i class="bi bi-arrow-right ms-1"></i></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-danger text-white py-3 ">
        <div class="container d-flex justify-content-between align-items-center">
            <strong class="mb-0 fw-bold">&copy; KomikKami 2026</strong>
            <p class="mb-0">Dibuat dengan kasih sayang 🤗 </p>
            <p class="mb-0">(plis tinggiin nilai saya bang)</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>