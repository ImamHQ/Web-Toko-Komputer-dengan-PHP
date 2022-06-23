<?php
require 'koneksi.php';

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// get produk by nama produk/keyword
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE namak LIKE '%$_GET[keyword]%'");
}
// get produk by kategori
else if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
// get produk default
else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);

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
    <title>Toko Online Komputer | Produk</title>
</head>

<body>
    <?php require 'navbar.php'; ?>

    <!-- banner -->
    <div class="container-fluid banner2 d-flex align-items-center">
        <div class="container text-center">
            <h1 class="text-white">Produk</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group ">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if ($countData < 1) {
                    ?>
                        <h4 class="text-center my-5">Produk Yang Cari Tidak Ada</h4>
                    <?php
                    }
                    ?>

                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="img-box">
                                    <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $produk['namak']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                    <p class="card-text tharga">Rp. <?php echo $produk['harga']; ?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['namak']; ?>" class="btn color2 text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <?php require 'footer.php'; ?>
</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>