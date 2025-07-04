<!-- letakkan proses update data disini -->
<?php

if (isset($_POST['update'])) {
  $nis = $_POST['nis'];
  $nama_siswa = $_POST['nama_siswa'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];

  // proses update
  $sql = "UPDATE siswa SET nis='$nis',nama_siswa='$nama_siswa',alamat='$alamat',telp='$telp' WHERE nis='$nis'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=siswa");
  }
}

$nis = $_GET['nis'];

$sql = "SELECT * FROM siswa WHERE nis='$nis'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-primary text-white border-dark"><strong>Update Data Siswa</strong></div>
          <div class="card-body">

            <div class="form-group">
              <label for="">NIS</label>
              <input type="text" class="form-control" value="<?php echo $row['nis']?>" name="nis" readonly>
            </div>
            <div class="form-group">
              <label for="">Nama Siswa</label>
              <input type="text" class="form-control" value="<?php echo $row['nama_siswa']?>" name="nama_siswa" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="">Alamat</label>
              <input type="text" class="form-control" value="<?php echo $row['alamat']?>" name="alamat" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="">No. Telepon</label>
              <input type="text" class="form-control" value="<?php echo $row['telp']?>" name="telp" maxlength="15" required>
            </div>

            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?page=siswa">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>