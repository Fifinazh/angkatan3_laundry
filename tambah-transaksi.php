<?php
session_start();
include 'koneksi.php';



//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_level = $_POST['id_level'];


    $insert = mysqli_query($koneksi, "INSERT INTO user (nama, email, password, id_level, username) VALUES ('$nama','$email','$password', '$id_level', '$username')");

    header("location:user.php?tambah=berhasil");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

//jika button edit di klik
if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_level = $_POST['id_level'];

    //jika password di isi sama user
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email', username='$username', password='$password', id_level='$id_level' WHERE id='$id'");
    header("location:user.php?ubah=berhasil");
}

$queryCust = mysqli_query($koneksi, "SELECT * FROM customer");
$queryPaket = mysqli_query($koneksi, "SELECT * FROM type_of_service");
$rowPaket = [];
while ($data = mysqli_fetch_assoc($queryPaket)) {
    $rowPaket[] = $data;
}
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
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Nama Pelanggan</label>
                                                    <select name="id_customer" id="" class="form-control">
                                                        <option value="">--Pilih Pelanggan--</option>
                                                        <!-- option yang datanya diambil dari tabel kategori -->
                                                        <?php while ($rowCust = mysqli_fetch_assoc($queryCust)): ?>
                                                            <option value="<?php echo $rowCust['id'] ?>">
                                                                <?php echo $rowCust['customer_name'] ?></option>
                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">No. Invoice</label>
                                                    <input type="text" class="form-control" name="trans_code" readonly value="#">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Tanggal Laundry</label>
                                                    <input type="date" class="form-control" name="trans_date" value="#">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detail Transaksi</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Jenis Paket</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="id_service[]" id="" class="form-control">
                                                        <option value="">--Pilih Paket--</option>
                                                        <!-- option yang datanya diambil dari tabel kategori -->
                                                        <?php foreach ($rowPaket as $key => $value) { ?>
                                                            <option value="<?php echo $value['id'] ?>">
                                                                <?php echo $value['service_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Qty</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" name="qty[]" value="Qty">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Jenis Paket</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="id_service[]" id="" class="form-control">
                                                        <option value="">--Pilih Paket--</option>
                                                        <!-- option yang datanya diambil dari tabel kategori -->
                                                        <?php foreach ($rowPaket as $key => $value) { ?>
                                                            <option value="<?php echo $value['id'] ?>">
                                                                <?php echo $value['service_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Qty</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" name="qty[]" value="Qty">
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