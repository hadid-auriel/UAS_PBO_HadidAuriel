<?php
// ============================================================
//  TAHAP 3 – ABSTRAKSI (Abstraction)
//  File   : Mahasiswa.php
//  Kelas  : Mahasiswa (Abstract Class)
//  Deskripsi:
//    Kelas abstrak induk yang mendefinisikan kontrak umum
//    semua mahasiswa. Properti dienkapsulasi dengan modifier
//    'protected' sehingga hanya dapat diakses oleh kelas
//    turunan. Nama properti dipetakan 1:1 ke kolom database.
// ============================================================

abstract class Mahasiswa
{
    // ──────────────────────────────────────────────────────
    // PROPERTI TERENKAPSULASI (Protected)
    // Dipetakan langsung dari kolom tabel_mahasiswa :
    //   id_mahasiswa       → $id_mahasiswa
    //   nama_mahasiswa     → $nama_mahasiswa
    //   nim                → $nim
    //   semester           → $semester
    //   tarif_ukt_nominal  → $tarifUktNominal
    // ──────────────────────────────────────────────────────
    protected int    $id_mahasiswa;
    protected string $nama_mahasiswa;
    protected string $nim;
    protected int    $semester;
    protected int    $tarifUktNominal;   // ← tarif_ukt_nominal (INT di DB)

    // ──────────────────────────────────────────────────────
    // CONSTRUCTOR
    // ──────────────────────────────────────────────────────
    public function __construct(
        int    $id_mahasiswa,
        string $nama_mahasiswa,
        string $nim,
        int    $semester,
        int    $tarifUktNominal
    ) {
        $this->id_mahasiswa    = $id_mahasiswa;
        $this->nama_mahasiswa  = $nama_mahasiswa;
        $this->nim             = $nim;
        $this->semester        = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // ──────────────────────────────────────────────────────
    // GETTER (Public Accessor) – agar View dapat membaca
    //         properti protected tanpa melanggar enkapsulasi
    // ──────────────────────────────────────────────────────
    public function getIdMahasiswa():   int    { return $this->id_mahasiswa;   }
    public function getNamaMahasiswa(): string { return $this->nama_mahasiswa; }
    public function getNim():           string { return $this->nim;            }
    public function getSemester():      int    { return $this->semester;       }
    public function getTarifUktNominal(): int { return $this->tarifUktNominal; }

    // ──────────────────────────────────────────────────────
    // METODE ABSTRAK – wajib di-override oleh setiap subclass
    // ──────────────────────────────────────────────────────

    /**
     * Menghitung total tagihan semester berdasarkan skema
     * pembiayaan masing-masing mahasiswa.
     * @return float  Total tagihan dalam rupiah.
     */
    abstract public function hitungTagihanSemester(): int;

    /**
     * Menampilkan spesifikasi akademik unik sesuai
     * kategori pembiayaan mahasiswa.
     * @return string  HTML / teks spesifikasi.
     */
    abstract public function tampilSpesifikasiAkademik(): string;
}
