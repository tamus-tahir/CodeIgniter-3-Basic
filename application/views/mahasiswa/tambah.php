<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Tambah Data Mahasiswa</h1>
    <hr>

    <?= $this->session->flashdata('error') ? $this->session->flashdata('error') : ''; ?>

    <?= form_open_multipart(); ?>

        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <!-- error akan dicetak ketika validasinya tidak sesuai rule -->
        <?= form_error('nama') ?>
        <br>

        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim">
        <?= form_error('nim') ?>
        <br>

        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto">
        <br>

        <button type="submit">Tambah</button>

    </form>

</body>

</html>