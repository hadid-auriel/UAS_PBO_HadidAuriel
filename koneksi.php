<?php
// ============================================================
//  File   : koneksi.php
//  Fungsi : Membuat koneksi PDO ke database MySQL
//           db_uas_pbo_ti1d_hadidauriel
//  Ubah HOST / USER / PASS sesuai konfigurasi server lokal.
// ============================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'db_uas_pbo_ti1d_hadidauriel');
define('DB_USER', 'root');       // ← sesuaikan
define('DB_PASS', '');           // ← sesuaikan
define('DB_CHAR', 'utf8mb4');

function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHAR
        );
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('<div style="color:red;font-family:monospace;padding:1rem;">'
              . '<b>Koneksi Database Gagal:</b> '
              . htmlspecialchars($e->getMessage())
              . '</div>');
        }
    }

    return $pdo;
}
