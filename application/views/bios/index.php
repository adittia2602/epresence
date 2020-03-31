<div class="section-body">
          <h2 class="section-title">DATA TRANSAKSI BLU PIP</h2>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert ">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?> 
            <?= form_error('accesspublic', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                    <div class="card-header">
                        <!-- <h4>LIST TRANSAKSI</h4> -->
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="saldo-tab" data-toggle="tab" href="#saldo" role="tab" aria-controls="saldo" aria-selected="true">SALDO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="PENDAPATAN-tab" data-toggle="tab" href="#PENDAPATAN" role="tab" aria-controls="PENDAPATAN" aria-selected="false">PENDAPATAN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="BELANJA-tab" data-toggle="tab" href="#BELANJA" role="tab" aria-controls="BELANJA" aria-selected="false">BELANJA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="indikator-tab" data-toggle="tab" href="#indikator" role="tab" aria-controls="indikator" aria-selected="false">INDIKATOR</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="saldo" role="tabpanel" aria-labelledby="saldo-tab">
                                <h4 class="text-center mt-3">LIST TRANSAKSI:  <b>SALDO</b></h4>

                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end">
                                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddSaldo">Tambah Data Saldo</a>
                                    </div>
                                    <table class="table table-bordered multipleTable">
                                        <thead>
                                            <tr class='text-center'>
                                                <th scope="col">TGL TRANSAKSI</th>
                                                <th scope="col">KODE BANK</th>
                                                <th scope="col">NO REKENING</th>
                                                <th scope="col">KODE REKENING</th>
                                                <th scope="col">SALDO</th>
                                                <th scope="col">SYNC</th>
                                                <th scope="col">SYNC TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($saldo as $s) : ?>
                                                <tr>
                                                    <td><?= $s['TGLTRX']; ?></td>
                                                    <td><?= $s['KODEBANK']; ?></td>
                                                    <td><?= $s['NOREKENING']; ?></td>
                                                    <td><?= $s['KODEREKENING']; ?></td>
                                                    <td>Rp.  <?= number_format($s['SALDO'],0, '', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php if($s['SYNC'] == 0){ ?>
                                                            <a href="#" class=" badge badge-danger">ERROR</a>
                                                        <?php } else if($s['SYNC'] == 1){ ?>
                                                            <a href="#" class=" badge badge-warning">NOT SYNC</a>
                                                        <?php } else if($s['SYNC'] == 2){ ?>
                                                            <a href="#" class=" badge badge-success">SYNC</a>
                                                        <?php }  ?>
                                                    </td>
                                                    <td class="text-center"><?php $ts = $s['SYNC_TS']; if(is_null($ts)){ echo "-";} else {echo $ts;} ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="PENDAPATAN" role="tabpanel" aria-labelledby="PENDAPATAN-tab">
                                <h4 class="text-center mt-3">LIST TRANSAKSI:  <b>PENDAPATAN</b></h4>
    
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end">
                                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddPENDAPATAN">Tambah Data PENDAPATAN</a>
                                    </div>
                                    <table class="table table-bordered multipleTable">
                                        <thead>
                                            <tr class='text-center'>
                                                <th scope="col">TGL TRANSAKSI</th>
                                                <th scope="col">KODE AKUN</th>
                                                <th scope="col">JUMLAH</th>
                                                <th scope="col">SYNC</th>
                                                <th scope="col">SYNC TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pendapatan as $s) : ?>
                                                <tr>
                                                    <td><?= $s['TGLTRX']; ?></td>
                                                    <td><?= $s['KODEAKUN']; ?></td>
                                                    <td>Rp.  <?= number_format($s['JUMLAH'],0, '', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php if($s['SYNC'] == 0){ ?>
                                                            <a href="#" data-toggle="modal" data-target="#EditPENDAPATAN" class=" badge badge-danger">ERROR</a>
                                                        <?php } else if($s['SYNC'] == 1){ ?>
                                                            <a href="#" class=" badge badge-warning">NOT SYNC</a>
                                                        <?php } else if($s['SYNC'] == 2){ ?>
                                                            <a href="#" class=" badge badge-success">SYNC</a>
                                                        <?php }  ?>
                                                    </td>
                                                    <td class="text-center"><?php $ts = $s['SYNC_TS']; if(is_null($ts)){ echo "-";} else {echo $ts;} ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="BELANJA" role="tabpanel" aria-labelledby="BELANJA-tab">
                                <h4 class="text-center mt-3">LIST TRANSAKSI:  <b>BELANJA</b></h4>
    
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end">
                                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddBelanja">Tambah Data Belanja</a>
                                    </div>
                                    <table class="table table-bordered multipleTable">
                                        <thead>
                                            <tr class='text-center'>
                                                <th scope="col">TGL TRANSAKSI</th>
                                                <th scope="col">KODE AKUN</th>
                                                <th scope="col">JUMLAH</th>
                                                <th scope="col">SYNC</th>
                                                <th scope="col">SYNC TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($belanja as $s) : ?>
                                                <tr>
                                                    <td><?= $s['TGLTRX']; ?></td>
                                                    <td><?= $s['KODEAKUN']; ?></td>
                                                    <td>Rp.  <?= number_format($s['JUMLAH'],0, '', '.'); ?></td>
                                                    <td class="text-center">
                                                        <?php if($s['SYNC'] == 0){ ?>
                                                            <a href="#" data-toggle="modal" data-target="#EditBELANJA" class=" badge badge-danger">ERROR</a>
                                                        <?php } else if($s['SYNC'] == 1){ ?>
                                                            <a href="#" class=" badge badge-warning">NOT SYNC</a>
                                                        <?php } else if($s['SYNC'] == 2){ ?>
                                                            <a href="#" class=" badge badge-success">SYNC</a>
                                                        <?php }  ?>
                                                    </td>
                                                    <td class="text-center"><?php $ts = $s['SYNC_TS']; if(is_null($ts)){ echo "-";} else {echo $ts;} ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="indikator" role="tabpanel" aria-labelledby="indikator-tab">
                                <h4 class="text-center mt-3">LIST TRANSAKSI:  <b>INDIKATOR</b></h4>
                               
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end">
                                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddIndikator">Tambah Data Indikator</a>
                                    </div>
                                    <table class="table table-bordered multipleTable">
                                        <thead>
                                            <tr class='text-center'>
                                                <th scope="col">TAHUN</th>
                                                <th scope="col">BULAN</th>
                                                <th scope="col">TGL TRANSAKSI</th>
                                                <th scope="col">KODE INDIKATOR</th>
                                                <th scope="col">JUMLAH</th>
                                                <th scope="col">SYNC</th>
                                                <th scope="col">SYNC TS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <?php $i = 1 ?>
                                            <?php foreach ($menu as $m) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>
                                                    <td><?= $m['group']; ?></td>
                                                    <td><?= $m['menu']; ?></td>
                                                    <td><?= $m['urutan']; ?></td>
                                                    <td class="text-center">
                                                        <a href="" class=" badge badge-primary" data-toggle="modal" data-target="#editMenuModal<?=$m['id'];?>">Edit</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?> -->

                                                <tr class="text-center">
                                                    <td>2019</td>
                                                    <td>MEI</td>
                                                    <td>2019-05-18</td>
                                                    <td>01</td>
                                                    <td>Rp. 192.999.282.200</td>
                                                    <td >
                                                        <a href="#" class=" badge badge-warning">NOT SYNC</a>
                                                    </td>
                                                    <td> - </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>2019</td>
                                                    <td>SEPTEMBER</td>
                                                    <td>2019-09-17</td>
                                                    <td>01</td>
                                                    <td>Rp. 350.775.001.700</td>
                                                    <td >
                                                        <a href="#" class=" badge badge-success">SYNC</a>
                                                    </td>
                                                    <td>2019-10-17 08:12:11</td>
                                                </tr>
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </section>
      </div>


    <div class="modal fade" id="AddSaldo" tabindex="-1" role="dialog" aria-labelledby="AddSaldoTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddSaldoTitle">Tambah Data Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('bios/addSaldo'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="tgltransaksi">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="tgltransaksi" name="tgltransaksi">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodebank">KODE BANK</label>
                            <select name="kodebank" id="kodebank" class="form-control">
                                <option value="">Select Bank..</option>
                                <?php foreach ($kodebank as $m) : ?>
                                    <option value="<?= $m['KODEAKUN']; ?>"> <?= $m['KODEAKUN']; ?> - <?= $m['KETERANGAN']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="koderekening">KODE REKENING</label>
                            <select name="koderekening" id="koderekening" class="form-control">
                                <option value="">Select Kode Rekening..</option>
                                <option value="01"> Rekening pengelolaan kas BLU </option>
                                <option value="02"> Rekening operasional BLU </option>
                                <option value="03"> Rekening dana kelolaan  </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="norekening">NO REKENING</label>
                            <input type="text" class="form-control" id="norekening" name="norekening">
                        </div>

                        
                        <div class="form-group">
                            <label class="control-label" for="saldo">SALDO</label>
                            <input type="number" class="form-control" id="saldo" name="saldo">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddPENDAPATAN" tabindex="-1" role="dialog" aria-labelledby="AddPENDAPATANTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddPENDAPATANTitle">Tambah Data PENDAPATAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('bios/addPendapatan'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="tgltransaksi">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="tgltransaksi" name="tgltransaksi">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeakun">KODE AKUN</label>
                            <select name="kodeakun" id="kodeakun" class="form-control">
                                <option value="">Select Akun..</option>
                                <?php foreach ($kodeakunpdpt as $m) : ?>
                                    <option value="<?= $m['KODEAKUN']; ?>"> <?= $m['KODEAKUN']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="jumlah">JUMLAH</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddBelanja" tabindex="-1" role="dialog" aria-labelledby="AddBelanjaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddBelanjaTitle">Tambah Data Belanja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('bios/addBelanja'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="tgltransaksi">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="tgltransaksi" name="tgltransaksi">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeakun">KODE AKUN</label>
                            <select name="kodeakun" id="kodeakun" class="form-control">
                                <option value="">Select Akun..</option>
                                <?php foreach ($kodeakunblj as $m) : ?>
                                    <option value="<?= $m['KODEAKUN']; ?>"> <?= $m['KODEAKUN']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="jumlah">JUMLAH</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddIndikator" tabindex="-1" role="dialog" aria-labelledby="AddIndikatorTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddIndikatorTitle">Tambah Data Indikator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('menu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="group">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="group" name="group">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="menu">KODE BANK</label>
                            <input type="text" class="form-control" id="menu" name="menu">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="urutan">NO REKENING</label>
                            <input type="number" class="form-control" id="urutan" name="urutan">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="urutan">KODE REKENING</label>
                            <input type="number" class="form-control" id="urutan" name="urutan">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="urutan">SALDO</label>
                            <input type="number" class="form-control" id="urutan" name="urutan">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditPENDAPATAN" tabindex="-1" role="dialog" aria-labelledby="EditPENDAPATANTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditPENDAPATANTitle">Edit Data PENDAPATAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('bios/addPendapatan'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="tgltransaksi">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="tgltransaksi" name="tgltransaksi">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeakun">KODE AKUN</label>
                            <select name="kodeakun" id="kodeakun" class="form-control">
                                <option value="">Select Akun..</option>
                                <?php foreach ($kodeakunpdpt as $m) : ?>
                                    <option value="<?= $m['KODEAKUN']; ?>"> <?= $m['KODEAKUN']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="jumlah">JUMLAH</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    v<div class="modal fade" id="EditBELANJA" tabindex="-1" role="dialog" aria-labelledby="EditBELANJATitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditBELANJATitle">Edit Data BELANJA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('bios/addBELANJA'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="tgltransaksi">TGL TRANSAKSI</label>
                            <input type="date" class="form-control" id="tgltransaksi" name="tgltransaksi">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeakun">KODE AKUN</label>
                            <select name="kodeakun" id="kodeakun" class="form-control">
                                <option value="">Select Akun..</option>
                                <?php foreach ($kodeakunpdpt as $m) : ?>
                                    <option value="<?= $m['KODEAKUN']; ?>"> <?= $m['KODEAKUN']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="jumlah">JUMLAH</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>