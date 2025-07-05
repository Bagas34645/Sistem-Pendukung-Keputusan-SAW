<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Users</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=users&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="25px">No.</th>
          <th width="200px">Username</th>
          <th width="400px">Password</th>
          <th width="90px">Level</th>
          <th width="90px">Edit | Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        $sql = "SELECT*FROM users ORDER BY username ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['pass']; ?></td>
            <td><?php echo $row['level']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=users&action=update&id=<?php echo $row['id']; ?>">
                <span class="fa fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=users&action=hapus&id=<?php echo $row['id']; ?>">
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