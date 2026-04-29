<?php

$prodi = $_GET['jurusan'] ?? 'Teknik Informatika';
class Mahasiswa {
    public $nama;
    public $nim;
    public $uts;
    public $uas;
    public $na;
    public $grade;

    public function __construct($nama, $nim, $uts, $uas) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->uts = $uts;
        $this->uas = $uas;
        $this->na = ($uts * 0.4) + ($uas * 0.6);
        $this->grade = tentukanGrade($this->na);
    }
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return 'A';
    if ($nilai >= 75) return 'B';
    if ($nilai >= 65) return 'C';
    if ($nilai >= 50) return 'D';
    return 'E';
}

$daftar_mahasiswa = [
    new Mahasiswa("Andre Astamam", "F1D02410103", 85, 90),
    new Mahasiswa("I Made Priyandika Adiyatma Putra Sari", "F1D02410008", 55, 60),
    new Mahasiswa("Revano Januar Adiguna Prawira", "F1D02410146", 40, 45),
    new Mahasiswa("Rendy Wahyu Islami", "F1D02410133", 75, 70),
    new Mahasiswa("Fauzan Hari Ramdani", "F1D02410047", 95, 85)
];

$total_na = 0;
foreach ($daftar_mahasiswa as $mhs) {
    $total_na += $mhs->na;
}
$rata_rata = $total_na / count($daftar_mahasiswa);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 3C: Tabel Nilai Mahasiswa</title>
    <link rel="stylesheet" href="../css/bootstrap.css">

</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Daftar Nilai Mahasiswa <?= htmlspecialchars($prodi) ?></h2>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftar_mahasiswa as $index => $mhs): ?>
                    <tr class="<?php echo ($mhs->na < 60) ? 'table-danger' : ''; ?>">
                    <td class="text-center"><?php echo $index + 1; ?></td>
                    <td><?php echo $mhs->nama; ?></td>
                    <td class="text-center"><?php echo $mhs->nim; ?></td>
                    <td class="text-center"><?php echo $mhs->uts; ?></td>
                    <td class="text-center"><?php echo $mhs->uas; ?></td>
                    <td class="text-center fw-bold"><?php echo number_format($mhs->na, 2); ?></td>
                    <td class="text-center fw-bold"><?php echo $mhs->grade; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="table-secondary">
            <tr>
                <td colspan="5" class="text-end fw-bold">Rata-rata Kelas</td>
                <td colspan="2" class="text-center fw-bold"><?php echo number_format($rata_rata, 2); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>