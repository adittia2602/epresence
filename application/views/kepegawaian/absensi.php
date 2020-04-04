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
                        <div class="card-body row">
                            <div class="col-md-6 offset-6">
                                <form class = "form-horizontal " action="<?= base_url('kepegawaian/absensi'); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="cod_awal">Tanggal Awal: </label>
                                        <input type="date" class="form-control" id="cod_awal" name="cod_awal" value="<?= $cod_awal; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cod_akhir">Tanggal Akhir: </label>
                                        <input type="date" class="form-control" id="cod_akhir" name="cod_akhir" value="<?= $cod_akhir; ?>">
                                    </div>
                                    <div class="form-group col-md-6 offset-6">
                                        <button type="submit" class="btn btn-primary btn-md col-md-12">Filter</button>
                                    </div>
                                </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>TANGGAL</th>
                                            <th>NAMA</th>
                                            <th>KEHADIRAN</th>
                                            <th>KONDISI</th>
                                            <th>URAIAN KONDISI</th>
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
                                                <td><?= $a['tgl']; ?></td>
                                                <td><?= $a['nama_pegawai']; ?></td>
                                                <td><?= $a['kehadiran'];?> </td>
                                                <td><?= $a['kondisi_kesehatan'];?> </td>
                                                <td><?= $a['uraian_kondisi_kesehatan']; ?></td>
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