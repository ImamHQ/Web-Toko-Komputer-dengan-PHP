<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON 
a.kategori_id=b.id WHERE a.idp='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <title>Produk Detail</title>
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
        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6 mt-3 mb-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control mt-2" value="<?php echo $data['namak'] ?>" name="nama" placeholder="Masukkan Nama" autocomplete="off" required>
                </div>

                <div>
                    <label for="kategori" class="">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control mt-2">
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id'] ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control mt-2" value="<?php echo $data['harga']; ?>" name="harga" required>
                </div>
                <div class="w-50">
                    <label for="currentFoto" class="">Foto Produk Sekarang</label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" class="img-thumbnail">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control mt-2" name="foto" id="foto">
                </div>
                <div>
                    <label for="detail ">Detail</label>
                    <textarea name="detail" id="textarea" class="form-control mt-2" cols="30" rows="10">
                    <?php echo $data['detail']; ?>
                </textarea>
                </div>
                <div>
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control mt-2">
                        <option value="<?php echo $data['stockk'] ?>"><?php echo $data['stockk'] ?></option>
                        <?php
                        if ($data['stockk'] == 'tersedia') {
                        ?>
                            <option value="habis">habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" name="update-produk">Update</button>
                    <button class="btn btn-danger" type="submit" name="hapus">Delete</button>
                </div>
            </form>
            <?php
            if (isset($_POST['update-produk'])) {
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
                    $queryUpdate = mysqli_query($conn, "UPDATE produk 
                    SET kategori_id='$kategori', namak='$nama',harga='$harga',detail='$detail',
                    stockk='$stock' WHERE idp=$id");

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

                            $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE idp='$id'");

                            if ($queryUpdate) {
                            ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Kategori berhasil Update
                                </div>
                                <meta http-equiv="refresh" content="1; URL=produk.php">
                    <?php
                            } else {
                                echo mysqli_error($conn);
                            }
                        }
                    }
                }
            }
            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE idp='$id'");

                if ($queryHapus) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil dihapus
                    </div>
                    <meta http-equiv="refresh" content="1; URL=produk.php">
            <?php
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>

</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-uKxirna7d5STmVXEMQYBVRW1nERrqHjwOubv4QcK4oYaaifLiEnN/aLIJxVsyK4R1K+awpNIG73RaQfT1DZ8ew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</html>