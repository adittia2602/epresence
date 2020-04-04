      <div class="section-body">
          <h2 class="section-title"> Daftar Absensi <?= $pegawai['nama_pegawai']; ?></h2>
          <p class="section-lead"> </p>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert ">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= form_error('accesspublic', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <!-- List Daftar Hadir  -->
                <div class="col-md-<?= $col_list; ?>">
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
                                            <th>CLOCK IN</th>
                                            <th>CLOCK OUT</th>
                                            <th>KONDISI KESEHATAN</th>
                                            <th>KETERANGAN</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($absensi as $a) : 
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                            <?= $i ?>
                                            </td>
                                            <td><?= $a['tgl'] ?></td>
                                            <td><?= $a['t_clockin'] ?></td>
                                            <td><?= $a['t_clockout']; ?></td>
                                            <td><?= $a['kondisi_kesehatan']; ?></td>
                                            <td><?= $a['kehadiran']; ?></td>
                                        </tr>
                                        <?php $i++; endforeach;?>
                                    </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clock IN  -->
                <div class="col-md-4 <?= $show = $todayabsen ? "d-none" : "d-block" ?>">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5> Absensi Pegawai PIP </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#absenHadir">
                                    Clock In
                                </button><br/>
                                <p class="text-center">atau </p>
                                <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#absenIjin">
                                    Izin / Cuti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?= $box_clockout; ?>

                <?= $box_notif; ?>
                
            </div>
        </section>
      </div>

    <!-- Absen Hadir  -->
    <div class="modal fade" id="absenHadir" tabindex="-1" role="dialog" aria-labelledby="absenHadirTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absenHadirTitle">Absen Clock IN</h5>
                    <p> Form ini bertujuan untuk Monitoring Kondisi Kesehatan Pegawai selama WFH </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="<?php echo base_url('home/absenhadir/'.$user['id'].'/'.$user['nip_pegawai'].'/'); ?>">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label class="control-label" for="kondisi">Kondisi Kesehatan : </label>
                            <select name="kondisi" id="kondisi" class="form-control form-control-lg">
                                <option value="Sehat" selected> Sehat </option>
                                <option value="Kurang Sehat"> Kurang Sehat </option>
                                <option value="Tidak Sehat"> Tidak Sehat </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="uraiankondisi">Uraian Kondisi Kesehatan :  </label>
                            <input id="uraiankondisi" type="text" class="form-control" name="uraiankondisi">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Clock IN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Ijin/Cuti -->
    <div class="modal fade" id="absenIjin" tabindex="-1" role="dialog" aria-labelledby="absenIjinTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absenIjinTitle">Pengajuan Izin / Cuti</h5>
                    <!-- <p> Form ini bertujuan untuk Monitoring Kondisi Kesehatan Pegawai selama WFH </p> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="<?php echo base_url('home/absenijin/'.$user['id'].'/'.$user['nip_pegawai'].'/'); ?>">
                    <div class="modal-body">
                        <div class="form-group ">
                            <label class="control-label" for="kehadiran">Pengajuan : </label>
                            <select name="kehadiran" id="kehadiran" class="form-control form-control-lg">
                                <option value="Izin" selected> Izin </option>
                                <option value="Cuti"> Cuti </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan :  </label>
                            <input id="keterangan" type="text" class="form-control" name="keterangan">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
    
                        

