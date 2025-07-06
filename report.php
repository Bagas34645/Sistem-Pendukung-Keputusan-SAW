<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Laporan Perangkingan</strong></div>
  <div class="card-body">

    <!-- Form memilih tahun dan tombol proses -->
    <form action="preview.php" method="POST" target="_blank">
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
      <input class="btn btn-primary mb-2" type="submit" name="cetak" value="Cetak">
    </form>
  </div>
</div>