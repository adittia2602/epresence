        <div class="section-body">
          <h2 class="section-title"> Daftar Laporan WFH : <?=$pegawai['nama_pegawai'];?> </h2>
          <p class="section-lead"> </p>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert ">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= form_error('accesspublic', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url("wfh/input");?>" class="btn btn-primary">Input Kegiatan WFH</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>
                                            #
                                            </th>
                                            <th>TANGGAL</th>
                                            <th>KONDISI KESEHATAN</th>
                                            <th>JUDUL KEGIATAN</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($laporan as $a) : ?>
                                        <tr>
                                            <td class="text-center">
                                            <?= $i ?>
                                            </td>
                                            <td><?= $a['clockin'] ?></td>
                                            <td><?= $a['kondisi_kesehatan']; ?></td>
                                            <td><?= $a['judul_kegiatan']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($a['status_laporan'] === '1') 
                                                        { echo 'Menunggu Approval'; }
                                                    else if ($a['status_laporan'] === '2') 
                                                        { echo 'Disetujui'; }
                                                    else if ($a['status_laporan'] === '0') 
                                                        { echo 'Ditolak'; } ; 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($a['status_laporan'] === '1') 
                                                        { $badge =  'warning'; }
                                                    else if ($a['status_laporan'] === '2') 
                                                        { $badge =  'success'; }
                                                    else if ($a['status_laporan'] === '0') 
                                                        { $badge =  'danger'; } 
                                                ?>
                                                <a href="" class="badge badge-<?= $badge;?>" data-toggle="modal" data-target="#viewLaporan<?=$a['id'];?>">Lihat Laporan</a>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach;?>
                                    </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>

      <!-- Modal Edit -->
    <?php foreach ($laporan as $sm) : ?>
        <div class="modal fade" id="viewLaporan<?=$sm['id'];?>" tabindex="-1" role="dialog" aria-labelledby="viewLaporanTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewLaporanTitle">Laporan Kegiatan : <?= $sm['clockin']?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            
                            <div class="row mb-5">
                                <div class="col-3 text-left"> Nama </div>  <div class="col-8 text-left">: <b><?= $pegawai['nama_pegawai']?></b> </div>
                                <div class="col-3 text-left"> NIP </div>  <div class="col-8 text-left">: <b><?= $pegawai['nip_pegawai']?></b> </div>
                                <div class="col-3 text-left"> Jabatan </div>  <div class="col-8 text-left">: <?= $pegawai['nama_jabatan']?> - Divisi <?= $pegawai['divisi']?> </div>
                                <?php 
                                    if ($sm['status_laporan'] === '1') 
                                        { $badge =  'warning'; }
                                    else if ($sm['status_laporan'] === '2') 
                                        { $badge =  'success'; }
                                    else if ($sm['status_laporan'] === '0') 
                                        { $badge =  'danger'; } 
                                ?>
                                <div class="col-12 badge badge-<?= $badge;?> mt-5">  
                                    <?php 
                                        if ($sm['status_laporan'] === '1') 
                                            { echo 'Menunggu Approval'; }
                                        else if ($sm['status_laporan'] === '2') 
                                            { echo 'Disetujui pada tanggal : '.$sm['approval_ts']; }
                                        else if ($sm['status_laporan'] === '0') 
                                            { echo 'Ditolak pada tanggal : '.$sm['approval_ts']; }  
                                    ?>
                                </div>
                            </div>
                            
                            <div class="form-group ">
                                <label class="control-label" for="kondisi">Kondisi Kesehatan : </label>
                                <input id="uraiankondisi" type="text" class="form-control" name="uraiankondisi" value="<?= $sm['kondisi_kesehatan'];?>" disabled>
                                
                            </div>

                            <div class="form-group">
                                <label for="uraiankondisi">Uraian Kondisi Kesehatan :  </label>
                                <input id="uraiankondisi" type="text" class="form-control" name="uraiankondisi" value="<?= $sm['uraian_kondisi_kesehatan'];?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="judul">Judul Kegiatan : </label>
                                <input id="judul" type="text" class="form-control" name="judul" value="<?= $sm['judul_kegiatan'];?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="uraiankegiatan">Uraian Kegiatan :  </label>
                                <textarea class="form-control" id="uraiankegiatan" name="uraiankegiatan" rows="30" style="height: 500px;" disabled><?= $sm['uraian_kegiatan'];?></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach;?>