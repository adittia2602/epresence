        <div class="section-body">
          <h2 class="section-title"> Daftar Absensi Pegawai PIP </h2>
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
                            <form class = "form-horizontal col-md-6  offset-md-6" action="<?= base_url('kepegawaian/absensi'); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="cod" class="col-sm-12 col-md-4 col-form-label">Tanggal : </label>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="date" class="form-control" id="cod" name="cod" value="<?= $cod; ?>">
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    </div>
                                </div>
                                
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>NAMA</th>
                                            <th>DIREKTORAT</th>
                                            <th>DIVISI</th>
                                            <th>KEHADIRAN</th>
                                            <th>KONDISI</th>
                                            <th>CLOCK IN</th>
                                            <th>CLOCK OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($absensi as $a) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $i ?>
                                                </td>
                                                <td><?= $a['nama_pegawai']; ?></td>
                                                <td><?= $a['direktorat']; ?></td>
                                                <td><?= $a['divisi']; ?></td>
                                                <!-- <td class="text-center"><?= $a['nip_pegawai']; ?></td> -->
                                                <td><?= $a['kehadiran'];?> </td>
                                                <td><?= $k = $a['kondisi_kesehatan'] === "-" ? $a['keterangan'] : $a['kondisi_kesehatan'] ;?> </td>
                                                <td><?= $a['t_clockin'];?> </td>
                                                <td><?= $a['t_clockout'];?> </td>
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