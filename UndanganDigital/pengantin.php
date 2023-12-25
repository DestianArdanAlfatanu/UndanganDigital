<?php
    session_start();
    include "koneksi.php";
    

    //Mengambil data COD menggunakan join table
    $select = "SELECT * FROM pengantin JOIN mempelaipria ON mempelaipria.id_mempelaipria = pengantin.id_mempelaipria
    JOIN mempelaiwanita ON mempelaiwanita.id_mempelaiwanita = pengantin.id_mempelaiwanita
    JOIN cerita ON cerita.id_cerita = pengantin.id_cerita
    JOIN acara ON acara.id_acara = pengantin.id_acara";
    $query = mysqli_query($conn, $select);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengantin</title>
</head>
<body>
    <center>
    <h1>Data Pengantin</h1>
    <a href="pria.php">Data Pria</a> | <a href="wanita.php">Data Wanita</a> | <a href="cerita.php">Data Cerita</a> | <a href="acara.php">Data Acara</a> 
    <h2>Data Pengantin</h2>
    <table border="1" style="border-collapse: collapse;" cellpadding="5">
        <tr>
            
            <th>Id Pria</th>
            <th>Nama Pria</th>
            <th>Id Wanita</th>
            <th>Nama Wanita</th>
            <th>Id Cerita</th>
            <th>Tanggal Tunangan</th>
            <th>Id Acara</th>
            <th>Tanggal Resepsi</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                
                echo "<td>".$row['id_mempelaipria']."</td>";
                echo "<td>".$row['nama_pria']."</td>";
                echo "<td>".$row['id_mempelaiwanita']."</td>";
                echo "<td>".$row['nama_wanita']."</td>";
                echo "<td>".$row['id_cerita']."</td>";
                echo "<td>".$row['tgl_tunangan']."</td>";  
                echo "<td>".$row['id_acara']."</td>";
                echo "<td>".$row['tgl_resepsi']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    </center>
</body>
</html>