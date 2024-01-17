<div class="row my-3">
   <div class="col-md-12">
      <h5><i class="fas fa-user-alt me-1"></i> Data Pelanggan</h5>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-sm btn-info text-white float-end" data-bs-toggle="modal" data-bs-target="#tambahModal">
         <i class="fas fa-plus"></i> Tambah
      </button>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md-12">
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama Pelanggan</th>
                  <th>No. Handphone</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               $query = $conn->query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
               foreach ($query as $plg) :
               ?>
                  <tr>
                     <td><?= $no++ ?></td>
                     <td><?= $plg['nama_pelanggan'] ?></td>
                     <td><?= $plg['no_hp'] ?></td>
                     <td>Aksi</td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            ...
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>