<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Data Mahasiswa</h1>
    <hr>

    <!-- operator ternary -->
    <!-- jika ada flasdata berhasil cetak flasdata, jika tidak kosongkan -->
    <?= $this->session->flashdata('berhasil') ? $this->session->flashdata('berhasil') : ''; ?>

    <a href="<?= base_url('mahasiswa/tambah'); ?>">Tambah</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $m) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $m->nama; ?></td>
                <td><?= $m->nim; ?></td>
                <td><img src="<?= base_url('uploads/' . $m->foto); ?>" alt="" width="100"></td>
                <td>
                    <a href="<?= base_url('mahasiswa/ubah/' . $m->id); ?>">Ubah</a>
                    <a href="<?= base_url('mahasiswa/hapus/' . $m->id); ?>" onclick="return confirm('Anda Yakin?')">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>