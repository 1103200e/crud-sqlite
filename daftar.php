<?php
// Koneksi ke database
// Pastikan variabel $conn sudah dibuat sebelumnya dan berisi koneksi PDO

// Menampilkan semua tugas
$sqlAll = 'SELECT id, deskripsi, waktu FROM tugas';
$statementAll = $conn->query($sqlAll);
$semuaTugas = $statementAll->fetchAll(PDO::FETCH_ASSOC);

echo "<h3>Daftar Semua Tugas:</h3>";
if ($semuaTugas) {
    foreach ($semuaTugas as $t) {
        echo $t['deskripsi'] . '<br>';
    }
} else {
    echo "Tidak ada tugas yang ditemukan.<br>";
}

// Menampilkan satu tugas berdasarkan ID
$id = 1; // Anda bisa ubah ID ini sesuai kebutuhan
$sqlSingle = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
$statementSingle = $conn->prepare($sqlSingle);
$statementSingle->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statementSingle->execute();
$tugas = $statementSingle->fetch(PDO::FETCH_ASSOC);

echo "<h3>Detail Tugas ID $id:</h3>";
if ($tugas) {
    echo $tugas['id'] . '. ' . $tugas['deskripsi'];
} else {
    echo "Tugas dengan id $id tidak ditemukan.";
}
?>
