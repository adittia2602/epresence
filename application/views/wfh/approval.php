<div class="section-body">
          <h2 class="section-title"> Daftar Laporan WFH Divisi: <?=$pegawai['divisi'];?> </h2>
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
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>
                                            #
                                            </th>
                                            <th>TANGGAL</th>
                                            <th>NAMA PEGAWAI</th>
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
                                            <td><?= date($a['clockin']) ?></td>
                                            <td><?= $a['nama_pegawai']; ?></td>
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
                        <h5 class="modal-title" id="viewLaporanTitle">Laporan Kegiatan </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="row mb-5">
                                <div class="col-3 text-left"> Nama </div>  <div class="col-8 text-left">: <b><?= $sm['nama_pegawai']?></b> </div>
                                <div class="col-3 text-left"> Divisi </div>  <div class="col-8 text-left">:  <?= $pegawai['divisi']?></div>
                                <div class="col-3 text-left"> Waktu Pelaporan </div>  <div class="col-8 text-left">: <?= $sm['clockin']?> </div>
                                <div class="col-3 text-left"> Status </div>   
                                    <?php 
                                        if ($a['status_laporan'] === '1') 
                                            { $badge =  'warning'; }
                                        else if ($a['status_laporan'] === '2') 
                                            { $badge =  'success'; }
                                        else if ($a['status_laporan'] === '0') 
                                            { $badge =  'danger'; } 
                                    ?>
                                    <div class="col-8 badge badge-<?= $badge;?>">  
                                        <?php 
                                            if ($a['status_laporan'] === '1') 
                                                { echo 'Menunggu Approval'; }
                                            else if ($a['status_laporan'] === '2') 
                                                { echo 'Disetujui'; }
                                            else if ($a['status_laporan'] === '0') 
                                                { echo 'Ditolak'; }  
                                        ?>
                                    </div>
                            </div>

                            <form method="POST" action="<?php echo base_url('wfh/approveLaporan/'.$sm['id']); ?>">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" name='approve'>
                                        Approve
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-lg btn-block" name='reject'>
                                        Reject
                                    </button>
                                </div>
                                <?php 
                                    $_POST['nip_approval'] = $pegawai['nip_pegawai'];
                                ?>
                            </form>
                            
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
                                <textarea class="form-control" id="uraiankegiatan" name="uraiankegiatan" rows="30" style="height: 300px;" disabled><?= $sm['uraian_kegiatan'];?></textarea>
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