<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membaca Chapter <?= $chapter['nomor_chapter']; ?> - <?= $komik['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-dark text-white">
    <nav class="navbar sticky-top bg-black shadow">
        <div class="container navbar-expand-lg d-flex me-auto justify-content-between align-items-center">
            <a href="?aksi=detail&id=<?= $komik['id_komik']; ?>" class="text-white text-decoration-none">
                <i class="bi bi-arrow-left text-danger fs-4"></i>
            </a>
            <div class="text-center mx-3 text-truncate">
                <h6 class="mb-0 fw-bold"><?= $komik['judul']; ?></h6>
                <small class="text-secondary">Chapter <?= $chapter['nomor_chapter']; ?>: <?= $chapter['judul_chapter']; ?></small>
            </div>
            <a href="?aksi=home" class="text-white text-decoration-none">
                <i class="bi bi-house fs-4 text-danger"></i>
            </a>
        </div>
    </nav>

    <main class="container py-4 text-center">
        <div class="mx-auto" style="max-width: 800px;"> <?php if (empty($images)): ?>
                <div class="text-center py-5">
                    <h5 class="text-muted">Gambar tidak ditemukan di dalam chapter ini.</h5>
                </div>
            <?php else: ?>
                <?php foreach ($images as $img): ?>
                    <img src="<?= $folder_path . $img; ?>" class="img-fluid mb-0 d-block mx-auto w-100" alt="Halaman Komik">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <div class="text-center py-5">
        <a href="?aksi=detail&id=<?= $komik['id_komik']; ?>" class="btn btn-outline-light px-5 py-2 rounded-pill">
            <i class="bi bi-list me-2"></i> Kembali ke Daftar Chapter
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>