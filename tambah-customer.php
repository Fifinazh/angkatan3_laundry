<?php
session_start();
include 'koneksi.php';


//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    $insert = mysqli_query($koneksi, "INSERT INTO customer (customer_name, phone, adress) VALUES ('$customer_name','$phone','$adress')");

    header("location:customer.php?tambah=berhasil");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM customer WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

//jika button edit di klik
if (isset($_POST['edit'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];


    //jika password di isi sama user
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$customer_name', phone='$phone', adress='$adress' WHERE id='$id'");
    header("location:customer.php?ubah=berhasil");
}

$queryLevels = mysqli_query($koneksi, "SELECT * FROM level");
?>
<!DOCTYPE html>


<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    <?php include 'inc/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'inc/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/nav.php' ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Customer</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Nama Pelanggan</label>
                                                    <input type="text" class="form-control" name="customer_name" placeholder="Masukkan Nama Pelanggan" required value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">No. Telepon</label>
                                                    <input type="number" class="form-control" name="phone" placeholder="Masukkan No. Telepon Pelanggan" required value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Adress</label>
                                                    <textarea name="adress" id="" class="mySummernote form-control" required><?php echo isset($_GET['edit']) ? $rowEdit['adress'] : '' ?></textarea>

                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'inc/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php include 'inc/js.php' ?>

</body>

</html>