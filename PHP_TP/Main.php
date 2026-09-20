<?php
session_start();
require_once __DIR__ . "/Film.php";

if (!isset($_SESSION['daftar_film'])) {
    $_SESSION['daftar_film'] = [];
}

$edit_mode = false;
$film_edit = null;
$hasil_cari = null;

// Handle Form Submissions (Tambah / Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $durasi = (int)($_POST['durasi'] ?? 0);
    
    // Upload Handler Gambar
    $gambar_path = $_POST['gambar_lama'] ?? 'uploads/poster_default.png';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_name = time() . '_' . $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $gambar_path = $target_file;
        }
    }

    if ($action === 'tambah') {
        $_SESSION['daftar_film'][] = serialize(new Film($id, $judul, $genre, $durasi, $gambar_path));
    } elseif ($action === 'update') {
        foreach ($_SESSION['daftar_film'] as $key => $film_data) {
            $f = unserialize($film_data);
            if ($f->getId() === $id) {
                $f->setJudul($judul);
                $f->setGenre($genre);
                $f->setDurasi($durasi);
                $f->setGambar($gambar_path);
                $_SESSION['daftar_film'][$key] = serialize($f);
                break;
            }
        }
    }
    header("Location: index.php");
    exit();
}

// Handle GET Actions (Hapus / Edit / Cari)
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? '';

    if ($action === 'hapus') {
        foreach ($_SESSION['daftar_film'] as $key => $film_data) {
            $f = unserialize($film_data);
            if ($f->getId() === $id) {
                unset($_SESSION['daftar_film'][$key]);
                $_SESSION['daftar_film'] = array_values($_SESSION['daftar_film']);
                break;
            }
        }
        header("Location: index.php");
        exit();
    } elseif ($action === 'edit') {
        foreach ($_SESSION['daftar_film'] as $film_data) {
            $f = unserialize($film_data);
            if ($f->getId() === $id) {
                $edit_mode = true;
                $film_edit = $f;
                break;
            }
        }
    } elseif ($action === 'cari') {
        $keyword = $_GET['keyword'] ?? '';
        foreach ($_SESSION['daftar_film'] as $film_data) {
            $f = unserialize($film_data);
            if (strtolower($f->getId()) === strtolower($keyword)) {
                $hasil_cari = $f;
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Manajemen Bioskop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
        .form-container { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; width: 400px; }
        img { max-width: 80px; height: auto; }
    </style>
</head>
<body>

    <h2>Sistem Manajemen Bioskop (PHP Web)</h2>

    <!-- Form Pencarian -->
    <div class="form-container">
        <h3>Cari Data Film</h3>
        <form method="GET" action="index.php">
            <input type="hidden" name="action" value="cari">
            <input type="text" name="keyword" placeholder="Masukkan ID Film" required>
            <button type="submit">Cari</button>
            <a href="index.php">Reset</a>
        </form>
        <?php if (isset($_GET['action']) && $_GET['action'] === 'cari'): ?>
            <p>
                <?php if ($hasil_cari): ?>
                    <strong>Hasil:</strong> Film Ditemukan - ID: <?= $hasil_cari->getId() ?>, Judul: <?= $hasil_cari->getJudul() ?>, Genre: <?= $hasil_cari->getGenre() ?>, Durasi: <?= $hasil_cari->getDurasi() ?> menit.
                <?php else: ?>
                    <strong>Hasil:</strong> Film tidak ditemukan!
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Form Input / Update Data -->
    <div class="form-container">
        <h3><?= $edit_mode ? 'Edit Data Film' : 'Tambah Data Film' ?></h3>
        <form method="POST" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?= $edit_mode ? 'update' : 'tambah' ?>">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="gambar_lama" value="<?= $film_edit->getGambar() ?>">
            <?php endif; ?>

            <p>
                <label>ID Film:</label><br>
                <input type="text" name="id" value="<?= $edit_mode ? $film_edit->getId() : '' ?>" <?= $edit_mode ? 'readonly' : 'required' ?>>
            </p>
            <p>
                <label>Judul Film:</label><br>
                <input type="text" name="judul" value="<?= $edit_mode ? $film_edit->getJudul() : '' ?>" required>
            </p>
            <p>
                <label>Genre:</label><br>
                <input type="text" name="genre" value="<?= $edit_mode ? $film_edit->getGenre() : '' ?>" required>
            </p>
            <p>
                <label>Durasi (menit):</label><br>
                <input type="number" name="durasi" value="<?= $edit_mode ? $film_edit->getDurasi() : '' ?>" required>
            </p>
            <p>
                <label>Poster (Gambar Lokal):</label><br>
                <input type="file" name="gambar" accept="image/*">
            </p>
            <button type="submit"><?= $edit_mode ? 'Simpan Perubahan' : 'Tambah Film' ?></button>
            <?php if ($edit_mode): ?>
                <a href="index.php">Batal</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Tabel Tampil Data -->
    <h3>Daftar Film Bioskop</h3>
    <table>
        <thead>
            <tr>
                <th>Poster</th>
                <th>ID Film</th>
                <th>Judul Film</th>
                <th>Genre</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($_SESSION['daftar_film'])): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data film.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION['daftar_film'] as $film_data): ?>
                    <?php $f = unserialize($film_data); ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($f->getGambar()) ?>" alt="Poster"></td>
                        <td><?= htmlspecialchars($f->getId()) ?></td>
                        <td><?= htmlspecialchars($f->getJudul()) ?></td>
                        <td><?= htmlspecialchars($f->getGenre()) ?></td>
                        <td><?= htmlspecialchars($f->getDurasi()) ?> menit</td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $f->getId() ?>">Edit</a> |
                            <a href="index.php?action=hapus&id=<?= $f->getId() ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>