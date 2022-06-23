<?php
require 'koneksi.php';

$queryProduk = mysqli_query($conn, "SELECT idp, namak, harga, foto, detail FROM produk LIMIT 6");
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
    <title>Halaman Utama</title>
</head>

<body>
    <?php require 'navbar.php'; ?>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Online Komputer</h1>
            <h3>Mau Cari Apa ?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="GET" action="produk.php">
                    <div class="input-group input-group-lg my-3">
                        <input type="text" class="form-control" placeholder="Cari di Toko Online Komputer" aria-label="Recipient's username" name="keyword" aria-describedby="basic-addon2">
                        <button type="submit" class="btn color2 text-white"><i class="fa fa-search" aria-hidden="true""></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class=" container-fluid py-4">
                                <div class="container text-center">
                                    <h3>Kategori Populer</h3>
                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-kategori k-keyboard d-flex justify-content-center align-items-center">
                                                <h4 class="text-white"><a class="no-text-deco" href="produk.php?kategori=Keyboard">Keyboard</a></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-kategori k-mouse d-flex justify-content-center align-items-center">
                                                <h4 class="text-white"><a class="no-text-deco" href="produk.php?kategori=Mouse">Mouse</a></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-kategori k-ram d-flex justify-content-center align-items-center">
                                                <h4 class="text-white"><a class="no-text-deco" href="produk.php?kategori=RAM">RAM</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <!-- About us -->
                    <div class="container-fluid color1 py-5">
                        <div class="container text-center text-white">
                            <h3>About Us</h3>
                            <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, ipsa animi harum autem dicta iusto at. Nisi, cumque doloribus hic soluta sed architecto laborum reiciendis dolorem? Pariatur, officia reiciendis nesciunt cupiditate tempore facere error in ad veniam, ratione nihil voluptates qui odio voluptas enim quam distinctio exercitationem? Reprehenderit, deserunt a!</p>
                        </div>
                    </div>
                    <!-- Produk -->
                    <div class="container-fluid py-5">
                        <div class="container text-center">
                            <h3>Produk</h3>

                            <div class="row mt-5">
                                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                                    <div class="col-sm-6 col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="img-box">
                                                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $data['namak']; ?></h5>
                                                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                                <p class="card-text tharga">Rp.<?php echo $data['harga']; ?></p>
                                                <a href="produk-detail.php?nama=<?php echo $data['namak']; ?>" class="btn color2 text-white">Lihat Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <a href="produk.php" class="btn btn-outline-danger mt-3 ">Lihat Lainnya</a>
                        </div>
                    </div>
                    <?php require 'footer.php'; ?>
</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</html>