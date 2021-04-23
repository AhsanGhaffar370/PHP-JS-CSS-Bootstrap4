<?php
/**
 * The template for displaying the footer.
 *
 * @package OceanWP WordPress theme
 */

?>

	</main><!-- #main -->

	<?php do_action( 'ocean_after_main' ); ?>

	<?php do_action( 'ocean_before_footer' ); ?>

	<?php
	// Elementor `footer` location.
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		?>

		<?php do_action( 'ocean_footer' ); ?>

	<?php } ?>

	<?php do_action( 'ocean_after_footer' ); ?>

</div><!-- #wrap -->

<?php do_action( 'ocean_after_wrap' ); ?>

</div><!-- #outer-wrap -->

<?php do_action( 'ocean_after_outer_wrap' ); ?>

<?php
// If is not sticky footer.
if ( ! class_exists( 'Ocean_Sticky_Footer' ) ) {
	get_template_part( 'partials/scroll-top' );
}
?>

<?php
// Search overlay style.
if ( 'overlay' === oceanwp_menu_search_style() ) {
	get_template_part( 'partials/header/search-overlay' );
}
?>

<?php
// If sidebar mobile menu style.
if ( 'sidebar' === oceanwp_mobile_menu_style() ) {

	// Mobile panel close button.
	if ( get_theme_mod( 'ocean_mobile_menu_close_btn', true ) ) {
		get_template_part( 'partials/mobile/mobile-sidr-close' );
	}
	?>

	<?php
	// Mobile Menu (if defined).
	get_template_part( 'partials/mobile/mobile-nav' );
	?>

	<?php
	// Mobile search form.
	if ( get_theme_mod( 'ocean_mobile_menu_search', true ) ) {
		get_template_part( 'partials/mobile/mobile-search' );
	}
}
?>

<?php
// If full screen mobile menu style.
if ( 'fullscreen' === oceanwp_mobile_menu_style() ) {
	get_template_part( 'partials/mobile/mobile-fullscreen' );
}
?>

<?php wp_footer(); ?>





<script>

(function($) {
	
	$(document).ready(function() {
		
		
		
		$("#dialog").dialog({
			draggable: false,
			resizable: false,
			closeOnEscape: false,
			autoOpen: false,
			width: '50%',
			modal: true
		});
		
		$(".ui-dialog-titlebar").hide();
		
		$("#close_dialog").click(function(){
			$("#dialog").dialog("close");
		});
		
		$("input[name='waxing[]']").change(function(){
// 			$("#dialog").dialog("open");
            update_price();
		});
		$("input[name='threading[]']").change(function(){
            update_price();
		});
		$("input[name='eyelashes[]']").change(function(){
            update_price();
		});
		$("input[name='nails[]']").change(function(){
            update_price();
		});
		$("input[name='massage[]']").change(function(){
            update_price();
		});
		$("input[name='dissolving[]']").change(function(){
            update_price();
		});
		$("input[name='vitamin[]']").change(function(){
            update_price();
		});
		$("input[name='filler[]']").change(function(){
            update_price();
		});
		
		
		function update_price(){
			var waxing= $("input[name='waxing[]']:checked").map(function(){return $(this).val();}).get();
            var threading= $("input[name='threading[]']:checked").map(function(){return $(this).val();}).get();
            var eyelashes= $("input[name='eyelashes[]']:checked").map(function(){return $(this).val();}).get();
            var nails= $("input[name='nails[]']:checked").map(function(){return $(this).val();}).get();
            var massage= $("input[name='massage[]']:checked").map(function(){return $(this).val();}).get();
            var dissolving= $("input[name='dissolving[]']:checked").map(function(){return $(this).val();}).get();
            var vitamin= $("input[name='vitamin[]']:checked").map(function(){return $(this).val();}).get();
            var filler= $("input[name='filler[]']:checked").map(function(){return $(this).val();}).get();
			
			let ser_price =0;
			let total_price=0;
			
			for(var i=0; i<waxing.length; i++){
				ser_price = waxing[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<threading.length; i++){
				ser_price = threading[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<eyelashes.length; i++){
				ser_price = eyelashes[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<nails.length; i++){
				ser_price = nails[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<massage.length; i++){
				ser_price = massage[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<dissolving.length; i++){
				ser_price = dissolving[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<vitamin.length; i++){
				ser_price = vitamin[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			for(var i=0; i<filler.length; i++){
				ser_price = filler[i].split("£");
				total_price+=parseFloat(ser_price[1]);
			}
			
            $("#total1").val(total_price);
			$("#t_price").html("£ "+total_price.toString());
		}
		
		
		
// 		function val_weight() {
// 			var flag=true;
// 			var weight= $("input[name='weight[]']");
// 			var weight1= weight.map(function(){return $(this);}).get();
// 			var weight_arr= weight.map(function(){return $(this).val();}).get();

// 			for(var i=0; i<weight_arr.length;i++)
// 			{
// 				if(weight_arr[i].length==0){
// 					// alert("weight is empty", i);
// 					weight1[i].css({"border": "2px solid red"});
// 					// weight1[i].focus();
// 					flag= false;
// 				}
// 				else{
// 					weight1[i].css({"border": "none"});
// 				}
// 			}
// 			if(flag)
// 				return true;
// 			else
// 				return false;
// 		} //end of function
		
		
	});
	
	
	
})(jQuery);
</script>






</body>
</html>
