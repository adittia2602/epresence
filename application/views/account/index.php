<div class="section-body">
          <h2 class="section-title">Your <?= $title ?> Info </h2>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert ">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?> 
            <?= form_error('accesspublic', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
              <div class="col-12 col-sm-12 <?= $col ?>">
                <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                      <img alt="image" src="<?= base_url("assets/")?>/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <!-- <a href="<?= base_url('account/edit');?>" class="btn btn-primary mt-3" >Edit User</a> -->
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#"><?= $user['username']?></a>
                      </div>
                      <div class="author-box-job"> as  <?= $role['role']?></div>
                      <div class="author-box-description row">
                        <div class="col-3 col-sm-12 col-lg-3">
                          Nama
                        </div> :
                        <div class="col-8 col-sm-12 col-lg-8">
                          <?= $pegawai['nama_pegawai']?>
                        </div>
                        <div class="col-3 col-sm-12 col-lg-3">
                          NIP 
                        </div> :
                        <div class="col-8 col-sm-12 col-lg-8">
                          <?= $pegawai['nip_pegawai']?>
                        </div>
                        <div class="col-3 col-sm-12 col-lg-3">
                          Direktorat 
                        </div> :
                        <div class="col-8 col-sm-12 col-lg-8">
                          <?= $pegawai['direktorat']?>
                        </div> 
                        <div class="col-3 col-sm-12 col-lg-3">
                          Divisi 
                        </div> :
                        <div class="col-8 col-sm-12 col-lg-8">
                          <?= $pegawai['divisi']?>
                        </div> 
                             
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-lg-7 edit-card <?= $editing ?>">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Account</h4>
                  </div>
                  <form class = "" action="<?php echo base_url('account/edit'); ?>" method="POST">
                    <div class="card-body">
                      <div class="form-group">
                          <label class="control-label">Username</label>
                          <input type="text" disabled class="form-control" value="<?= $user['name']?>">
                      </div>

                      <div class="form-group">
                          <label class="control-label" for="">Role</label>
                          <input type="text" disabled class="form-control" value="<?= $role['role']?>">
                      </div>

                      <div class="form-group">
                          <label class="control-label">Nama Lengkap</label>
                          <input type="text" class="form-control" name="fullname" value="<?= $user['fullname']?>">
                      </div>

                      <div class="form-group">
                          <label class="control-label" for="email">Email</label>
                          <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']?>">
                      </div>

                      <div class="form-group">
                          <label class="control-label" for="password1">Password</label>
                          <div class="row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                              <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="">
                              <?php echo form_error('password1', '<small class ="text-danger pl-3">', ' </small>'); ?>
                          </div>
                          <div class="col-sm-6">
                              <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="">
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <a class="btn btn-secondary" href="<?= base_url('account');?>">Cancel</a>
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              </div>
        </section>
      </div>