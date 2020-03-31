<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2019 <div class="bullet"></div> TIM SIT - PIP
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url('assets/'); ?>js/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/popper.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/moment.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/page/modules-datatables.js"></script>

  <script src="<?php echo base_url('assets/'); ?>vendor/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>vendor/jqvmap/jquery.vmap.indonesia.js"></script>

  <script src="<?php echo base_url('assets/'); ?>vendor/select2/dist/js/select2.full.min.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo base_url('assets/'); ?>js/scripts.js"></script>
  <script >
    $('.form-check-input').on('click', function() {
      const menuId = $(this).data('menu');
      const submenuId = $(this).data('submenu');
      const roleId = $(this).data('role');

      $.ajax({
          url: "<?= base_url('users/changeaccess'); ?>",
          type: 'post',
          data: {
              menuId: menuId,
              submenuId: submenuId,
              roleId: roleId,
          },
          success: function() {
              document.location.href = "<?= base_url('users/roleaccess/'); ?>" + roleId;
          }
      });
    });
  </script>

  <!-- Page Specific JS File -->
</body>
</html>