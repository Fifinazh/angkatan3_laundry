<?php
session_start();
include 'koneksi.php';

$queryCust = mysqli_query($koneksi, "SELECT * FROM customer");
$id = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryTransDetail = mysqli_query($koneksi, "SELECT customer.customer_name, customer.phone, customer.adress, trans_order.order_code, trans_order.order_date, trans_order.order_status,type_of_service.service_name, type_of_service.price, trans_order_detail.*  FROM trans_order_detail
LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service 
LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order
LEFT JOIN customer ON customer.id = trans_order.id_customer WHERE trans_order_detail.id_order='$id'");

$row = [];
while ($dataTrans = mysqli_fetch_assoc($queryTransDetail)) {
    $row[] = $dataTrans;
}

$queryPaket = mysqli_query($koneksi, "SELECT * FROM type_of_service");
$rowPaket = [];
while ($data = mysqli_fetch_assoc($queryPaket)) {
    $rowPaket[] = $data;
}

//jika button simpan di tekan/klik
if (isset($_POST['simpan'])) {

    //mengambil data dari form input dengan atribut name=""
    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];


    //insert ke table trans_order
    $insertTransOrder = mysqli_query($koneksi, "INSERT INTO trans_order (id_customer, order_code, order_date) VALUES ('$id_customer','$order_code','$order_date')");

    $last_id = mysqli_insert_id($koneksi);
    //insert ke table trans_order_detail
    //mengambil nilai lebih dr satu, looping dgn foreach
    foreach ($_POST['id_service'] as $key => $value) {
        $qty = array_filter($_POST['qty']);
        $id_service = array_filter($_POST['id_service']);
        $id_service = $_POST['id_service'][$key];
        $qty = $_POST['qty'][$key];


        $queryPaket = mysqli_query($koneksi, "SELECT id, price FROM type_of_service WHERE id='$id_service'");

        $rowPaket = mysqli_fetch_assoc($queryPaket);
        $harga = isset($rowPaket['price']) ? $rowPaket['price'] : '';
        $subTotal = (int)$qty * (int)$harga;
        //sub total

        if ($id_service > 0) {
            $insertTransDetail = mysqli_query($koneksi, "INSERT INTO trans_order_detail (id_order, id_service, qty, subtotal) VALUES ('$last_id', '$id_service', '$qty', '$subTotal')");
        }
        // if ($key  == 0 and !empty($value) and !empty($qty[$key])) {
        // }



        //query untuk mengambil harga dari table type_of_service (paket)
    }
    header("location:transaksi.php?tambah=berhasil");
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


// no invoice code
// 001, jika ada auto increment id + 1 = 002, selain itu 001
// MAX : terbesar MIN : terkecil
$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS no_invoice FROM trans_order ");
//jika di dalam tabel trans order ada datanya
$str_unique = "INV";
$date_now = date("dmy");
if (mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = $rowInvoice['no_invoice'] + 1;
    $code = $str_unique . "/" . $date_now . "-" . "000" . $incrementPlus;
} else {
    $code = $str_unique . "/" . $date_now . "-" . "0001";
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
                    <?php if (isset($_GET['detail'])) : ?>
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-sm-12 mb-3"></div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Transaksi</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>No. Invoice</th>
                                                        <td><?php echo $row[0]['order_code']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Laundry</th>
                                                        <td><?php echo $row[0]['order_date'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><?php echo $row[0]['order_status'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Pelanggan</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?php echo $row[0]['customer_name'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Telepon</th>
                                                        <td><?php echo $row[0]['phone'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo $row[0]['adress'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Transaksi Detail</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Paket</th>
                                                        <th>Quantity</th>
                                                        <th>Harga</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;
                                                    foreach ($row as $key => $value): ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $value['service_name']?></td>
                                                        <td><?php echo $value['qty'] ?></td>
                                                        <td><?php echo $value['price']?></td>
                                                        <td><?php echo $value['subtotal'] ?></td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</div>
                                            <div class="card-body">
                                                <div class="mb-3 row">

                                                    <div class="col-sm-12 mb-3">
                                                        <label for="" class="form-label">Pelanggan</label>
                                                        <select name="id_customer" class="form-control" id="">
                                                            <option value="">Pilih Pelanggan</option>
                                                            <?php while ($rowCustomer = mysqli_fetch_assoc($queryCust)): ?>
                                                                <option value="<?php echo $rowCustomer['id'] ?>">
                                                                    <?php echo $rowCustomer['customer_name'] ?>
                                                                </option>
                                                            <?php endwhile ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">No invoice</label>
                                                        <input type="text" class="form-control" id="" name="order_code" readonly
                                                            value="<?php echo $code ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Tanggal Laundry</label>
                                                        <input type="date" name="order_date" class="form-control" id="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">Detail Transaksi</div>
                                            <div class="card-body">
                                                <div class="mb-3 row">

                                                    <div class="col-sm-3 mb-4">
                                                        <label for="" class="form-label"> Jenis Paket</label>
                                                    </div>
                                                    <div class="col-9 mb-4">
                                                        <select name="id_service[]" class="form-control" id="">
                                                            <option value="">Pilih Paket</option>
                                                            <?php
                                                            foreach ($rowPaket as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $value['id'] ?>">
                                                                    <?php echo $value['service_name'] ?>
                                                                </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mb-3">
                                                        <label for="" class="form-label">Quantity</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="number" class="form-control" id="" name="qty[]"
                                                            value="" placeholder="Qty">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">

                                                    <div class="col-sm-3 mb-4">
                                                        <label for="" class="form-label">Paket</label>
                                                    </div>
                                                    <div class="col-9 mb-4">
                                                        <select name="id_service[]" class="form-control" id="">
                                                            <option value="">Pilih Paket</option>
                                                            <?php
                                                            foreach ($rowPaket as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $value['id'] ?>">
                                                                    <?php echo $value['service_name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mb-3">
                                                        <label for="" class="form-label">Quantity</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="number" class="form-control" id="" name="qty[]"
                                                            value="" placeholder="Qty">
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php endif ?>
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