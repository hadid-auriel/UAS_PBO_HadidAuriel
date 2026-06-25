<?php
// ============================================================
//  TAHAP 6 – ANTARMUKA / VIEW (PHP)
//  File   : index.php
//  Fungsi : Menampilkan daftar registrasi pembayaran kuliah
//           secara dinamis, dikelompokkan per jenis pembiayaan.
// ============================================================

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/Mahasiswa.php';
require_once __DIR__ . '/MahasiswaMandiri.php';
require_once __DIR__ . '/MahasiswaBidikmisi.php';
require_once __DIR__ . '/MahasiswaPrestasi.php';

// ── Ambil data dari DB via masing-masing subclass ──────────
$pdo = getPDO();

/** @var MahasiswaMandiri[]  */ $listMandiri   = MahasiswaMandiri::fetchFromDB($pdo);
/** @var MahasiswaBidikmisi[] */ $listBidikmisi = MahasiswaBidikmisi::fetchFromDB($pdo);
/** @var MahasiswaPrestasi[]  */ $listPrestasi  = MahasiswaPrestasi::fetchFromDB($pdo);

// ── Helper: format rupiah ──────────────────────────────────
function rupiah(int|float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// ── Hitung total tagihan semua kategori (polimorfisme) ─────
function totalTagihan(array $list): float {
    return array_sum(array_map(
        fn(Mahasiswa $m) => $m->hitungTagihanSemester(),
        $list
    ));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pembayaran Kuliah – UAS PBO TI1D</title>
    <style>
        /* ── Reset & Base ─────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #1a202c;
            min-height: 100vh;
        }

        /* ── Header ───────────────────────────────────────── */
        header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            color: #fff;
            padding: 2rem 2.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.25);
        }
        header h1  { font-size: 1.6rem; letter-spacing: .5px; }
        header p   { font-size: .88rem; opacity: .85; margin-top: .3rem; }
        header .badge {
            display: inline-block;
            margin-top: .6rem;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 20px;
            padding: .2rem .85rem;
            font-size: .78rem;
            letter-spacing: .4px;
        }

        /* ── Layout ───────────────────────────────────────── */
        main { max-width: 1300px; margin: 2rem auto; padding: 0 1.5rem 3rem; }

        /* ── Summary Cards ────────────────────────────────── */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2.2rem;
        }
        .summary-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.2rem 1.4rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
            border-left: 5px solid;
        }
        .summary-card.mandiri   { border-color: #e67e22; }
        .summary-card.bidikmisi { border-color: #27ae60; }
        .summary-card.prestasi  { border-color: #8e44ad; }
        .summary-card.total     { border-color: #2980b9; }
        .summary-card .label { font-size: .78rem; color: #718096; text-transform: uppercase; letter-spacing: .6px; }
        .summary-card .value { font-size: 1.45rem; font-weight: 700; margin-top: .3rem; }
        .summary-card .sub   { font-size: .8rem; color: #a0aec0; margin-top: .15rem; }

        /* ── Section ──────────────────────────────────────── */
        .section { margin-bottom: 2.5rem; }
        .section-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }
        .section-header .dot {
            width: 14px; height: 14px; border-radius: 50%;
            flex-shrink: 0;
        }
        .section-header h2 { font-size: 1.15rem; font-weight: 700; }
        .section-header .count {
            margin-left: auto;
            font-size: .8rem;
            background: #edf2f7;
            padding: .2rem .7rem;
            border-radius: 12px;
            color: #4a5568;
        }

        /* ── Table ────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.07); }
        table {
            width: 100%; border-collapse: collapse;
            background: #fff;
            font-size: .875rem;
        }
        thead th {
            padding: .85rem 1rem;
            text-align: left;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #fff;
            white-space: nowrap;
        }
        tbody td {
            padding: .82rem 1rem;
            border-bottom: 1px solid #edf2f7;
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #f7fafc; }

        /* Warna header per kategori */
        .mandiri   thead th { background: #e67e22; }
        .bidikmisi thead th { background: #27ae60; }
        .prestasi  thead th { background: #8e44ad; }

        .mandiri   tbody tr:hover td { background: #fef9f3; }
        .bidikmisi tbody tr:hover td { background: #f0faf4; }
        .prestasi  tbody tr:hover td { background: #f9f3fd; }

        /* Dot warna per kategori */
        .mandiri-dot   { background: #e67e22; }
        .bidikmisi-dot { background: #27ae60; }
        .prestasi-dot  { background: #8e44ad; }

        /* Badge tagihan */
        .tagihan {
            font-weight: 700;
            white-space: nowrap;
        }
        .tagihan.gratis {
            color: #27ae60;
        }
        .tagihan.bayar-penuh {
            color: #c0392b;
        }
        .tagihan.diskon {
            color: #8e44ad;
        }

        /* Badge semester */
        .smt-badge {
            display: inline-block;
            background: #ebf8ff;
            color: #2b6cb0;
            border-radius: 10px;
            padding: .1rem .6rem;
            font-size: .78rem;
            font-weight: 600;
        }

        /* Spesifikasi akademik */
        .spesifikasi {
            font-size: .8rem;
            color: #4a5568;
        }

        /* Zebra */
        tbody tr:nth-child(even) td { background: #fafafa; }

        /* ── Footer ───────────────────────────────────────── */
        footer {
            text-align: center;
            font-size: .8rem;
            color: #a0aec0;
            padding: 1.5rem 0 2rem;
        }

        /* ── Responsive ───────────────────────────────────── */
        @media (max-width: 600px) {
            header h1 { font-size: 1.25rem; }
            .summary-card .value { font-size: 1.15rem; }
        }
    </style>
</head>
<body>

<!-- ══════════════════ HEADER ══════════════════ -->
<header>
    <h1>📋 Sistem Registrasi Pembayaran Kuliah</h1>
    <p>Daftar mahasiswa aktif berdasarkan skema pembiayaan semester</p>
    <span class="badge">DB_UAS_PBO_TI1D_HadidAuriel &nbsp;·&nbsp; Kelas TI1D</span>
</header>

<!-- ══════════════════ MAIN ══════════════════ -->
<main>

    <!-- ── Summary Cards ─────────────────────────────────── -->
    <div class="summary-grid">
        <div class="summary-card mandiri">
            <div class="label">Mahasiswa Mandiri</div>
            <div class="value"><?= count($listMandiri) ?> orang</div>
            <div class="sub">Total Tagihan: <?= rupiah(totalTagihan($listMandiri)) ?></div>
        </div>
        <div class="summary-card bidikmisi">
            <div class="label">Mahasiswa Bidikmisi</div>
            <div class="value"><?= count($listBidikmisi) ?> orang</div>
            <div class="sub">Total Tagihan: <?= rupiah(totalTagihan($listBidikmisi)) ?></div>
        </div>
        <div class="summary-card prestasi">
            <div class="label">Mahasiswa Prestasi</div>
            <div class="value"><?= count($listPrestasi) ?> orang</div>
            <div class="sub">Total Tagihan: <?= rupiah(totalTagihan($listPrestasi)) ?></div>
        </div>
        <div class="summary-card total">
            <div class="label">Total Seluruh Mahasiswa</div>
            <div class="value"><?= count($listMandiri) + count($listBidikmisi) + count($listPrestasi) ?> orang</div>
            <div class="sub">Total Penerimaan: <?= rupiah(
                totalTagihan($listMandiri) +
                totalTagihan($listBidikmisi) +
                totalTagihan($listPrestasi)
            ) ?></div>
        </div>
    </div>


    <!-- ════════════════════════════════════════════════════
         SEKSI 1 – MAHASISWA MANDIRI
    ════════════════════════════════════════════════════ -->
    <div class="section">
        <div class="section-header">
            <span class="dot mandiri-dot"></span>
            <h2>Mahasiswa Mandiri</h2>
            <span class="count"><?= count($listMandiri) ?> mahasiswa</span>
        </div>

        <div class="table-wrap">
            <table class="mandiri">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Tarif UKT</th>
                        <th>Tagihan Semester</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($listMandiri)): ?>
                    <tr><td colspan="8" style="text-align:center;color:#a0aec0;padding:1.5rem;">Tidak ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($listMandiri as $i => $mhs): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($mhs->getIdMahasiswa()) ?></td>
                        <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                        <td><?= htmlspecialchars($mhs->getNim()) ?></td>
                        <td><span class="smt-badge">Smt <?= $mhs->getSemester() ?></span></td>
                        <td><?= rupiah($mhs->getTarifUktNominal()) ?></td>
                        <td class="tagihan bayar-penuh">
                            <?= rupiah($mhs->hitungTagihanSemester()) ?>
                            <br><small style="font-weight:400;color:#a0aec0;">+Rp 100.000 operasional</small>
                        </td>
                        <td class="spesifikasi"><?= $mhs->tampilSpesifikasiAkademik() ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- ════════════════════════════════════════════════════
         SEKSI 2 – MAHASISWA BIDIKMISI
    ════════════════════════════════════════════════════ -->
    <div class="section">
        <div class="section-header">
            <span class="dot bidikmisi-dot"></span>
            <h2>Mahasiswa Bidikmisi</h2>
            <span class="count"><?= count($listBidikmisi) ?> mahasiswa</span>
        </div>

        <div class="table-wrap">
            <table class="bidikmisi">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Tarif UKT Asal</th>
                        <th>Tagihan Semester</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($listBidikmisi)): ?>
                    <tr><td colspan="8" style="text-align:center;color:#a0aec0;padding:1.5rem;">Tidak ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($listBidikmisi as $i => $mhs): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($mhs->getIdMahasiswa()) ?></td>
                        <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                        <td><?= htmlspecialchars($mhs->getNim()) ?></td>
                        <td><span class="smt-badge">Smt <?= $mhs->getSemester() ?></span></td>
                        <td><?= rupiah($mhs->getTarifUktNominal()) ?></td>
                        <td class="tagihan gratis">
                            GRATIS
                            <br><small style="font-weight:400;color:#a0aec0;">Ditanggung Negara</small>
                        </td>
                        <td class="spesifikasi"><?= $mhs->tampilSpesifikasiAkademik() ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- ════════════════════════════════════════════════════
         SEKSI 3 – MAHASISWA PRESTASI
    ════════════════════════════════════════════════════ -->
    <div class="section">
        <div class="section-header">
            <span class="dot prestasi-dot"></span>
            <h2>Mahasiswa Prestasi</h2>
            <span class="count"><?= count($listPrestasi) ?> mahasiswa</span>
        </div>

        <div class="table-wrap">
            <table class="prestasi">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Tarif UKT Asal</th>
                        <th>Tagihan Semester</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($listPrestasi)): ?>
                    <tr><td colspan="8" style="text-align:center;color:#a0aec0;padding:1.5rem;">Tidak ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($listPrestasi as $i => $mhs): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($mhs->getIdMahasiswa()) ?></td>
                        <td><strong><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></strong></td>
                        <td><?= htmlspecialchars($mhs->getNim()) ?></td>
                        <td><span class="smt-badge">Smt <?= $mhs->getSemester() ?></span></td>
                        <td><?= rupiah($mhs->getTarifUktNominal()) ?></td>
                        <td class="tagihan diskon">
                            <?= rupiah($mhs->hitungTagihanSemester()) ?>
                            <br><small style="font-weight:400;color:#a0aec0;">Diskon beasiswa 75%</small>
                        </td>
                        <td class="spesifikasi"><?= $mhs->tampilSpesifikasiAkademik() ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer>
    UAS Pemrograman Berorientasi Objek &nbsp;·&nbsp; TI1D &nbsp;·&nbsp; HadidAuriel &nbsp;·&nbsp;
    <?= date('d F Y') ?>
</footer>

</body>
</html>
