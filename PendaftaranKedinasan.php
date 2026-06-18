<?php
// PendaftaranKedinasan.php
require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    private $skIkatanDinas;
    private $instansiSponsor;

    public function __construct($id, $nama, $sekolah, $nilai, $biaya_dasar, $sk = null, $sponsor = null) {
        parent::__construct($id, $nama, $sekolah, $nilai, $biaya_dasar);
        $this->skIkatanDinas = $sk;
        $this->instansiSponsor = $sponsor;
    }

    // Implementasi Query Spesifik
    public static function getDaftarKedinasan($db) {
        $query = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Overriding Polimorfisme
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar * 1.25; // Surcharge administrasi khusus 25%
    }

    public function tampilkanInfoJalur() {
        return "Sponsor: " . $this->instansiSponsor . " | SK: " . $this->skIkatanDinas;
    }
}
?>