<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <!-- judul halaman tampil data laporan -->
         <i class="fas fa-file-alt me-1 title-icon"></i> Data Laporan Penjualan
      </h5>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
      <!-- Pesan Suksess -->
      <?php
      if (isset($_SESSION['alert'])) {
      ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i><strong>Sukses!</strong> <?= $_SESSION['alert'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert']);
      ?>
      <!-- Pesan Gagal -->
      <?php
      if (isset($_SESSION['alert_fail'])) {
      ?>
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i><strong>Gagal!</strong> <?= $_SESSION['alert_fail'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert_fail']);
      ?>

      <div class="mb-2">Filter</div>

      <form action="modules/laporan/get_data.php" class="row gx-3 gy-2 align-items-center" method="post">
         <div class="col-sm-6">
            <div class="input-group">
               <input type="text" class="date-picker form-control" name="tgl_awal" placeholder="Pilih tanggal awal" autocomplete="off" required>
               <div class="input-group-text">to</div>
               <input type="text" class="date-picker form-control" name="tgl_akhir" placeholder="Pilih tanggal akhir" autocomplete="off" required>
            </div>
         </div>
         <div class="col-sm-6">
            <button type="submit" name="cari" class="btn btn-info text-light">
               <i class="fas fa-search"></i> Cari
            </button>
            <?php
            if (isset($_SESSION['tgl_awal'])) {
               $tgl_awal = $_SESSION['tgl_awal'];
               $tgl_akhir = $_SESSION['tgl_akhir'];
            ?>
               <a href="modules/laporan/pdf.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-danger bg-gradient float-end">
                  <i class="fas fa-file-pdf"></i> Export pdf
               </a>
               <a href="modules/laporan/xls.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-success bg-gradient float-end me-2">
                  <i class="fas fa-file-excel"></i> Export xls</a>
            <?php
            }
            ?>
         </div>
      </form>


      <hr class="my-4">
      <div class="table-responsive">
         <table class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Nama Pelanggan</th>
                  <th>No. HP</th>
                  <th>Operator</th>
                  <th>Nominal Pulsa</th>
                  <th>Harga</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM penjualan INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.id_pelanggan INNER JOIN pulsa ON penjualan.pulsa_id = pulsa.id_pulsa WHERE penjualan.tanggal ORDER BY penjualan.tanggal DESC");
               foreach ($query as $data) :
               ?>
                  <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $data['tanggal'] ?></td>
                     <td><?= $data['nama_pelanggan'] ?></td>
                     <td><?= $data['no_hp'] ?></td>
                     <td><?= $data['operator'] ?></td>
                     <td><?= number_format($data['nominal'], 0, ',', '.') ?></td>
                     <td>Rp. <?= number_format($data['harga'], 0, ',', '.') ?></td>
                  </tr>
               <?php
               endforeach
               ?>
            </tbody>
         </table>
      </div>

   </div>
</div>