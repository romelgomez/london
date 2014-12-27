
<?php 
	// debug($products);
	//debug($this->params);
	// debug($this->Paginator);
?>

<!-- <div id="_UserIndex"> -->

<center>
<div id="paginacion_bloque">
	<div class="caja_general"> 
		
		<?php if($this->params['paging']['Product']['prevPage']){ ?>
				
				<div class="caja_isquierda">
					<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array('class'=>'flecha', 'id'=>'prev'), null, array());?>
				</div>
			<?php } else { ?>
		
				<div class="caja_isquierda">
					<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array(), null, array('class'=>'flecha_pagina_1', 'id'=>'prev'));?>
				</div>
		<?php } ?>
		
		
		
				
			<div class="caja_centrar">
				<div class="paginas">
				
					<?php echo $this->Paginator->numbers();?>
				
				</div>
			</div>
				 
		<?php if($this->params['paging']['Product']['nextPage']){ ?>
			
			<div class="caja_derecha">
				<?php 
						echo $this->Paginator->next(__('Proximo', true) . ' >>', array('class' => 'flecha','id'=>'next'), null, array());  
						// 1 array es para el link a, 2 arrar es para la etiqueta <span>
				?>
				

			
			</div>				 
		
		<?php } else { ?>		
					 
			<div class="caja_derecha">
				<?php echo $this->Paginator->next(__('Proximo', true) . ' >>', array(), null, array('class' => 'flecha_pagina_1','id'=>'next'));?>
			</div>
			
		<?php } ?>	
		

	</div>
</div>



<!-- Productos -->

<?php

	foreach ($products as $product):
?>


			
			
			<a href="<?php echo $this->Html->url('/'.$seller.'/'.Inflector::slug($product['Product']['title']).'/'.$product['Product']['id'], true); ?>" class="box">
				<span class="imagen_producto">
				
					<?php echo $this->Html->image('products/test.jpg', array('alt' => 'Test'))?>
				
				</span>
					<span class="nombre_producto">
						<?php 
							echo  substr($product['Product']['title'], 0, 18); if((strlen($product['Product']['title']))>18){ echo"...";} 
						?>
					</span>
						<span class="detalles_generales">
							<span class="opciones"><b>ID : </b> RERSDSD</span>
							<span class="opciones"><b>Precio : </b><?php echo $product['Product']['price']; ?> BsF</span>
							<span class="opciones"><b>Fabricante : </b>horrorwood</span>
							<span class="opciones"><b>Breve wiki: </b>none :(</span>
					</span>
			</a>
			
<?php endforeach; ?>

<!-- Fin Productos -->



<div id="paginacion_bloque">
	<div class="caja_general"> 
		
		<?php if($this->params['paging']['Product']['prevPage']){ ?>
				
				<div class="caja_isquierda">
					<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array('class'=>'flecha', 'id'=>'prev'), null, array());?>
				</div>
			<?php } else { ?>
		
				<div class="caja_isquierda">
					<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array(), null, array('class'=>'flecha_pagina_1', 'id'=>'prev'));?>
				</div>
		<?php } ?>
		
		
		
				
			<div class="caja_centrar">
				<div class="paginas">
				
					<?php echo $this->Paginator->numbers();?>
				
				</div>
			</div>
				 
		<?php if($this->params['paging']['Product']['nextPage']){ ?>
			
			<div class="caja_derecha">
				<?php 
						echo $this->Paginator->next(__('Proximo', true) . ' >>', array('class' => 'flecha','id'=>'next'), null, array());  
						// 1 array es para el link a, 2 arrar es para la etiqueta <span>
				?>
				

			
			</div>				 
		
		<?php } else { ?>		
					 
			<div class="caja_derecha">
				<?php echo $this->Paginator->next(__('Proximo', true) . ' >>', array(), null, array('class' => 'flecha_pagina_1','id'=>'next'));?>
			</div>
			
		<?php } ?>	
		

	</div>
</div>


</center>








