        <div class="section-body">
          <h2 class="section-title"> Laporan Kegiatan WFH - Divisi <?=$pegawai['divisi'];?></h2>
          <p class="section-lead"> </p>
            <?= form_error('penyaluran/wilayah', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Diisi sesuai dengan Tugas Fungsi atau dapat diisi dengan kegiatan yang dilakukan untuk meningkatkan performance <br/>
                            (ex : broswing/baca artikel mengenai ekonomi/UMKM, dll)</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-8">
                                <form method="POST" action="<?php echo base_url('wfh/input'); ?>">
                                    <div class="row mb-5">
                                        <div class="col-3 text-left"> Nama </div>  <div class="col-8 text-left">: <b><?= $pegawai['nama_pegawai']?></b> </div>
                                        <div class="col-3 text-left"> NIP </div>  <div class="col-8 text-left">: <b><?= $pegawai['nip_pegawai']?></b> </div>
                                        <div class="col-3 text-left"> Jabatan </div>  <div class="col-8 text-left">: <?= $pegawai['nama_jabatan']?> - Divisi <?= $pegawai['divisi']?> </div>
                                        <div class="col-3 text-left"> Waktu </div>  <div class="col-8 text-left">: <?= date("Y-m-d")?> </div>
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label class="control-label" for="kondisi">Kondisi Kesehatan : </label>
                                        <select name="kondisi" id="kondisi" class="form-control form-control-lg">
                                            <option value="sehat" selected> Sehat </option>
                                            <option value="kurang sehat"> Kurang Sehat </option>
                                            <option value="tidak sehat"> Tidak Sehat </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="uraiankondisi">Uraian Kondisi Kesehatan :  </label>
                                        <input id="uraiankondisi" type="text" class="form-control" name="uraiankondisi">
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Judul Kegiatan : </label>
                                        <input id="judul" type="text" class="form-control" name="judul">
                                    </div>

                                    <div class="form-group">
                                        <label for="uraiankegiatan">Uraian Kegiatan :  </label>
                                        <textarea class="form-control" id="uraiankegiatan" name="uraiankegiatan" rows="30" style="height: 200px;"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Submit Laporan WFH
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <?php if (validation_errors()) : ?>
                                    <div class="alert alert-danger" role="alert ">
                                        <?= validation_errors(); ?>
                                    </div>
                                <?php endif; ?> 
                                <?= form_error('wfh', ''); ?> <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>