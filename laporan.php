<?php
session_start();

include 'koneksi.php';
// munculkan / pilih sebuah atau semua kolom dari table user
$tanggal_dari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$tanggal_sampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';



$query = "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id = trans_order.id_customer WHERE 1";

//jika status tidak kosong
if ($tanggal_dari != "") {
    $query .= " AND order_date >= '$tanggal_dari'";
}

if ($tanggal_sampai != "") {
    $query .= " AND order_date <= '$tanggal_sampai'";
}

if ($status != "") {
    $query .= " AND order_status = '$status'";
}

$query .= " ORDER BY trans_order.id DESC";

$queryTr = mysqli_query($koneksi, $query);



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
                                        <h4>Transaksi My-laundry</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <!-- filter data transaksi -->
                                        <form action="" method="get">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Periode Tanggal :</label>
                                                    <input type="date" name="tanggal_dari" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Sampai Tanggal:</label>
                                                    <input type="date" name="tanggal_sampai" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="" class="form-label">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="">--Pilih Status--</option>
                                                        <option value="0">Baru</option>
                                                        <option value="1">Dikembalikan</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button name="filter" class="btn btn-primary">Tampilkan Laporan</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Invoice</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Laundry</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($rowTr = mysqli_fetch_assoc($queryTr)) : ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $rowTr['order_code'] ?></td>
                                                        <td><?php echo $rowTr['customer_name'] ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($rowTr['order_date'])) ?></td>
                                                        <td>
                                                            <?php
                                                            switch ($rowTr['order_status']) {
                                                                case '1':
                                                                    $badge = "<span class='badge bg-primary'>Sudah dikembalikan</span>";
                                                                    break;

                                                                default:
                                                                    $badge = "<span class='badge bg-warning'>Baru</span>";
                                                                    break;
                                                            }

                                                            echo $badge;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="tambah-transaksi.php?detail=<?php echo $rowTr['id'] ?>" class="btn btn-primary btn-sm">
                                                                <span class="tf-icon bx bx-show"></span>
                                                            </a>
                                                            <a target="_blank" href="print.php?id=<?php echo $rowTr['id'] ?>" class="btn btn-success btn-sm">
                                                                <span class="tf-icon bx bx-printer"></span>
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