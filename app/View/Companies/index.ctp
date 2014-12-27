
<?php
	//debug($products);
	//debug($this->params);
	// debug($this->Paginator);
?>

<!-- Todas las etiquetas de UsersController::index() heredan _UserIndex -->
<div class="bloque_UsersIndex">
	
	<div class="productos_UsersIndex"> 
	<!-- Productos -->
		<?php
		
			echo '<h2>'.$companyData['Company']['name'].' '.$companyData['Company']['type'].' - Inventario'.' ';
			echo ' <span style=" float: right; ">'.'<a href="/contact_the_seller/'.strtolower(Inflector::slug($companyData['Company']['name'])).'/'.$companyData['Company']['id'].'" >Contacta al vendedor</a>'.'</span></h2>';
		
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
					<?php
					// este logica aqui tiene su razon de ser.
					// el rantón esta sobre la imagen y un sctript muestra las imagenes adicionales.
					//debug($arrayImagenes);  		
					?>
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
