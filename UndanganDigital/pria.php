
<?php
session_start();
include "koneksi.php";

if(isset($_POST['tambah'])){
    $nama_pria = $_POST['namapria'];
    $ayah_pria = $_POST['ayahpria'];
    $ibu_pria = $_POST['ibupria'];

    $sql = "INSERT INTO mempelaipria(nama_pria, ayah_pria, ibu_pria) VALUES ('$nama_pria', '$ayah_pria','$ibu_pria')";
    $query = mysqli_query($conn, $sql);
    
    if($query){
        // Mengambil ID yang baru saja di-generate dari operasi INSERT sebelumnya
        $lastInsertedId = mysqli_insert_id($conn);
        
        // Memasukkan ID yang baru saja di-generate ke dalam tabel pengantin
        $sql = "INSERT INTO pengantin(id_mempelaipria) VALUES ('$lastInsertedId')";
        $query = mysqli_query($conn, $sql);
        
        if($query) {
            echo "<script>alert('Berhasil menambahkan mempelai pria');window.location.href = 'pria.php';</script>";
        } else {
            // Handle jika terjadi kesalahan pada operasi INSERT ke tabel pengantin
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle jika terjadi kesalahan pada operasi INSERT ke tabel mempelaipria
        echo "Error: " . mysqli_error($conn);
    }
}
    

if(isset($_POST['ubah'])) {
    $id_mempelaipria = $_POST['id_mempelaipria'];
    $nama_pria = $_POST['namapria'];
    $ayah_pria = $_POST['ayahpria'];
    $ibu_pria = $_POST['ibupria'];

    $update = "UPDATE mempelaipria SET nama_pria='$nama_pria', ayah_pria='$ayah_pria', ibu_pria='$ibu_pria' WHERE id=$id";
    mysqli_query($conn, $update);
}

if(isset($_GET['hapus'])) {
    $id_mempelaipria = $_GET['hapus'];

    $delete = "DELETE FROM mempelaipria WHERE id_mempelaipria=$id_mempelaipria";
    mysqli_query($conn, $delete);
}

    $select = "SELECT * FROM mempelaipria";
    $query = mysqli_query($conn, $select);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mempelai Pria</title>
</head>

<body>
    <h1>Masukkan Data Mempelai Pria</h1>
    <a href="pengantin.php">Data Pengantin</a>
    <form action="pria.php" method="post"> <!-- Perbaiki formulir di sini -->
        <table>
            <tr>
                <td>Nama Mempelai Pria</td>
                <td><input type="text" name="namapria" required></td>
            </tr>
            <tr>
                <td>Nama Ayah Mempelai</td>
                <td><input type="text" name="ayahpria" required></td>
            </tr>
            <tr>
                <td>Nama Ibu Mempelai</td>
                <td><input type="text" name="ibupria" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="tambah">Tambah</button></td>
            </tr>
        </table>
    </form>
    
    <h2>Tabel Mempelai Pria</h2>
    <table border="1" style="border-collapse: collapse;" cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Nama Mempelai Pria</th>
            <th>Nama Mempelai Ayah Pria</th>
            <th>Nama Mempelai Ibu Pria</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['id_mempelaipria']."</td>";
                echo "<td>".$row['nama_pria']."</td>";
                echo "<td>".$row['ayah_pria']."</td>";
                echo "<td>".$row['ibu_pria']."</td>";
                echo "<td><a href = 'pria.php?ubah=".$row['id_mempelaipria']."'>Edit</a>
                | <a href = 'pria.php?hapus=".$row['id_mempelaipria']."'>Hapus</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="wanita.php">Next</a>
    <?php
        if(isset($_GET['ubah'])) {
            $id = $_GET['ubah'];
            $select = "SELECT * FROM mempelaipria WHERE id_mempelaipria=$id_mempelaipria";
            $query = mysqli_query($conn, $select);
            $row = mysqli_fetch_array($query);
    ?>
    <h2>Edit Mempelai Pria</h2>
    <form action="pria.php" method="post">
        <table>
            <tr>
                <td>Nama Mempelai Pria</td>
                <td><input type="text" name="namapria" required value="<?php echo $row['nama_pria']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Mempelai Ayah Pria</td>
                <td><input type="text" name="ayahpria" required value="<?php echo $row['ayah_pria']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Mempelai Ibu Pria</td>
                <td><input type="text" name="ibupria" required value="<?php echo $row['ibu_pria']; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id_mempelaipria" value="<?php echo $row['id_mempelaipria']; ?>"></td>
                <td><button type="submit" name="ubah">Ubah</button></td>
            </tr>
        </table>
        
    </form>
    <?php
        }
    ?>
    <!-- Perbaiki formulir di sini -->
</body>

</html>
