<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Kategori</title>
</head>
<style>
    .no-deco-text {
        text-decoration: none;
    }
</style>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-deco-text text-muted"><i class="fas fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="POST">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" class="form-control mt-2" autocomplete="off" name="kategori" placeholder="Masukkan Nama Kategori" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan-kategori">Save</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan-kategori'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                if ($jumlahDataKategoriBaru > 0) {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori yang dimasukkan sudah ada
                    </div>
                    <?php
                } else {
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if ($querySimpan) {
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Kategori berhasil Save
                        </div>
                        <meta http-equiv="refresh" content="1; URL=kategori.php">
            <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>


        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>
            <div class="tabel-responsive mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $no = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
                                            <i class="fa fa-search" aria-hidden="true""></i></a>
                                    </td>
                                </tr>
                        <?php
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
            </div>
        </div>
    </div>

</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-uKxirna7d5STmVXEMQYBVRW1nERrqHjwOubv4QcK4oYaaifLiEnN/aLIJxVsyK4R1K+awpNIG73RaQfT1DZ8ew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>