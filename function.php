<?php
    session_start();

    //koneksi ke database
    $conn = mysqli_connect("localhost","root","","stockbarang");

    //menambah barang baru
    if (isset($_POST['addnewbarang'])) {
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];

        $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) values ('$namabarang','$deskripsi','$stock')");
        if ($addtotable) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    };

    //menambah barang masuk
    if (isset($_POST['barangmasuk'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya' ");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahstocksekarangdenganquantity = $stocksekarang + $qty;

        $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang, keterangan,qty) values ('$barangnya', '$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahstocksekarangdenganquantity' WHERE idbarang = '$barangnya' ");
        if ($addtomasuk&&$updatestockmasuk) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }

    //menambah barang keluar
    if (isset($_POST['addbarangkeluar'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya' ");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahstocksekarangdenganquantity = $stocksekarang - $qty;

        $addtokeluar = mysqli_query($conn,"INSERT INTO keluar (idbarang, penerima ,qty) values ('$barangnya', '$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahstocksekarangdenganquantity' WHERE idbarang = '$barangnya' ");
        if ($addtokeluar&&$updatestockmasuk) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
?>
