<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Pendaftaran</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=pendaftaran&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="25px">No</th>
          <th width="50px">Tanggal</th>
          <th width="25px">Tahun</th>
          <th width="70px">NIS</th>
          <th width="150px">Nama</th>
          <th width="140px">Pendapatan Ortu</th>
          <th width="25px">Nilai</th>
          <th width="100px">Jml Saudara</th>
          <th width="95px">Edit | Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = "SELECT pendaftaran.iddaftar, pendaftaran.tgldaftar, pendaftaran.tahun, pendaftaran.nis, siswa.nama_siswa, pendaftaran.pendapatan_ortu, pendaftaran.rata_nilai, pendaftaran.jml_saudara
        FROM siswa INNER JOIN pendaftaran ON siswa.nis = pendaftaran.nis ORDER BY iddaftar DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['tgldaftar']; ?></td>
            <td><?php echo $row['tahun']; ?></td>
            <td><?php echo $row['nis']; ?></td>
            <td><?php echo $row['nama_siswa']; ?></td>
            <td><?php echo $row['pendapatan_ortu']; ?></td>
            <td><?php echo $row['rata_nilai']; ?></td>
            <td><?php echo $row['jml_saudara']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=pendaftaran&action=update&id=<?php echo $row['iddaftar']; ?>">
                <span class="fa fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=pendaftaran&action=hapus&id=<?php echo $row['iddaftar']; ?>">
                <span class="fa fa-trash"></span>
              </a>
            </td>
          </tr>
        <?php
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>