<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpan'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $level = $_POST['level'];

  // validasi
  $sql = "SELECT*FROM users WHERE username='$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
?>
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Username sudah digunakan</strong>
    </div>
<?php
  } else {
    //proses simpan
    $sql = "INSERT INTO users VALUES (Null,'$username','$password','$level')";
    if ($conn->query($sql) === TRUE) {
      header("Location:?page=users");
    }
  }
}
?>


<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card">
          <div class="card-header bg-primary text-white border-dark"><strong>Input Data Users</strong></div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username" maxlength="20" required>
            </div>
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control" name="password" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="">Level</label>
              <select class="form-control chosen" data-placeholder="Pilih Level" name="level">
                <option value=""></option>
                <option value="Super Admin">Super Admin</option>
                <option value="Sub Admin">Sub Admin</option>
                <option value="Pimpinan">Pimpinan</option>
              </select>
            </div>

            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
            <a class="btn btn-danger" href="?page=users">Batal</a>

          </div>
        </div>
    </form>
  </div>
</div>