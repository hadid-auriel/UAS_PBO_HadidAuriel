<?php
// ============================================================
//  TAHAP 4 – PEWARISAN (Inheritance)
//  TAHAP 5 – POLIMORFISME / OVERRIDING
//  File   : MahasiswaMandiri.php
//  Kelas  : MahasiswaMandiri extends Mahasiswa
//
//  Skema tagihan  : tarifUktNominal + 100.000
//  (biaya operasional kemahasiswaan/praktikum)
// ============================================================

require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa
{
    // ──────────────────────────────────────────────────────
    // PROPERTI TAMBAHAN SPESIFIK MANDIRI
    // Dipetakan dari kolom: golongan_ukt, nama_wali
    // ──────────────────────────────────────────────────────
    private string $golonganUkt;   // ← golongan_ukt
    private string $namaWali;      // ← nama_wali

    // Biaya tambahan operasional/praktikum (tetap)
    private const BIAYA_OPERASIONAL = 100000;

    // ──────────────────────────────────────────────────────
    // CONSTRUCTOR
    // ──────────────────────────────────────────────────────
    public function __construct(
        int    $id_mahasiswa,
        string $nama_mahasiswa,
        string $nim,
        int    $semester,
        int    $tarifUktNominal,
        string $golonganUkt,
        string $namaWali
    ) {
        parent::__construct(
            $id_mahasiswa,
            $nama_mahasiswa,
            $nim,
            $semester,
            $tarifUktNominal
        );
        $this->golonganUkt = $golonganUkt;
        $this->namaWali    = $namaWali;
    }

    // ──────────────────────────────────────────────────────
    // GETTER SPESIFIK
    // ──────────────────────────────────────────────────────
    public function getGolonganUkt(): string { return $this->golonganUkt; }
    public function getNamaWali():    string { return $this->namaWali;    }

    // ──────────────────────────────────────────────────────
    // QUERY SELECT-WHERE  (ambil data Mandiri dari DB)
    // ──────────────────────────────────────────────────────
    /**
     * Mengambil seluruh baris Mahasiswa Mandiri dari database.
     * @param  PDO   $pdo  Koneksi database aktif.
     * @return array       Array of MahasiswaMandiri objects.
     */
    public static function fetchFromDB(PDO $pdo): array
    {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester,
                       tarif_ukt_nominal, golongan_ukt, nama_wali
                FROM   tabel_mahasiswa
                WHERE  jenis_pembiayaan = 'Mandiri'
                ORDER  BY id_mahasiswa";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $result[] = new self(
                (int)   $row['id_mahasiswa'],
                        $row['nama_mahasiswa'],
                        $row['nim'],
                (int)   $row['semester'],
                (int)   $row["tarif_ukt_nominal"],
                        $row['golongan_ukt'] ?? '-',
                        $row['nama_wali']    ?? '-'
            );
        }
        return $result;
    }

    // ──────────────────────────────────────────────────────
    // TAHAP 5 – OVERRIDE: hitungTagihanSemester()
    // Logika: total = tarifUktNominal + 100.000
    // ──────────────────────────────────────────────────────
    public function hitungTagihanSemester(): int
    {
        return (int)($this->tarifUktNominal + self::BIAYA_OPERASIONAL);
    }

    // ──────────────────────────────────────────────────────
    // OVERRIDE: tampilSpesifikasiAkademik()
    // ──────────────────────────────────────────────────────
    public function tampilSpesifikasiAkademik(): string
    {
        return "Golongan UKT : <strong>{$this->golonganUkt}</strong> &nbsp;|&nbsp; "
             . "Nama Wali   : <strong>{$this->namaWali}</strong>";
    }
}
