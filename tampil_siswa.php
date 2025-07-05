<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Siswa</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=siswa&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="70px">NIS</th>
          <th width="150px">Nama Siswa</th>
          <th width="300px">Alamat</th>
          <th width="100px">No. Telepon</th>
          <th width="95px">Edit | Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT*FROM siswa ORDER BY nis ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $row['nis']; ?></td>
            <td><?php echo $row['nama_siswa']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=siswa&action=update&nis=<?php echo $row['nis']; ?>">
                <span class="fa fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=siswa&action=hapus&nis=<?php echo $row['nis']; ?>">
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