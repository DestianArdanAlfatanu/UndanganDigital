
<?php
session_start();
include "koneksi.php";

if (isset($_POST['tambah'])) {
    $nama_wanita = $_POST['namawanita'];
    $ayah_wanita = $_POST['ayahwanita'];
    $ibu_wanita = $_POST['ibuwanita'];

    $query = "INSERT INTO mempelaiwanita(nama_wanita, ayah_wanita, ibu_wanita) VALUES ('$nama_wanita', '$ayah_wanita','$ibu_wanita')";
    $result = mysqli_query($conn, $query);
    if($result){
        $lastInsertedId = mysqli_insert_id($conn);
        $sql = "SELECT * FROM pengantin ORDER BY id_pengantin DESC LIMIT 1";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $id_pengantin = $data['id_pengantin'];
        if($query){
    
            $sql = "UPDATE pengantin SET id_mempelaiwanita = '$lastInsertedId' WHERE id_pengantin = '$id_pengantin'";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "<script>alert('Berhasil menambahkan data!'); window.location.href = 'wanita.php'</script>";
            }
        }
    }
}

if(isset($_POST['ubah'])) {
    $id_mempelaiwanita = $_POST['id_mempelaiwanita'];
    $nama_wanita = $_POST['namawanita'];
    $ayah_wanita = $_POST['ayahwanita'];
    $ibu_wanita = $_POST['ibuwanita'];

    $update = "UPDATE mempelaiwanita SET nama_wanita='$nama_wanita', ayah_wanita='$ayah_wanita', ibu_wanita='$ibu_wanita' WHERE id_mempelaiwanita=$id_mempelaiwanita";
    mysqli_query($conn, $update);
}

if(isset($_GET['hapus'])) {
    $id_mempelaiwanita = $_GET['hapus'];

    $delete = "DELETE FROM mempelaiwanita WHERE id_mempelaiwanita=$id_mempelaiwanita";
    mysqli_query($conn, $delete);
}

    $select = "SELECT * FROM mempelaiwanita";
    $query = mysqli_query($conn, $select);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mempelai Wanita</title>
        <a href="pengantin.php">Data Pengantin</a>
    </head>
    <body>
        <h1>Masukkan Data Mempelai Wanita</h1>
        <form action="wanita.php" method="post">
        <table>
            <tr>
                <td>Nama Mempelai Wanita</td>
                <td><input type="text" name="namawanita" required></td>
            </tr>
            <tr>
                <td>Nama Ayah Mempelai</td>
                <td><input type="text" name="ayahwanita" required></td>
            </tr>
            <tr>
                <td>Nama Ibu Mempelai</td>
                <td><input type="text" name="ibuwanita" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="tambah">Tambah</button></td>
            </tr>
        </table>
    </form>

       
    <h2>Tabel Mempelai Wanita</h2>
    <table border="1" style="border-collapse: collapse;" cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Nama Mempelai Wanita</th>
            <th>Nama Mempelai Ayah wanita</th>
            <th>Nama Mempelai Ibu wanita</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['id_mempelaiwanita']."</td>";
                echo "<td>".$row['nama_wanita']."</td>";
                echo "<td>".$row['ayah_wanita']."</td>";
                echo "<td>".$row['ibu_wanita']."</td>";
                echo "<td><a href = 'wanita.php?ubah=".$row['id_mempelaiwanita']."'>Edit</a>
                | <a href = 'wanita.php?hapus=".$row['id_mempelaiwanita']."'>Hapus</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="cerita.php">Next</a>
    <?php
        if(isset($_GET['ubah'])) {
            $id_mempelaiwanita = $_GET['ubah'];
            $select = "SELECT * FROM mempelaiwanita WHERE id_mempelaiwanita=$id_mempelaiwanita";
            $query = mysqli_query($conn, $select);
            $row = mysqli_fetch_array($query);
    ?>
    <h2>Edit Mempelai wanita</h2>
    <form action="wanita.php" method="post">
        <table>
            <tr>
                <td>Nama Mempelai wanita</td>
                <td><input type="text" name="namawanita" required value="<?php echo $row['nama_wanita']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Mempelai Ayah wanita</td>
                <td><input type="text" name="ayahwanita" required value="<?php echo $row['ayah_wanita']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Mempelai Ibu wanita</td>
                <td><input type="text" name="ibuwanita" required value="<?php echo $row['ibu_wanita']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_mempelaiwanita" value="<?php echo $row['id_mempelaiwanita']; ?>"></td>
                <td><button type="submit" name="ubah">Ubah</button></td>
            </tr>
        </table>
    </form>
    <?php
        }
    ?>
    </body>
    </html>