<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - KomikKami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-1 rounded-4 p-4">
                    <h3 class="text-center fw-bold mb-4 text-danger">KomikKami</h3>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger py-2 text-center"><?= $_SESSION['error'];
                                                                            unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success py-2 text-center"><?= $_SESSION['success'];
                                                                            unset($_SESSION['success']); ?></div>
                    <?php endif; ?>

                    <form action="?aksi=login" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control rounded-3" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-bold rounded-3">Masuk</button>
                    </form>
                    <div class="text-center mt-3">
                        <small>Belum punya akun? <a href="?aksi=register" class="text-danger text-decoration-none fw-bold">Daftar sekarang</a></small><br>
                        <small><a href="?aksi=home" class="text-secondary text-decoration-none">Kembali ke Beranda</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>