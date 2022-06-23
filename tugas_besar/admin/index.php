<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .sum-kategori {
            background-color: #F87B27;
            border-radius: 15px;
        }

        .sum-produk {
            background-color: #319D5A;
            border-radius: 15px;
        }

        .no-deco-text {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home" aria-hidden="true"></i> Home
                </li>
            </ol>
        </nav>
        <h2>Hello <?php echo $_SESSION['username']; ?></h2>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="sum-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa fa-th-list fa-7x" aria-hidden="true"></i>
                            </div>
                            <div class="col-6 text-light">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                                <a href="kategori.php" class="text-light no-deco-text">Lihat Detail</a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="sum-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa fa-box fa-7x"></i>
                            </div>
                            <div class="col-6 text-light">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                                <a href="kategori.php" class="text-light no-deco-text">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>