<?php
// index.php
require_once 'koneksi/database.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// Inisialisasi Database
$database = new Database();
$db = $database->getConnection();

// Penarikan data menggunakan metode kueri spesifik per kelas anak
$dataReguler   = PendaftaranReguler::getDaftarReguler($db);
$dataPrestasi  = PendaftaranPrestasi::getDaftarPrestasi($db);
$dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);

// Polimorfik Mapper: Mengubah data raw SQL array menjadi kumpulan Objek konkret
$objekReguler = [];
foreach ($dataReguler as $row) {
    $objekReguler[] = new PendaftaranReguler(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['pilihan_prodi'], $row['lokasi_kampus']
    );
}

$objekPrestasi = [];
foreach ($dataPrestasi as $row) {
    $objekPrestasi[] = new PendaftaranPrestasi(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['jenis_prestasi'], $row['tingkat_prestasi']
    );
}

$objekKedinasan = [];
foreach ($dataKedinasan as $row) {
    $objekKedinasan[] = new PendaftaranKedinasan(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['sk_ikatan_dinas'], $row['instansi_sponsor']
    );
}

// Array master untuk iterasi View terkelompok
$kategoriTampilan = [
    'Jalur Reguler' => $objekReguler,
    'Jalur Prestasi' => $objekPrestasi,
    'Jalur Kedinasan' => $objekKedinasan
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMB Jalur Spesifik - Hadid Auriel</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        .section-box { background: #fff; padding: 25px; margin-bottom: 35px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #2ecc71; }
        .section-box.prestasi { border-left-color: #3498db; }
        .section-box.kedinasan { border-left-color: #9b59b6; }
        h2 { margin-top: 0; color: #34495e; font-size: 1.4rem; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; }
        th, td { padding: 12px 15px; text-align: left; border: 1px solid #e1e8ed; }
        th { background-color: #f4f6f8; color: #5c6873; font-weight: 600; }
        tr:nth-child(even) { background-color: #f9fbfd; }
        .badge-info { font-size: 0.9rem; color: #555; background: #edf2f7; padding: 4px 8px; border-radius: 4px; display: inline-block; }
        .total-price { font-weight: bold; color: #27ae60; }
    </style>
</head>
<body>

    <h1>Sistem Manajemen Pendaftaran Mahasiswa Baru (PMB) Jalur Spesifik</h1>

    <?php foreach ($kategoriTampilan as $namaJalur => $kumpulanObjek): ?>
        <?php 
            // Mengatur kelas warna CSS penanda berdasarkan nama jalur
            $cssClass = 'reguler';
            if(strpos($namaJalur, 'Prestasi') !== false) $cssClass = 'prestasi';
            if(strpos($namaJalur, 'Kedinasan') !== false) $cssClass = 'kedinasan';
        ?>
        
        <div class="section-box <?php echo $cssClass; ?>">
            <h2>Data Rekapitulasi: <?php echo $namaJalur; ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Biaya Dasar</th>
                        <th>Spesifikasi & Keterangan Atribut Jalur (Unik)</th>
                        <th>Total Biaya Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kumpulanObjek)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; color: #999; font-style: italic;">Tidak ada data pendaftaran pada jalur ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kumpulanObjek as $maba): ?>
                            <tr>
                                <td><?php echo $maba->getIdPendaftaran(); ?></td>
                                <td><strong><?php echo htmlspecialchars($maba->getNamaCalon()); ?></strong></td>
                                <td><?php echo htmlspecialchars($maba->getAsalSekolah()); ?></td>
                                <td><?php echo $maba->getNilaiUjian(); ?></td>
                                <td>Rp <?php echo number_format($maba->getBiayaDasar(), 0, ',', '.'); ?></td>
                                
                                <td><span class="badge-info"><?php echo htmlspecialchars($maba->tampilkanInfoJalur()); ?></span></td>
                                
                                <td class="total-price">Rp <?php echo number_format($maba->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

</body>
</html>