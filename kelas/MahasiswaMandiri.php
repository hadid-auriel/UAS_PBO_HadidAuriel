<?php
// kelas/MahasiswaMandiri.php
require_once "Mahasiswa.php";

class MahasiswaMandiri extends Mahasiswa {
    private $golonganUkt;
    private $namaWali;

    public function __construct($id, $nama, $nim, $smt, $ukt, $golongan, $wali) {
        parent::__construct($id, $nama, $nim, $smt, $ukt);
        $this->golonganUkt = $golongan;
        $this->namaWali    = $wali;
    }

    // Query Spesifik Mandiri
    public static function getDaftarMandiri($db) {
        $query = $db->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tahap 5: Overriding Perhitungan Biaya
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal + 100000;
    }

    // Tahap 5: Overriding Spesifikasi Akademik
    public function tampilSpesifikasiAkademik() {
        return "Golongan UKT: " . $this->golonganUkt . " | Wali: " . $this->namaWali;
    }
}
?>