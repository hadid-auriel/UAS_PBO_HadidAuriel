<?php
// ============================================================
//  TAHAP 4 – PEWARISAN (Inheritance)
//  TAHAP 5 – POLIMORFISME / OVERRIDING
//  File   : MahasiswaBidikmisi.php
//  Kelas  : MahasiswaBidikmisi extends Mahasiswa
//
//  Skema tagihan  : 0 (GRATIS – ditanggung negara)
// ============================================================

require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa
{
    // ──────────────────────────────────────────────────────
    // PROPERTI TAMBAHAN SPESIFIK BIDIKMISI
    // Dipetakan dari kolom: nomor_klip_kuliah, dana_saku_subsidi
    // ──────────────────────────────────────────────────────
    private string $nomorKipKuliah;   // ← nomor_klip_kuliah
    private int    $danaSakuSubsidi;  // ← dana_saku_subsidi

    // ──────────────────────────────────────────────────────
    // CONSTRUCTOR
    // ──────────────────────────────────────────────────────
    public function __construct(
        int    $id_mahasiswa,
        string $nama_mahasiswa,
        string $nim,
        int    $semester,
        int    $tarifUktNominal,
        string $nomorKipKuliah,
        int    $danaSakuSubsidi
    ) {
        parent::__construct(
            $id_mahasiswa,
            $nama_mahasiswa,
            $nim,
            $semester,
            $tarifUktNominal
        );
        $this->nomorKipKuliah  = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // ──────────────────────────────────────────────────────
    // GETTER SPESIFIK
    // ──────────────────────────────────────────────────────
    public function getNomorKipKuliah():  string { return $this->nomorKipKuliah;  }
    public function getDanaSakuSubsidi(): int  { return $this->danaSakuSubsidi; }

    // ──────────────────────────────────────────────────────
    // QUERY SELECT-WHERE  (ambil data Bidikmisi dari DB)
    // ──────────────────────────────────────────────────────
    /**
     * Mengambil seluruh baris Mahasiswa Bidikmisi dari database.
     * @param  PDO   $pdo  Koneksi database aktif.
     * @return array       Array of MahasiswaBidikmisi objects.
     */
    public static function fetchFromDB(PDO $pdo): array
    {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester,
                       tarif_ukt_nominal, nomor_klip_kuliah, dana_saku_subsidi
                FROM   tabel_mahasiswa
                WHERE  jenis_pembiayaan = 'Bidikmisi'
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
                        $row['nomor_klip_kuliah']  ?? '-',
                (int)  ($row['dana_saku_subsidi']  ?? 0)
            );
        }
        return $result;
    }

    // ──────────────────────────────────────────────────────
    // TAHAP 5 – OVERRIDE: hitungTagihanSemester()
    // Logika: total = 0  (gratis penuh, ditanggung negara)
    // ──────────────────────────────────────────────────────
    public function hitungTagihanSemester(): int
    {
        return 0;
    }

    // ──────────────────────────────────────────────────────
    // OVERRIDE: tampilSpesifikasiAkademik()
    // ──────────────────────────────────────────────────────
    public function tampilSpesifikasiAkademik(): string
    {
        return "No. KIP Kuliah : <strong>{$this->nomorKipKuliah}</strong> &nbsp;|&nbsp; "
             . "Dana Saku Subsidi : <strong>Rp "
             . number_format($this->danaSakuSubsidi, 0, ',', '.')
             . " / bulan</strong>";
    }
}
