<!-- letakkan proses update data disini -->
<?php

$id = $_GET['id'];

if (isset($_POST['update'])) {
  $pendapatan = $_POST['pendapatan'];
  $nilai = $_POST['nilai'];
  $saudara = $_POST['saudara'];

  // proses update
  $sql = "UPDATE pendaftaran SET pendapatan_ortu='$pendapatan', rata_nilai='$nilai', jml_saudara='$saudara' WHERE iddaftar='$id'";
  if ($conn->query($sql) === TRUE) {
    header("Location:?page=pendaftaran");
  }
}

$sql = "SELECT pendaftaran.iddaftar, pendaftaran.tgldaftar, pendaftaran.tahun, pendaftaran.nis, siswa.nama_siswa, pendaftaran.pendapatan_ortu, pendaftaran.rata_nilai, pendaftaran.jml_saudara
        FROM siswa INNER JOIN pendaftaran ON siswa.nis = pendaftaran.nis WHERE iddaftar='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-primary text-white border-dark"><strong>Update Data Pendaftaran</strong></div>
          <div class="card-body">

            <div class="form-group">
              <label for="">Tahun</label>
              <input type="text" class="form-control" value="<?php echo $row['tahun'] ?>" name="tahun" readonly>
            </div>
            <div class="form-group">
              <label for="">NIS</label>
              <input type="text" class="form-control" value="<?php echo $row['nis'] ?>" name="nis" readonly>
            </div>
            <div class="form-group">
              <label for="">Nama Siswa</label>
              <input type="text" class="form-control" value="<?php echo $row['nama_siswa'] ?>" readonly>
            </div>
            <div class="form-group">
              <label for="">Pendapatan Orang Tua</label>
              <input type="number" class="form-control" value="<?php echo $row['pendapatan_ortu'] ?>" name="pendapatan" min="0" max="999999999" required>
            </div>
            <div class="form-group">
              <label for="">Nilai Rata-Rata</label>
              <input type="number" class="form-control" value="<?php echo $row['rata_nilai'] ?>" name="nilai" step="0.01" min="10" max="100" required>
            </div>
            <div class="form-group">
              <label for="">Jumlah Saudara</label>
              <input type="number" class="form-control" value="<?php echo $row['jml_saudara'] ?>" name="saudara" min="0" max="50" required>
            </div>

            <input class="btn btn-primary" type="submit" name="update" value="Update">
            <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>