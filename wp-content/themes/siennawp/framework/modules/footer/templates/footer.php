<?php
/**
 * Footer template part
 */

sienna_mikado_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<?php if(!isset($_REQUEST["ajax_req"]) || $_REQUEST["ajax_req"] != 'yes') { ?>
	<footer <?php sienna_mikado_class_attribute($footer_classes); ?>>
		<div class="mkdf-footer-inner clearfix">            
			<?php
			/*
			if($display_footer_top) {
				sienna_mikado_get_footer_top();
			}
			
			if($display_footer_bottom) {
				sienna_mikado_get_footer_bottom();
			}*/
			?>

			<div class="footer-content parent-position" >
				<div class="footer-content-child child-position">
					<div class="info-footer">
						981 S. Western Ave., Suite 100, Los Angeles, CA 90006 | 
						<span class="visible-xs"><br/></span>
						 Tel: 323-732-0700 | Fax: 323-732-7009 | E-mail: info@kafla.org
					</div>
					<div class="donate-footer">

						<div class="col-xs-5 col-md-5">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								 <input type="hidden" name="cmd" value="_s-xclick">
			                     <input type="hidden" name="hosted_button_id" value="625DYMQKHTEW4">
			                     <input class="btn-donate-home-footer" type="image" src="/wp-content/themes/siennawp/assets/css/images/btn-donate-home-top-2.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" >
		                    </form>  					
						</div>							
						<div class="col-xs-1 col-md-1">
							<div id="decor-footer"></div>
						</div>
						<div class="col-xs-1 col-md-1">
							<div id="follow-us-text-footer">FOLLOW US</div>
						</div>
						<div class="col-xs-1 col-md-1">
							<a href="https://www.facebook.com/kafla1962/" target="_blank"><div id="ic-fb-2"></div></a>
						</div>
						<div class="col-xs-1 col-md-1">
							<a href="https://twitter.com/kafla1962" target="_blank"><div id="ic-tw-2"></div></a>
						</div>
						<div class="col-xs-1 col-md-1">
							<a href="https://www.instagram.com/kafla1962/" target="_blank"><div id="ic-in-2"></div></a>
						</div>
						<div class="col-xs-1 col-md-1">
							<a href="https://www.youtube.com/channel/UC0eC11Hw5AYxaZkfcwPdmVQ" target="_blank"><div id="ic-you-2"></div></a>
						</div>
						<div class="clearfix"></div>
					</div>
					
				</div>
				<div id="copyright-home"><div>2019 Korean American Federation of Los Angeles. All right reserved.</div></div>
			</div>
		</div>
	</footer>
<?php } ?>

</div> <!-- close div.mkdf-wrapper-inner  -->
</div> <!-- close div.mkdf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>