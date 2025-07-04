<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpan'])) {
  $tgl = date("Y-m-d");
  $tahun = $_POST['tahun'];
  $nama = $_POST['nama'];
  $pendapatan = $_POST['pendapatan'];
  $nilai = $_POST['nilai'];
  $saudara = $_POST['saudara'];

  // validasi data pendaftaran
  $sql = "SELECT*FROM pendaftaran WHERE tahun='$tahun' AND nis='$nama'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
?>
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Data sudah ada</strong>
    </div>
<?php
  } else {
    //proses simpan data pendaftaran
    $sql = "INSERT INTO pendaftaran VALUES (Null,'$tgl','$tahun','$nama','$pendapatan','$nilai','$saudara')";
    if ($conn->query($sql) === TRUE) {
      header("Location:?page=pendaftaran");
    }
  }
}
?>


<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-primary text-white border-dark"><strong>Input Data Pendaftaran</strong></div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Tahun</label>
              <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                <option value=""></option>
                <?php
                for ($x = date("Y"); $x >= 2015; $x--) {
                ?>
                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Nama Siswa</label>
              <select class="form-control chosen" data-placeholder="Pilih Nama Siswa" name="nama">
                <option value=""></option>
                <?php
                $sql = "SELECT * FROM siswa ORDER BY nama_siswa ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <option value="<?php echo $row['nis']; ?>"><?php echo $row['nis'] . " - " . $row['nama_siswa']; ?></option>
                <?php
                }
                ?>
              </select>

            </div>
            <div class="form-group">
              <label for="">Pendapatan Orang Tua</label>
              <input type="number" class="form-control" name="pendapatan" min="0" max="999999999" required>
            </div>
            <div class="form-group">
              <label for="">Nilai Rata-Rata</label>
              <input type="number" class="form-control" name="nilai" step="0.01" min="10" max="100" required>
            </div>
            <div class="form-group">
              <label for="">Jumlah Saudara</label>
              <input type="number" class="form-control" name="saudara" min="0" max="50" required>
            </div>

            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
            <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>