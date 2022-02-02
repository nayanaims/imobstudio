		
 </div> <!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
		
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

		 <?php if(!empty($js)) {
			echo include_js($js);
		 } ?>
		
    </body>
 </html>
 
<body>   