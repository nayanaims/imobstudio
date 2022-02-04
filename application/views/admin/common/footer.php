		
 </div> <!-- /Main Wrapper -->

		<!-- Bootstrap Core JS -->
        <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Chart JS -->
		<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
		<script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
		<script src="<?= base_url() ?>assets/js/chart.js"></script>
		
		<!-- Custom JS -->
		<script src="<?= base_url() ?>assets/js/app.js"></script>

		<!-- Datatable JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>

		 <?php if(!empty($js)) {
			echo include_js($js);
		 } ?>
		
    </body>
 </html>
 
<body>   