        <div class="section-body">
          <h2 class="section-title"> Daftar Pegawai PIP </h2>
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
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>NAMA</th>
                                            <th>DIREKTORAT</th>
                                            <th>JABATAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($pegawai as $a) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $i ?>
                                                </td>
                                                <td class="text-center"><?= $a['nip_pegawai']; ?></td>
                                                <td><?= $a['nama_pegawai']; ?></td>
                                                <td><?= $a['direktorat']; ?></td>
                                                <td><?= $a['nama_jabatan'] .' '. $a['divisi']; ?> </td>
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