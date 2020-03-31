<div class="section-body">
          <h2 class="section-title"> Daftar Absensi WFH  </h2>
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
                                            <th>KEHADIRAN</th>
                                            <th>KONDISI KESEHATAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($absensi as $a) : ?>
                                        <tr>
                                            <td class="text-center">
                                            <?= $i ?>
                                            </td>
                                            <td><?= $a['clockin'] ?></td>
                                            <td><?= $a['kehadiran']; ?></td>
                                            <td><?= $a['kondisi_kesehatan']; ?></td>
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
