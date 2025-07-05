<!-- <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      ?> -->

<!-- Proses Perangkingan -->
<?php

if (isset($_POST['proses'])) {
  //MENGAMBIL DATA TAHUN DARI INPUT
  $tahun = $_POST['tahun'];

  // mengambil data dari tabel pendaftaran 
  $sql = "SELECT*FROM pendaftaran WHERE tahun='$tahun'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    //mencari nilai max dan min
    $sql = "SELECT MIN(pendapatan_ortu) AS min_pendapatan, MAX(rata_nilai) AS max_nilai, MAX(jml_saudara) AS max_saudara FROM pendaftaran WHERE tahun='$tahun'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // MENGAMBIL NILAI MAX DAN MIN
    $min_pendapatan = $row['min_pendapatan'];
    $max_nilai = $row['max_nilai'];
    $max_saudara = $row['max_saudara'];

    // MENGHITUNG NILAI NORMALISASI
    $sql = "SELECT*FROM pendaftaran WHERE tahun='$tahun'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

      // mengambil data pendaftaran
      $iddaftar = $row['iddaftar'];
      $pendapatan = $row['pendapatan_ortu'];
      $rata_nilai = $row['rata_nilai'];
      $saudara = $row['jml_saudara'];

      // Menghapus data perangkingan yang lama
      $sql = "DELETE FROM perangkingan WHERE iddaftar='$iddaftar'";
      $conn->query($sql);

      // MENGHITUNG NILAI NORMALISASI
      $n_pendapatan = $min_pendapatan / $pendapatan;
      $n_rata_nilai = $rata_nilai / $max_nilai;
      $n_saudara = $saudara / $max_saudara;

      // MENGHITUNG NILAI PREFERENSI
      $preferensi = ($n_pendapatan * 0.5) + ($n_rata_nilai * 0.3) + ($n_saudara * 0.2);

      // MENYIMPAN DATA PERANGKINGAN
      $sql = "INSERT INTO perangkingan VALUES (Null,'$iddaftar','$n_pendapatan','$n_rata_nilai','$n_saudara','$preferensi')";
      if ($conn->query($sql) === TRUE) {
        header("Location:?page=perangkingan&thn=$tahun");
      }
    }
  } else {
?>
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Data tidak ditemukan</strong>
    </div>
<?php
  }
}

?>

<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Perangkingan</strong></div>
  <div class="card-body">

    <!-- Form memilih tahun dan tombol proses -->
    <form action="" method="POST">
      <div class="form-group">
        <label for="">Tahun</label>
        <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
          <option value="<?php echo $_GET['thn']; ?>"><?php echo $_GET['thn']; ?></option>
          <?php
          for ($x = date("Y"); $x >= 2015; $x--) {
          ?>
            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
    </form>

    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="70px">No.</th>
          <th width="70px">NIS</th>
          <th width="150px">Nama Siswa</th>
          <th width="300px">n_Pendapatan</th>
          <th width="100px">n_rata_nilai</th>
          <th width="100px">n_saudara</th>
          <th width="100px">preferensi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = "SELECT*FROM vperangkingan ORDER BY preferensi DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['nis']; ?></td>
            <td><?php echo $row['nama_siswa']; ?></td>
            <td><?php echo $row['n_pendapatan']; ?></td>
            <td><?php echo $row['n_rata_nilai']; ?></td>
            <td><?php echo $row['n_saudara']; ?></td>
            <td><?php echo $row['preferensi']; ?></td>
          </tr>
        <?php
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>