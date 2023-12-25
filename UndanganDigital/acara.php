<?php
include "koneksi.php";

// Menambahkan data pembeli
if (isset($_POST['tambah'])) {
    $tgl_resepsi = $_POST['tglresepsi'];
    $tgl_akad = $_POST['tglakad'];
    $tempat = $_POST['tempat'];
    $waktu_akad = $_POST['waktuakad'];
    $waktu_resepsi = $_POST['wakturesepsi'];

    $query = "INSERT INTO acara(tgl_resepsi, tgl_akad, tempat, waktu_akad, waktu_resepsi) VALUES ('$tgl_resepsi', '$tgl_akad','$tempat','$waktu_akad','$waktu_resepsi')";
    $result = mysqli_query($conn, $query);
    if($result){
        $lastInsertedId = mysqli_insert_id($conn);
        $sql = "SELECT * FROM pengantin ORDER BY id_pengantin DESC LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $id_pengantin = $data['id_pengantin'];
        if($query){
    
            $sql = "UPDATE pengantin SET id_acara = '$lastInsertedId' WHERE id_pengantin = '$id_pengantin'";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "<script>alert('Berhasil menambahkan data!'); window.location.href = 'acara.php'</script>";
            }
        }
    }
}

if(isset($_POST['ubah'])) {
    $id_acara = $_POST['id_acara'];
    $tgl_resepsi = $_POST['tglresepsi'];
    $tgl_akad = $_POST['tglakad'];
    $tempat = $_POST['tempat'];
    $waktu_akad = $_POST['waktuakad'];
    $waktu_resepsi = $_POST['wakturesepsi'];

    $update = "UPDATE acara SET tgl_resepsi='$tgl_resepsi', tgl_akad='$tgl_akad', tempat='$tempat', waktu_akad='$waktu_akad', waktu_resepsi='$waktu_resepsi' WHERE id_acara=$id_acara";
    mysqli_query($conn, $update);
}

if(isset($_GET['hapus'])) {
    $id_acara = $_GET['hapus'];

    $delete = "DELETE FROM acara WHERE id_acara=$id_acara";
    mysqli_query($conn, $delete);
}

    $select = "SELECT * FROM acara";
    $query = mysqli_query($conn, $select);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Acara</title>
</head>

<body>
    <h1>Masukkan Data Acara Nikah</h1>
    <a href="pengantin.php">Data Pengantin</a>
    <form action="acara.php" method="post"> <!-- Perbaiki formulir di sini -->
        <table>
            <tr>
                <td>Tanggal Resepsi</td>
                <td><input type="date" name="tglresepsi" ></td>
            </tr>
            <tr>
                <td>Tanggal Akad</td>
                <td><input type="date" name="tglakad" ></td>
            </tr>
            <tr>
                <td>Tempat Nikah</td>
                <td><input type="text" name="tempat" id=""></td>
            </tr>
            <tr>
                <td>Waktu Akad</td>
                <td><input type="time" name="waktuakad" id=""></td>
            </tr>
            <tr>
                <td>Waktu Resepsi</td>
                <td><input type="time" name="wakturesepsi" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="tambah">Tambah</button></td>
            </tr>
        </table>
    </form> 
        
    <h2>Tabel Acara Mempelai</h2>
    <table border="1" style="border-collapse: collapse;" cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Tanggal Resepsi</th>
            <th>Tanggal Akad</th>
            <th>Tempat Nikah</th>
            <th>Waktu Akad</th>
            <th>Waktu Resepsi</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['id_acara']."</td>";
                echo "<td>".$row['tgl_resepsi']."</td>";
                echo "<td>".$row['tgl_akad']."</td>";
                echo "<td>".$row['tempat']."</td>";
                echo "<td>".$row['waktu_akad']."</td>";
                echo "<td>".$row['waktu_resepsi']."</td>";
                echo "<td><a href = 'acara.php?ubah=".$row['id_acara']."'>Edit</a>
                | <a href = 'acara.php?hapus=".$row['id_acara']."'>Hapus</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
        if(isset($_GET['ubah'])) {
            $id_acara = $_GET['ubah'];
            $select = "SELECT * FROM acara WHERE id_acara=$id_acara";
            $query = mysqli_query($conn, $select);
            $row = mysqli_fetch_array($query);
    ?>
    <h2>Edit Acara Mempelai</h2>
    <form action="acara.php" method="post">
        <table>
            <tr>
                <td>Tanggal Resepsi</td>
                <td><input type="date" name="tglresepsi" required value="<?php echo $row['tgl_resepsi']; ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Akad</td>
                <td><input type="date" name="tglakad" required value="<?php echo $row['tgl_akad']; ?>"></td>
            </tr>
            <tr>
                <td>Tempat Nikah</td>
                <td><input type="text" name="tempat" required value="<?php echo $row['tempat']; ?>"></td>
            </tr>
            <tr>
                <td>Waktu Akad</td>
                <td><input type="time" name="waktuakad" required value="<?php echo $row['waktu_akad']; ?>"></td>
            </tr>
            <tr>
                <td>Waktu Resepsi</td>
                <td><input type="time" name="wakturesepsi" required value="<?php echo $row['waktu_resepsi']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_acara" value="<?php echo $row['id_acara']; ?>"></td>
                <td><button type="submit" name="ubah">Ubah</button></td>
            </tr>
            
        </table>
    </form>
    <?php
        }
    ?><!-- Perbaiki formulir di sini -->
</body>

</html>