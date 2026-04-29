<?php
$old = [];
if (isset($_GET['data'])) {
    $old = json_decode(base64_decode($_GET['data']), true) ?? [];
}

function old($key, $default = '') {
    global $old;
    return htmlspecialchars($old[$key] ?? $default);
}

function oldChecked($key, $value) {
    global $old;
    $data = $old[$key] ?? [];
    return in_array($value, (array)$data) ? 'checked' : '';
}

function oldSelected($key, $value) {
    global $old;
    return ($old[$key] ?? '') === $value ? 'selected' : '';
}

$errors = [];
if (!empty($_GET['errors'])) {
    $errors = json_decode(base64_decode($_GET['errors']), true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Biodata Mahasiswa | Tugas 3B</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { background-color: #f4f7f6; }
        .form-container {
            border-top: 5px solid #0d6efd; 
            background: #ffffff;
        }
        .section-header {
            color: #212529;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .form-label { font-size: 0.9rem; margin-bottom: 0.3rem; }
        .btn-submit {
            background-color: #212529;
            border: none;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: #0d6efd;
            transform: translateY(-2px);
        }
        .badge-hobi { font-weight: 500; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Formulir Biodata Mahasiswa</h2>
                <p class="text-muted">Lengkapi data di bawah ini untuk lanjut ke rekap nilai</p>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center mb-2">
                    <strong class="me-2">⚠️ Validasi Gagal:</strong>
                </div>
                <ul class="mb-0 small">
                    <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="form-container rounded-3 p-4 p-md-5 shadow-sm">
                <form action="hasil.php" method="POST">
                    
                    <div class="section-header">
                        <i class="me-2">👤</i> Informasi Pribadi
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-7">
                            <label for="nama" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" id="nama" name="nama" 
                                   placeholder="Contoh: Andre Astamam" value="<?= old('nama') ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="nim" class="form-label fw-semibold text-secondary">NIM</label>
                            <input type="text" class="form-control form-control-lg" id="nim" name="nim" 
                                   placeholder="F1D024XXX" value="<?= old('nim') ?>">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="nama@student.unram.ac.id" value="<?= old('email') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label fw-semibold text-secondary">No. WhatsApp</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" 
                                   placeholder="0853..." value="<?= old('telepon') ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold text-secondary">Alamat Domisili</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2" 
                                  placeholder="Jl. Raya Mataram No. X"><?= old('alamat') ?></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary d-block">Jenis Kelamin</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="jenis_kelamin" id="laki" value="Laki-laki" <?= oldChecked('jenis_kelamin', 'Laki-laki') ?>>
                                <label class="btn btn-outline-primary" for="laki">Laki-laki</label>

                                <input type="radio" class="btn-check" name="jenis_kelamin" id="perempuan" value="Perempuan" <?= oldChecked('jenis_kelamin', 'Perempuan') ?>>
                                <label class="btn btn-outline-primary" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jurusan" class="form-label fw-semibold text-secondary">Program Studi</label>
                            <select class="form-select" id="jurusan" name="jurusan">
                                <option value="" disabled <?= old('jurusan') === '' ? 'selected' : '' ?>>-- Pilih Jurusan --</option>
                                <option value="Teknik Informatika" <?= oldSelected('jurusan','Teknik Informatika') ?>>Teknik Informatika</option>
                                <option value="Sistem Informasi" <?= oldSelected('jurusan','Sistem Informasi') ?>>Sistem Informasi</option>
                                <option value="Teknik Elektro" <?= oldSelected('jurusan','Teknik Elektro') ?>>Teknik Elektro</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-header">
                        <i class="me-2">🎨</i> Minat & Hobi
                    </div>

                    <div class="mb-5">
                        <div class="row g-2">
                            <?php 
                            $hobiList = ['Coding','Gaming','Musik','Travelling','Olahraga','Desain'];
                            foreach ($hobiList as $h): 
                            ?>
                            <div class="col-6 col-md-4">
                                <div class="form-check p-2 border rounded-2 ps-5">
                                    <input class="form-check-input" type="checkbox" name="hobi[]" 
                                           id="hobi_<?= $h ?>" value="<?= $h ?>" <?= oldChecked('hobi', $h) ?>>
                                    <label class="form-check-label badge-hobi" for="hobi_<?= $h ?>"><?= $h ?></label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-submit btn-lg text-white">
                            Simpan & Lihat Tabel →
                        </button>
                        <button type="reset" class="btn btn-link btn-sm text-decoration-none text-muted">Reset Formulir</button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>

</body>
</html>