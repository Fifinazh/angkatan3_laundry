<?php
session_start();

include 'koneksi.php';
// munculkan / pilih sebuah atau semua kolom dari table user
$queryCust = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY id DESC");
// mysqli_fetch_assoc = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $rowUser = mysqli_fetch_assoc($queryUser);

//jika parameternya ada ?delete-nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai param

    //query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM customer WHERE id ='$id'");
    header("location:user.php?hapus=berhasil");
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Customer My-laundry</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <div align="right" class="mb-3">
                                            <a href="tambah-customer.php" class="btn btn-primary">Tambah</a>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>No. Telepon</th>
                                                    <th>Alamat Pelanggan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($row = mysqli_fetch_assoc($queryCust)) : ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['customer_name'] ?></td>
                                                        <td><?php echo $row['phone'] ?></td>
                                                        <td><?php echo $row['adress'] ?></td>
                                                        <td>
                                                            <a href="tambah-customer.php?edit=<?php echo $row['id'] ?>" class="btn btn-success btn-sm">
                                                                <span class="tf-icon bx bx-pencil"></span>
                                                            </a>
                                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" href="customer.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">
                                                                <span class="tf-icon bx bx-trash"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
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