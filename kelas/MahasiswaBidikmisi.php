<?php
// kelas/MahasiswaBidikmisi.php
require_once "Mahasiswa.php";

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($id, $nama, $nim, $smt, $ukt, $kip, $danaSaku) {
        parent::__construct($id, $nama, $nim, $smt, $ukt);
        $this->nomorKipKuliah  = $kip;
        $this->danaSakuSubsidi = $danaSaku;
    }

    // Query Spesifik Bidikmisi
    public static function getDaftarBidikmisi($db) {
        $query = $db->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tahap 5: Overriding Perhitungan Biaya (Gratis penuh)
    public function hitungTagihanSemester() {
        return 0;
    }

    public function tampilSpesifikasiAkademik() {
        return "No KIP-K: " . $this->nomorKipKuliah . " | Subsidi Saku: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }
}
?>