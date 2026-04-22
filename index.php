<?php
$conn = mysqli_connect("localhost", "root", "", "booking_lapangan");

// hapus data
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM boking WHERE id_booking=$id");
}

// ambil data edit
$edit = false;
if(isset($_GET['edit'])){
    $edit = true;
    $id = $_GET['edit'];
    $ambil = mysqli_query($conn,"SELECT * FROM boking WHERE id_booking=$id");
    $data_edit = mysqli_fetch_array($ambil);
}

// update data
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $lapangan = $_POST['lapangan'];
    $status = $_POST['status'];

    mysqli_query($conn,"UPDATE boking SET
        nama_pemesan='$nama',
        tanggal_booking='$tanggal',
        jam_booking='$jam',
        lapangan='$lapangan',
        status='$status'
        WHERE id_booking=$id");

    header("Location:index.php");
}

// simpan data baru
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $lapangan = $_POST['lapangan'];
    $status = $_POST['status'];

    mysqli_query($conn,"INSERT INTO boking
    VALUES(NULL,'$nama','$tanggal','$jam','$lapangan','$status')");
}

$data = mysqli_query($conn,"SELECT * FROM boking");
?>

<!DOCTYPE html>
<html>
<head>
<title>Sistem Booking Lapangan Futsal</title>

<style>

body{
font-family: Segoe UI;
background:#eef1f7;
margin:0;
padding:30px;
}

.navbar{
background:#2d89ef;
color:white;
padding:18px 30px;
font-size:22px;
font-weight:bold;
border-radius:10px;
margin-bottom:25px;
}

.container{
display:flex;
gap:40px;
align-items:flex-start;
}

.form-card{
background:white;
padding:25px;
border-radius:12px;
width:320px;
box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

.table-card{
flex:1;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

input,select{
width:100%;
padding:10px;
margin:8px 0 15px;
border-radius:6px;
border:1px solid #ccc;
}

button{
background:#4CAF50;
color:white;
border:none;
padding:10px;
border-radius:6px;
width:100%;
font-weight:bold;
cursor:pointer;
}

button:hover{
background:#3b8c3f;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#2d89ef;
color:white;
padding:12px;
}

td{
padding:10px;
text-align:center;
}

tr:nth-child(even){
background:#f7f9fc;
}

.edit-btn{
background:orange;
color:white;
padding:6px 10px;
border-radius:5px;
text-decoration:none;
}

.delete-btn{
background:crimson;
color:white;
padding:6px 10px;
border-radius:5px;
text-decoration:none;
}

.footer{
margin-top:25px;
text-align:center;
color:gray;
font-size:14px;
}

</style>
</head>

<body>

<div class="navbar">
Sistem Booking Lapangan Futsal — Anwar Musyaddad (21324041)
</div>

<div class="container">

<div class="form-card">

<h2>Form Booking</h2>

<form method="POST">

<?php if($edit){ ?>
<input type="hidden" name="id" value="<?= $data_edit['id_booking']; ?>">
<?php } ?>

Nama
<input type="text" name="nama"
value="<?= $edit ? $data_edit['nama_pemesan'] : '' ?>" required>

Tanggal
<input type="date" name="tanggal"
value="<?= $edit ? $data_edit['tanggal_booking'] : '' ?>" required>

Jam
<input type="time" name="jam"
value="<?= $edit ? $data_edit['jam_booking'] : '' ?>" required>

Lapangan
<input type="text" name="lapangan"
value="<?= $edit ? $data_edit['lapangan'] : '' ?>" required>

Status
<select name="status">
<option value="booking">booking</option>
<option value="selesai">selesai</option>
<option value="batal">batal</option>
</select>

<?php if($edit){ ?>
<button type="submit" name="update">Update Data</button>
<?php } else { ?>
<button type="submit" name="simpan">Simpan Data</button>
<?php } ?>

</form>

</div>

<div class="table-card">

<h2>Data Booking Lapangan</h2>

<table>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Lapangan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_array($data)) { ?>

<tr>
<td><?= $row['id_booking']; ?></td>
<td><?= $row['nama_pemesan']; ?></td>
<td><?= $row['tanggal_booking']; ?></td>
<td><?= $row['jam_booking']; ?></td>
<td><?= $row['lapangan']; ?></td>
<td><?= $row['status']; ?></td>
<td>
<a class="edit-btn" href="?edit=<?= $row['id_booking']; ?>">Edit</a>
<a class="delete-btn" href="?hapus=<?= $row['id_booking']; ?>">Hapus</a>
</td>
</tr>

<?php } ?>

</table>

</div>

</div>

<div class="footer">
Dibuat oleh: Anwar Musyaddad (21324041)
</div>

</body>
</html>