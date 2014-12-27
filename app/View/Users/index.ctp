
<?php 
	// debug($products);
	//debug($this->params);
	// debug($this->Paginator);

	//

?>

<!-- Todas las etiquetas de UsersController::index() heredan _UserIndex -->
<div class="bloque_UsersIndex">
	
	<div class="productos_UsersIndex"> 
	<!-- Productos -->
		<?php
		
			echo '<h2>'.$this->Html->link(ucfirst(strtolower($seller)).' Market', array('controller' => 'users', 'action' => 'index', $seller)).'</h2>';

		
		
			foreach ($products as $product):
			if($product['Image']){
			
			
					$arrayImagenes = array();
					foreach ($product['Image'] as $i => $arrayValues  ){
								if($arrayValues['size']=='270x270px'){
										$arrayImagenes[] = $arrayValues['name'];  
									}
					}
			
		?>
		<a href="<?php echo $this->Html->url('/'.$seller.'/'.Inflector::slug($product['Product']['title']).'/'.$product['Product']['id'], true); ?>" class="box">
			<span class="imagen_producto">
				<div style="display:none;">
					<?php
					// este logica aqui tiene su razon de ser.
					// el ranton esta sobre la imagen y un sctript muestra las imagenes adicionales.
					//debug($arrayImagenes);  		
					?>
				</div>
				<?php echo $this->Html->image('products/'.$arrayImagenes[0], array('alt' => 'Test'))?>
			</span>
			<span class="nombre_producto">
				<div class="nombre_producto_margen">
					<?php 
						echo  substr($product['Product']['title'], 0, 18); if((strlen($product['Product']['title']))>18){ echo" ...";} 
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
