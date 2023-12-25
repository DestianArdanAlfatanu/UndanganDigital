<?php
include "koneksi.php";

// Menambahkan data pembeli
if (isset($_POST['tambah'])) {
    $tgl_bertemu = $_POST['tglbertemu'];
    $tgl_pacaran = $_POST['tglpacaran'];
    $tgl_tunangan = $_POST['tgltunangan'];

    $query = "INSERT INTO cerita(tgl_bertemu, tgl_pacaran, tgl_tunangan) VALUES ('$tgl_bertemu', '$tgl_pacaran','$tgl_tunangan')";
    $result = mysqli_query($conn, $query);
    if($result){
        $lastInsertedId = mysqli_insert_id($conn);
        $sql = "SELECT * FROM pengantin ORDER BY id_pengantin DESC LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $id_pengantin = $data['id_pengantin'];
        if($query){
    
            $sql = "UPDATE pengantin SET id_cerita = '$lastInsertedId' WHERE id_pengantin = '$id_pengantin'";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "<script>alert('Berhasil menambahkan data!'); window.location.href = 'cerita.php'</script>";
            }
        }
    }
}

if(isset($_POST['ubah'])) {
    $id_cerita = $_POST['id_cerita'];
    $tgl_bertemu = $_POST['tglbertemu'];
    $tgl_pacaran = $_POST['tglpacaran'];
    $tgl_tunangan = $_POST['tgltunangan'];

    $update = "UPDATE cerita SET tgl_bertemu='$tgl_bertemu', tgl_pacaran='$tgl_pacaran', tgl_tunangan='$tgl_tunangan' WHERE id_cerita=$id_cerita";
    mysqli_query($conn, $update);
}

if(isset($_GET['hapus'])) {
    $id_cerita = $_GET['hapus'];

    $delete = "DELETE FROM cerita WHERE id_cerita=$id_cerita";
    mysqli_query($conn, $delete);
}

    $select = "SELECT * FROM cerita";
    $query = mysqli_query($conn, $select);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Acara</title>
    <a href="pengantin.php">Data Pengantin</a>
</head>

<body>
    <h1>Masukkan Data Cerita Nikah</h1>
    <form action="cerita.php" method="post"> <!-- Perbaiki formulir di sini -->
        <table>
            <tr>
                <td>Tanggal Bertemu</td>
                <td><input type="date" name="tglbertemu" ></td>
            </tr>
            <tr>
                <td>Tanggal Pacaran</td>
                <td><input type="date" name="tglpcaran" ></td>
            </tr>
            <tr>
                <td>Tanggal Tunangan</td>
                <td><input type="date" name="tgltunangan" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="tambah">Tambah</button></td>
            </tr>
        </table>
    </form>
    
    
       
    <h2>Tabel Cerita Mempelai</h2>
    <table border="1" style="border-collapse: collapse;" cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Tanggal Pertama Bertemu</th>
            <th>Tanggal Berpacaran</th>
            <th>Tanggal Bertunangan</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['id_cerita']."</td>";
                echo "<td>".$row['tgl_bertemu']."</td>";
                echo "<td>".$row['tgl_pacaran']."</td>";
                echo "<td>".$row['tgl_tunangan']."</td>";
                echo "<td><a href = 'cerita.php?ubah=".$row['id_cerita']."'>Edit</a>
                | <a href = 'cerita.php?hapus=".$row['id_cerita']."'>Hapus</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="acara.php">Next</a>
    <?php
        if(isset($_GET['ubah'])) {
            $id_cerita = $_GET['ubah'];
            $select = "SELECT * FROM cerita WHERE id_cerita=$id_cerita";
            $query = mysqli_query($conn, $select);
            $row = mysqli_fetch_array($query);
    ?>
    <h2>Edit Cerita Mempelai</h2>
    <form action="cerita.php" method="post">
        <table>
            <tr>
                <td>Tanggal Pertama Bertemu</td>
                <td><input type="date" name="tglbertemu" required value="<?php echo $row['tgl_bertemu']; ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Berpacaran</td>
                <td><input type="date" name="tglpacaran" required value="<?php echo $row['tgl_pacaran']; ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Bertunangan</td>
                <td><input type="date" name="tgltunangan" required value="<?php echo $row['tgl_tunangan']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_cerita" value="<?php echo $row['id_cerita']; ?>"></td>
                <td><button type="submit" name="ubah">Ubah</button></td>
            </tr>
        </table>
    </form>
    <?php
        }
    ?><!-- Perbaiki formulir di sini -->
</body>

</html>