<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Ubah Data Mahasiswa</h1>
    <hr>

    <?= $this->session->flashdata('error') ? $this->session->flashdata('error') : ''; ?>

    <?= form_open_multipart(); ?>

        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $mahasiswa->nama; ?>">
        <?= form_error('nama') ?>
        <br>

        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" value="<?= $mahasiswa->nim; ?>">
        <?= form_error('nim') ?>
        <br>

        <label for="nim">Foto Lama</label><br>
        <img src="<?= base_url('uploads/' . $mahasiswa->foto); ?>" alt="" width="100">
        <br>

        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto">
        <br>

        <input type="hidden" name="foto_lama" value="<?= $mahasiswa->foto; ?>">
        <input type="hidden" name="id" value="<?= $mahasiswa->id; ?>">

        <button type="submit">Ubah</button>

    </form>

</body>

</html>