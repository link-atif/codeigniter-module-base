<div class="footer-links margin-top-40">
			<div class="row no-gutters bg-blue">
				<div class="col-xs-6"></div><!--.col-->
				<div class="col-xs-6">
					<a href="cards-image.html">
						<span class="state">Cards</span>
						<span>Image Cards</span>
						<span class="icon"><i class="ion-android-arrow-forward"></i></span>
					</a>
				</div><!--.col-->
			</div><!--.row-->
</div><!--.footer-links-->


<svg version="1.1" xmlns='http://www.w3.org/2000/svg'>
		<filter id='blur'>
			<feGaussianBlur stdDeviation='7' />
		</filter>
	</svg>

<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="<?php echo base_url();?>themes/acpe/globals/js/global-vendors.js"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="<?php echo base_url();?>themes/acpe/globals/scripts/user-pages.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->
<!-- PLEASURE -->
	<script src="<?php echo base_url();?>themes/acpe/globals/js/pleasure.js"></script>
	<!-- ADMIN 1 -->
	<script src="<?php echo base_url();?>themes/acpe/admin/js/layout.js"></script>

	
	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		UserPages.login();
	});
	</script>
	<!-- END INITIALIZATION-->



</body>
</html>
