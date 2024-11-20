<?php
include "koneksi.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
//mengambil data detail penjual dan penjualan
$queryDetail = mysqli_query($koneksi, "SELECT trans_order.id, trans_order.order_code, customer.customer_name, type_of_service.service_name, type_of_service.price, trans_order_detail.* FROM trans_order_detail LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order LEFT JOIN customer ON customer.id = trans_order.id_customer LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service WHERE trans_order_detail.id_order = '$id'");

$row = [];
while ($rowDetail = mysqli_fetch_assoc($queryDetail)) {
    $row[] = $rowDetail;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Transaksi : </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Overpass+Mono:wght@300..700&display=swap');

        body {
            margin: 20px;
            font-family: "Overpass Mono", monospace;
        }

        .struk {
            width: 80mm;
            max-width: 100%;
            border: 1px solid #000;
            padding: 10px;
            margin: 0 auto;
        }

        .struk-header,
        .struk-footer {
            text-align: center;
            margin-bottom: 10px;
        }

        .struk-header h1 {
            font-size: 25px;
            margin: 0;
            margin-top: 10px;
        }

        .struk-header p {
            font-size: 15px;
            margin: 0;
            margin-top: 10px;
        }

        .struk-body {
            margin-bottom: 10px;
        }

        .struk-body table {
            border-collapse: collapse;
            width: 100%;
        }

        .struk-body table th,
        .struk-body table td {
            padding: 5px;
            text-align: left;
        }

        .struk-body table th {
            border-bottom: 1px solid #000;
        }

        .total,
        .payment,
        .change {
            display: flex;
            justify-content: space-evenly;
            padding: 5px 0;
            font-weight: bold;
        }

        .total {
            margin-top: 10px;
            border-top: 1px solid #000;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .struk {
                width: auto;
                border: none;
                margin: 0;
                padding: 0;
            }

            .struk-header h1,
            .struk-footer {
                font-size: 14px;
            }

            .struk-body table th,
            .struk-body table td {
                padding: 2px;
            }

            .total,
            .payment,
            .change {
                padding: 2px 0;
            }
        }
    </style>
</head>

<body>

    <div class="struk">
        <div class="struk-header">
            <h1>My-laundry</h1>
            <p>Kemayoran, Jakarta Pusat</p>
            <p>081245367695</p>
        </div>
        <div class="struk-body">
            <div class="container-md">
                <p>No. Invoice : <?php echo ($row[0]['order_code']) ?></p>
                <p>Nama Customer : <?php echo ($row[0]['customer_name']) ?></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Paket Laundry</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row : [0] => data-->
                    <?php foreach ($row as $key => $rowDetail): ?>
                        <tr>
                            <td><?php echo $rowDetail['service_name'] ?></td>
                            <td><?php echo $rowDetail['qty'] ?></td>
                            <td><?php echo "Rp. " . number_format($rowDetail['price']) ?></td>
                            <td><?php echo "Rp. " . number_format($rowDetail['subtotal']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- <div class="total">
                <span>Total :</span>
                <span><?php echo "Rp." . number_format($row[0]['trans_total_price']) ?></span>
            </div>
            <div class="payment">
                <span>Bayar :</span>
                <span><?php echo "Rp." . number_format($row[0]['trans_paid']) ?></span>
            </div>
            <div class="change">
                <span>Kembalian :</span>
                <span><?php echo "Rp." . number_format($row[0]['trans_change']) ?></span>
            </div> -->
        </div>
        <div class="struk-footer">
            <p>Terima Kasih Atas Kunjungan Anda!</p>
            <p>Selamat Berbelanja Kembali</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>