<?php
require 'koneksi.php';

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE namak='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]'
AND idp!='$produk[idp]' LIMIT 4");




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Toko Online Komputer | Detail Produk</title>
</head>

<body>
    <?php require 'navbar.php'; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['namak']; ?></h1>
                    <p class="fs-5"><?php echo $produk['detail']; ?>
                    </p>
                    <p class="tharga">
                        Rp. <?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">
                        Status Ketersediaan : <strong><?php echo $produk['stockk']; ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- produk terkait -->
    <div class="container-fluid py-5 color2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="produk-detail.php?nama=<?php echo $data['namak']; ?>">
                            <img class="pdterkait" src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>