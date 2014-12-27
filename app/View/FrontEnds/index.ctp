<div class="">	
	
	<!-- b) menu, sobre marker of london -->
<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
	<?php 
		foreach($allCategories as $fatherValue){
			echo  '<li><a href="'.$fatherValue['Category']['name'].'">'.$fatherValue['Category']['name'].'</a></li>';
		}
	?>
	</div>
	<div class="b-sobre">
		<a href="<?php echo $this->Html->url('/product/'.strtolower('EVGA_X79_Classified_Intel_Socket_2011_Quad_Channel_DDR3_32GB_of_DDR3_2133MHz_151_SE_E779_KR').'/21', true); ?>" >
			<?php echo $this->Html->image('/img/idea.jpg', array('alt' => 'romel gomez'))?>
		</a>
	</div>
</div>	
	
	
	<!-- c) destacados -->
	<div class="contenedor-c">

		<div class="productos_UsersIndex">
			<h1> Featured</h1>
		<!-- Productos -->
		<?php
		
			foreach ($products as $product):
			
			if($product['Image']){
			
				$arrayImagenes = array();
				foreach ($product['Image'] as $i => $arrayValues  ){
					if($arrayValues['deleted']=='0'){
						$arrayImagenes[] = $arrayValues['name'];  
					}
				}
				if(!$arrayImagenes){
					$arrayImagenes[0] = 'noImage.jpg';
				}
			
		?>
		<a href="<?php echo $this->Html->url('/product/'.strtolower(Inflector::slug($product['Product']['title'])).'/'.$product['Product']['id'], true); ?>" class="box">
			<span class="imagen_producto">
				<div style="display:none;">
				</div>
				<?php echo $this->Html->image('/imageProduct/270/270/2/'.$arrayImagenes[0], array('alt' => 'Test'))?>
			</span>
			<span class="nombre_producto">
				<div class="nombre_producto_margen">
					<?php 
						echo  substr($product['Product']['title'], 0, 34); if((strlen($product['Product']['title']))>33){ echo" ...";} 
					?>
				</div>
			</span>
			<span class="precio_y_calificacion">
				<div class="precio_y_calificacion_margen">
					Precio :<?php echo $product['Product']['price']; ?> BsF.
				</div>	
			</span>
		</a>
		<?php } endforeach; ?>
		<!-- Fin Productos -->
		</div>

		
	</div>	

</div>
