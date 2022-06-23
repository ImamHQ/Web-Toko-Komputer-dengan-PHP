<?php
require "../koneksi.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <title>Produk</title>
    <style>
        .no-deco-text {
            text-decoration: none;
        }

        form div {
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <?php require 'navbar.php'; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-deco-text text-muted"><i class="fas fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>

        <!-- tambah produk -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control mt-2" name="nama" placeholder="Masukkan Nama" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori" class="">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control mt-2">
                        <option value="">Pilih</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control mt-2 " name="harga" required>
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control mt-2" name="foto" id="foto">
                </div>
                <div>
                    <label for="detail ">Detail</label>
                    <textarea name="detail" id="textarea" class="form-control mt-2" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control mt-2">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan-produk">Save</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan-produk'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $stock = htmlspecialchars($_POST['stock']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, Kategori, dan Harga wajib diisi
                    </div>
                    <?php
                } else {
                    if ($nama_file != '') {
                        if ($image_size > 500000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Ukuran File tidak boleh lebih dari 500 Kb
                            </div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType && 'gift') {
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File harus type jpg atau png atau atau gift
                                </div>
                        <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }
                    // query  insert tabel produk
                    $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, namak, harga, foto, detail, stockk) 
                    VALUES ('$kategori', '$nama', '$harga','$new_name','$detail', '$stock' )");

                    if ($queryTambah) {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Kategori berhasil Save
                        </div>
                        <meta http-equiv="refresh" content="1; URL=produk.php">
            <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }

            ?>
        </div>

        <div class="mt-3 mb-5">
            <h2>List Kategori</h2>
            <div class="tabel-responsive mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan="6" class="text-center">Data Tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['namak']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['stockk']; ?></td>
                                    <td>
                                        <a href="produk-detail.php?p=<?php echo $data['idp']; ?>" class="btn btn-info">
                                            <i class="fa fa-search" aria-hidden="true""></i></a>
                                    </td>
                                </tr>
                        <?php
                                $no++;
                            }
                        }
                        ?>
                    </tbody>

</body>

</html>