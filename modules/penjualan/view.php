<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <i class="fas fa-shopping-cart me-1"></i> Data Penjualan
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
      <div class="table-responsive">
         <table class="table table-bordered" id="data">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Pelanggan</th>
                  <th>Operator</th>
                  <th>Harga</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM penjualan INNER JOIN pelanggan ON penjualan.pelanggan_id = pelanggan.id_pelanggan INNER JOIN pulsa ON penjualan.pulsa_id = pulsa.id_pulsa ORDER BY tanggal DESC");
               foreach ($query as $plg) :
               ?>
                  <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $plg['tanggal'] ?></td>
                     <td><?= $plg['nama_pelanggan'] . ' - <small class=text-muted>' . $plg['no_hp'] . '</small>' ?></td>
                     <td><?= $plg['operator'] . ' - <small class=text-muted>' . $plg['nominal'] . '</small>' ?></td>
                     <td>Rp. <?= number_format($plg['harga'], 0, ',', '.') ?></td>
                     <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm text-white" data-bs-target="#hapusModal<?= $plg['id_penjualan'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                  </tr>

                  <!-- Modal Hapus-->
                  <div class="modal fade" id="hapusModal<?= $plg['id_penjualan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus Data Pelanggan</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/pelanggan/proses_hapus.php" method="post">
                              <input type="hidden" name="id_penjualan" value="<?= $plg['id_penjualan'] ?>">
                              <div class="modal-body px-4">
                                 <div class="fs-6">Apakah Pelanggan <strong><?= $plg['nama_pelanggan'] ?></strong> dengan nomor handphone <strong><?= $plg['no_hp'] ?></strong> akan dihapus?</div>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-cart-plus"></i> Entry Data Penjualan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="modules/penjualan/proses_tambah.php" method="post">
            <div class="modal-body px-4">
               <div class="mb-2">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
               </div>
               <div class="mb-2">
                  <label for="pelanggan" class="form-label">Nomor Handphone</label>
                  <select name="pelanggan" id="pelanggan" class="select-box" onchange="get_pelanggan()">
                     <?php
                     $no = 1;
                     $query = $conn->query("SELECT * FROM pelanggan");
                     foreach ($query as $pelanggan) :
                     ?>
                        <option value="<?= $pelanggan['id_pelanggan'] ?>"><?= $pelanggan['no_hp'] ?></option>
                     <?php endforeach ?>
                  </select>
               </div>
               <div class="mb-2">
                  <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                  <input type="text" id="nama_pelanggan" class="form-control">
               </div>
               <div class="mb-2">
                  <label for="pulsa" class="form-label">Operator</label>
                  <select name="pulsa" id="pulsa" class="select-box" onchange="get_pulsa()">
                     <?php
                     $no = 1;
                     $query = $conn->query("SELECT * FROM pulsa");
                     foreach ($query as $pulsa) :
                     ?>
                        <option value="<?= $pulsa['id_pulsa'] ?>"><?= $pulsa['operator'] . ' - ' . $pulsa['nominal'] ?></option>
                     <?php endforeach ?>
                  </select>
               </div>
               <div class="mb-2">
                  <label for="harga" class="form-label">Harga</label>
                  <div class="input-group">
                     <span class="input-group-text">Rp.</span>
                     <input type="number" name="harga" id="harga" class="form-control">
                  </div>
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