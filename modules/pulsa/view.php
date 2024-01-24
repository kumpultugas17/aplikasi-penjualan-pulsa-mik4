<div class="row my-3">
   <div class="col-md-12">
      <h5>
         <i class="fas fa-mobile me-1"></i> Data Pulsa
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
                  <th>Operator</th>
                  <th>Nominal</th>
                  <th>Harga</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM pulsa ORDER BY id_pulsa DESC");
               foreach ($query as $pls) :
               ?>
                  <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $pls['operator'] ?></td>
                     <td><?= $pls['nominal'] ?></td>
                     <td><?= $pls['harga'] ?></td>
                     <td>
                        <button type="button" class="btn btn-info btn-sm text-white" data-bs-target="#editModal<?= $pls['id_pulsa'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-user-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm text-white" data-bs-target="#hapusModal<?= $pls['id_pulsa'] ?>" data-bs-toggle="modal">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                  </tr>

                  <!-- Modal Edit-->
                  <div class="modal fade" id="editModal<?= $pls['id_pulsa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Edit Data Pulsa</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/pulsa/proses_edit.php" method="post">
                              <input type="hidden" name="id_pulsa" value="<?= $pls['id_pulsa'] ?>">
                              <div class="modal-body px-4">
                                 <div class="mb-3">
                                    <label for="operator" class="form-label">Operator</label>
                                    <input type="text" class="form-control" name="operator" id="operator" value="<?= $pls['operator'] ?>" autocomplete="off">
                                 </div>
                                 <div class="mb-3">
                                    <label for="nominal" class="form-label">Nominal</label>
                                    <input type="number" class="form-control" name="nominal" id="nominal" value="<?= $pls['nominal'] ?>" autocomplete="off">
                                 </div>
                                 <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="harga" value="<?= $pls['harga'] ?>" autocomplete="off">
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

                  <!-- Modal Hapus-->
                  <div class="modal fade" id="hapusModal<?= $pls['id_pulsa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus Data Pulsa</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form action="modules/pulsa/proses_hapus.php" method="post">
                              <input type="hidden" name="id_pulsa" value="<?= $pls['id_pulsa'] ?>">
                              <div class="modal-body px-4">
                                 <div class="fs-6">Apakah Operator <strong><?= $pls['operator'] ?></strong> dengan nominal <strong><?= $pls['nominal'] ?></strong> akan dihapus?</div>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-mobile-alt"></i> Entry Data Pulsa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="modules/pulsa/proses_tambah.php" method="post">
            <div class="modal-body px-4">
               <div class="mb-3">
                  <label for="operator" class="form-label">Operator</label>
                  <input type="text" class="form-control" name="operator" id="operator" placeholder="Masukkan operator" autocomplete="off">
               </div>
               <div class="mb-3">
                  <label for="nominal" class="form-label">Nominal</label>
                  <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukkan nominal" autocomplete="off">
               </div>
               <div class="mb-3">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga" autocomplete="off">
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