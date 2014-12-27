<!-- carousel -->
<?php 
		echo $this->Html->script('carousel/jquery.jcarousel.min.js'); 
		echo $this->Html->css(array('carousel/skins/tango/skin.css'));
?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.jcarousel-skin-tango').jcarousel();
});
</script>
<!-- Fin of carousel -->
