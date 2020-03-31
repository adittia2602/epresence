      <div class="section-body">
          <h2 class="section-title"> <?= $title ?> RUMi App </h2>
          <p class="section-lead"> </p>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert ">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?> 
            <?= form_error('users', ''); ?> <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hak Akses user: <b><i><?= $role['role'];?></b></i></h4>
                        </div>
                        <div class="card-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Group Menu</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Submenu</th>
                                            <th scope="col">Access</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($menu as $m) : ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $m['group']; ?></td>
                                                <td><?= $m['menu']; ?></td>
                                                <td><?= $m['title']; ?></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['menu_id'],$m['submenu_id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['menu_id']; ?>" data-submenu="<?= $m['submenu_id']; ?>">
                                                    </div>
                                                </td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <a href="<?= base_url('users/role/')?>" class="btn btn-primary mb-3">OK</a>
                        </div>
                    </div>
                </div>

                
            </div>
        </section>
      </div>

      <div class="modal fade" id="NewRoleModal" tabindex="-1" role="dialog" aria-labelledby="NewRoleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="NewRoleModalTitle">Input Data Role Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('users/role'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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
