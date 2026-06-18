<?php
// PendaftaranReguler.php
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    private $pilihanProdi;
    private $lokasiKampus;

    public function __construct($id, $nama, $sekolah, $nilai, $biaya_dasar, $prodi = null, $kampus = null) {
        parent::__construct($id, $nama, $sekolah, $nilai, $biaya_dasar);
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $kampus;
    }

    // Implementasi Query Spesifik
    public static function getDaftarReguler($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Overriding Polimorfisme
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar; // Tarif standar murni
    }

    public function tampilkanInfoJalur() {
        return "Prodi: " . $this->pilihanProdi . " | Lokasi: " . $this->lokasiKampus;
    }
}
?>