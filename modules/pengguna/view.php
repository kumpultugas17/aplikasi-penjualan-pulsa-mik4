<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <i class="fas fa-user me-1"></i> Data Pengguna
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-sm btn-info text-white float-end" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah
         </button>
      </h5>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
      <?php
      if (isset($_SESSION['alert'])) {
      ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Sukses!</strong> <?= $_SESSION['alert']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert']);
      ?>
      <?php
      if (isset($_SESSION['alert_konfirmasi'])) {
      ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Peringatan!</strong> <?= $_SESSION['alert_konfirmasi']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php
      }
      unset($_SESSION['alert_konfirmasi']);
      ?>
      <div class="table-responsive">
         <table class="table table-bordered" id="data">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama Pengguna</th>
                  <th>E-Mail</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM pengguna ORDER BY id_pengguna DESC");
               foreach ($query as $pgn) :
               ?>
                  <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $pgn['nama_pengguna'] ?></td>
                     <td><?= $pgn['email'] ?></td>
                     <td>
                        <button type="button" class="btn btn-danger btn-sm text-white" data-bs-target="#hapusModal<?= $pgn['id_pengguna'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                  </tr>

                  <!-- Modal Hapus-->
                  <div class="modal fade" id="hapusModal<?= $pgn['id_pengguna'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus Data Pelanggan</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/pengguna/proses_hapus.php" method="post">
                              <input type="hidden" name="id_pengguna" value="<?= $pgn['id_pengguna'] ?>">
                              <div class="modal-body px-4">
                                 <div class="fs-6">Apakah Pengguna <strong><?= $pgn['nama_pengguna'] ?></strong> dengan email <strong><?= $pgn['email'] ?></strong> akan dihapus?</div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" name="submit" class="btn btn-sm btn-danger text-white">Hapus</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Entry Data Pengguna</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="modules/pengguna/proses_tambah.php" method="post">
            <div class="modal-body px-4">
               <div class="mb-3">
                  <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Masukkan nama pengguna" autocomplete="off">
               </div>
               <div class="mb-3">
                  <label for="email" class="form-label">E-Mail</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" autocomplete="off">
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" autocomplete="off">
               </div>
               <div class="mb-3 mt-4">
                  <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder="Ulangi password" autocomplete="off">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" name="submit" class="btn btn-sm btn-info text-white">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>