<?php
// kelas/Mahasiswa.php
abstract class Mahasiswa {
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;

    // Constructor untuk memetakan data dari database ke properti objek
    public function __comstruct($id, $nama, $nim, $smt, $ukt) {
        $this->id_mahasiswa   = $id;
        $this->nama_mahasiswa = $nama;
        $this->nim            = $nim;
        $this->semester       = $smt;
        $this->tarifUktNominal = $ukt;
    }

    // Metode Getter untuk menampilkan data global di halaman View
    public function getIdMahasiswa() { return $this->id_mahasiswa; }
    public function getNamaMahasiswa() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }

    // Deklarasi Metode Abstrak (Wajib tanpa body {})
    abstract public function hitungTagihanSemester();
    abstract public function tampilSpesifikasiAkademik();
}
?>