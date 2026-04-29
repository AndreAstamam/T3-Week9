<?php
date_default_timezone_set('Asia/Makassar');

$errors = [];

$nama          = trim($_POST['nama']          ?? '');
$nim           = trim($_POST['nim']           ?? '');
$email         = trim($_POST['email']         ?? '');
$telepon       = trim($_POST['telepon']       ?? '');
$alamat        = trim($_POST['alamat']        ?? '');
$jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');
$jurusan       = trim($_POST['jurusan']       ?? '');
$hobi          = $_POST['hobi']               ?? [];

if ($nama          === '') $errors[] = 'Nama Lengkap wajib diisi.';
if ($nim           === '') $errors[] = 'NIM wajib diisi.';
if ($email         === '') $errors[] = 'Email wajib diisi.';
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
if ($telepon       === '') $errors[] = 'Telepon wajib diisi.';
if ($alamat        === '') $errors[] = 'Alamat wajib diisi.';
if ($jenis_kelamin === '') $errors[] = 'Jenis Kelamin wajib dipilih.';
if ($jurusan       === '') $errors[] = 'Jurusan wajib dipilih.';
if (empty($hobi))          $errors[] = 'Pilih minimal satu Hobi.';

if (!empty($errors)) {
    $errEnc  = base64_encode(json_encode($errors));
    $dataEnc = base64_encode(json_encode($_POST));
    header("Location: form.php?errors={$errEnc}&data={$dataEnc}");
    exit;
}

$dataEnc = base64_encode(json_encode($_POST));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Biodata | Andre Astamam</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { background-color: #f4f7f6; }
        .profile-card {
            background: white;
            border: none;
            border-top: 5px solid #0d6efd;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .data-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            font-weight: 600;
        }
        .data-value {
            font-size: 1.05rem;
            color: #212529;
            font-weight: 500;
        }
        .section-divider {
            height: 1px;
            background: #eee;
            margin: 1.5rem 0;
        }
        .hobi-item {
            background: #e7f1ff;
            color: #0d6efd;
            border: 1px solid #cfe2ff;
            padding: 5px 15px;
            border-radius: 50px;
            display: inline-block;
            font-size: 0.85rem;
            margin: 2px;
        }
        .avatar-circle {
            width: 80px;
            height: 80px;
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            border-radius: 50%;
            margin: 0 auto 15px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold mb-0 text-dark">Review Data Mahasiswa</h4>
                <a href="form.php?data=<?= $dataEnc ?>" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                    &larr; Edit Kembali
                </a>
            </div>

            <div class="profile-card rounded-4 p-4 p-md-5">
                
                <div class="text-center mb-4">
                    <div class="avatar-circle">
                        <?= strtoupper(substr($nama, 0, 1)) ?>
                    </div>
                    <h3 class="fw-bold mb-1"><?= htmlspecialchars($nama) ?></h3>
                    <p class="text-primary fw-medium mb-0"><?= htmlspecialchars($jurusan) ?></p>
                    <span class="text-muted small"><?= htmlspecialchars($nim) ?></span>
                </div>

                <div class="section-divider"></div>

                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="data-label d-block">Jenis Kelamin</label>
                            <span class="data-value"><?= htmlspecialchars($jenis_kelamin) ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="data-label d-block">Kontak WhatsApp</label>
                            <span class="data-value"><?= htmlspecialchars($telepon) ?></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="data-label d-block">Alamat Surel</label>
                            <span class="data-value text-primary"><?= htmlspecialchars($email) ?></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="data-label d-block">Alamat Tinggal</label>
                            <span class="data-value"><?= nl2br(htmlspecialchars($alamat)) ?></span>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="mb-2">
                    <label class="data-label d-block mb-3">Minat & Hobi</label>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($hobi as $h): ?>
                            <span class="hobi-item me-2 mb-2"># <?= htmlspecialchars($h) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="../tugas3c/tabel_nilai.php?jurusan=<?= urlencode($jurusan) ?>" class="btn btn-primary w-100 btn-lg shadow-sm">
                    Lanjut ke Rekap Nilai &rarr;
                    </a>
                </div>

            </div>

            <p class="text-center text-muted mt-4" style="font-size: 0.85rem;">
                Tercatat: <span class="fw-semibold text-dark"><?= date('d F Y, H:i') ?> WITA</span>
            </p>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>