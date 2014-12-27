<!-- Galeria -->
<script type="text/javascript">
 jQuery(function() {
		jQuery(".image_ProductsView").click(function() {
			var image = jQuery(this).attr("rel");
						jQuery('#image_ProductsView').hide();
						jQuery('#image_ProductsView').fadeIn('slow');
						jQuery('#image_ProductsView').html('<img src="' + image + '"/>');
			
			return false;
		});
});
</script>
<!-- Fin Galeria -->
