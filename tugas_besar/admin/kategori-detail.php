<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <title>Kategori Detail</title>
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="POST">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" autocomplete="off" class="form-control mt-2" value="<?php echo $data['nama']; ?>" required>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="Editbtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="Deletebtn">Delete</button>
                </div>
            </form>
            <?php
            if (isset($_POST['Editbtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="1; URL=kategori.php">
                    <?php
                } else {
                    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");

                        if ($querySimpan) {
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil diupdate
                            </div>
                            <meta http-equiv="refresh" content="1; URL=kategori.php">
                    <?php
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            }
            if (isset($_POST['Deletebtn'])) {
                $queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);

                if ($dataCount > 0) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori tidak bisa dihapus karena sedang digunakan
                    </div>
                <?php
                    die();
                }

                $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

                if ($queryDelete) {
                ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Kategori berhasil dihapus
                    </div>
                    <meta http-equiv="refresh" content="1; URL=kategori.php">
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