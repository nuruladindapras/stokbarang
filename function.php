<?php
    session_start();

    //koneksi ke database
    $conn = mysqli_connect("localhost","root","","stockbarang");

    //menambah barang baru
    if (isset($_POST['addnewbarang'])) {
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];

        $addtotable = mysqli_query($conn, "INSERT INTO stock(namabarang, deskripsi, stock) values ('$namabarang','$deskripsi','$stock')");
        if ($addtotable) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    }
?>