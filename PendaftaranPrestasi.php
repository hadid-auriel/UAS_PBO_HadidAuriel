<?php
// PendaftaranPrestasi.php
require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    private $jenisPrestasi;
    private $tingkatPrestasi;

    public function __construct($id, $nama, $sekolah, $nilai, $biaya_dasar, $jenis = null, $tingkat = null) {
        parent::__construct($id, $nama, $sekolah, $nilai, $biaya_dasar);
        $this->jenisPrestasi = $jenis;
        $this->tingkatPrestasi = $tingkat;
    }

    // Implementasi Query Spesifik
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Overriding Polimorfisme
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar - 50000; // Potongan insentif prestasi
    }

    public function tampilkanInfoJalur() {
        return "Prestasi: " . $this->jenisPrestasi . " (" . $this->tingkatPrestasi . ")";
    }
}
?>