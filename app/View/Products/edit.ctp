<?php 

				/* 
					segunda etapa
					echo '<h2>Caracteristicas</h2>';	
					dependiendo de la categoria se cargan las caracteristicas comunes.
					foreach($allFeatureName as $id =>$value ){
						echo $value.' '.$this->Form->checkbox('Feature.'.$id.'.feature_name_id',array('value' => $id,'hiddenField' => false));
					}
				*/

?>

			<!-- 	
					<h2>imagenes</h2>	
			
					<div style=" border:1px solid #CCC; padding: 10px; background: #DBDBDB">
									
						<div style="padding-left: 10px;">	
							<div class="admonition note">
								<p class="first admonition-title">Nota</p>
								<p class="last">Si el producto no tiene al menos una imagen, el sistema no mostrara la publicación a los clientes.</p>
							</div>	
						</div>	
					
					</div>	
		
					<br>
					

					<div id="add-image">
						<?php
							echo $this->Form->input('addStoreImage.1',array('label'=>'1) ','type'=>'file'));
							echo $this->Form->input('addStoreImage.2',array('label'=>'2) ','type'=>'file'));
							echo $this->Form->input('addStoreImage.3',array('label'=>'3) ','type'=>'file'));
						?>
					</div>	
					<input  type="button" id="add-input-image-button" value="Otra imagen" />			
			-->





<div class="contenedor-b"  style="padding: 10px;">
	<div class="b-menu"> 
		<?php echo $this->element('menu'); ?>
	</div>	
	<div class="b-sobre">
		<div class="preguntas"  id="preguntas" style=" overflow: hidden; ">
		
			<div id="debug"></div>
			
			<!-- start -->
			<?php echo $this->Form->create('Product',  array('url' => "/edit", 'type' => 'file')); ?>
			
				<div id="category-selector"  style="overflow: hidden;">
					

					
					<div style="overflow: hidden;">
						<div style="width: 478px; float: left;"><h2>Seleciona una categoria:</h2></div>
						<div style="width: 478px; float: right;">
							<input id="add-content" type="button" value="Confirmar y continuar" disabled="disabled"/>
							<?php echo $this->Form->hidden('Product.category_id'); ?>
						
						</div>
					</div>
					
								
					<div id="menu-container" class="class-all-menu-container" >
						<div id="path" style="overflow: hidden; height: 20px;">Seleccione una categoría que mejor se adapte a el artículo</div>
						
						<div id="menu-box"  style=" border: 1px solid #61D7FF; height: 265px; border-top-left-radius: 6px 6px; border-top-right-radius: 6px 6px;border-bottom-left-radius: 6px 6px;border-bottom-right-radius: 6px 6px;overflow-x: scroll;overflow-y: hidden;" >
							<div id="menu" style="overflow: hidden;">
								<?php 
									if($namespaces){
										echo  '<div class="ulMenu" id="default-options">';		
										foreach($namespaces as $k => $v){
											echo '<div class="liMenu" id="category-id-'.$v['Category']['id'].'"> '.$v['Category']['name'].'</div>';	
										}
										echo '</div>';
									}
								?>
							</div>		
						</div>
					</div>			
				
					<h2>opciones favoritas</h2>	
				</div>
				
				<!-- inter -->
				
				<div id="add-product" style="overflow: hidden; display: none;" > 
					
					
					<div style="overflow: hidden; padding-top: 10px;">
						
						<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Actualizar', array('id'=>'update','class' => 'g-button-red g-button','type'=>'button')); ?></div>
	
						<div style="overflow: hidden; float: left; padding-right: 5px;" >
							<div id="debugTime" style="padding-top: 6px; display:none;">La publicación se ha actulizado a las <span id="lastTimeSave"></span> (Hace <span id="minutesElapsed">1</span> minutos)</div>
						</div>							
					
					</div>
					
						
					<div style="overflow: hidden;padding-top: 10px;">  
						<input  type="button" id="edit-category" value="Editar Categoria" class="g-button"  style="margin: 0px; height: 29px; line-height: 29px;" />	
						<span id="path2"></span>.
					</div>
					
					<div style="display:none"><?php echo $this->Form->hidden('Product.id'); ?></div>
															
					<div style="padding-top: 10px;">
						<?php echo $this->Form->input('Product.title',array('label'=>'Titulo:','class'=>'input-basic')); ?>
						<span style="opacity: 0.70;">Al escribir el titulo por favor sigue esta conveción: Marca - Nombre - Característica relevante - Numero de parte o Modelo.</span>	
					</div>	
					
					<div style="padding-top: 10px;">	
						<?php echo $this->Form->input('Product.body',array('label'=>'Descipción:','class'=>'input-basic','type'=>'textarea')); ?> 
					</div>
							
					<div style="overflow: hidden; padding-top: 10px;" >
						<div style="overflow: hidden; float: left; padding-right: 15px;"> 
							<div style="overflow: hidden; float: left; width: 100px;"> 
								<?php echo $this->Form->input('Product.price',array('label'=>'Precio:','class'=>'input-basic','size'=>9,'maxlength'=>9)); ?> 
							</div>
							<div style="overflow: hidden; float: left; padding-top: 25px; padding-left: 5px;"> 
								Bs. F.
							</div>
						</div>
						<div style="  overflow: hidden; float: left; padding-right: 5px;"> 
							<div style="overflow: hidden; float: left; width: 100px;">
								<?php echo $this->Form->input('Product.quantity',array('label'=>'Cantidad:','class'=>'input-basic','type'=>'text','size'=>3,'maxlength'=>3)); ?> 
							</div>
							<div style="overflow: hidden; float: left; padding-top: 25px; padding-left: 5px;">
								Unid.
							</div>
						</div>
					</div>							
			
									<div style="padding-left: 10px;">	
										<div class="admonition note">
											<p class="first admonition-title">Nota</p>
											<p class="last">
									
												<span style="color: #e32; display:inline;">*</span> Campos con un asterico son requeridos para publicar. Pero no para guardar un borrador.
												 
												
											</p>
										</div>	
									</div>			
				
				</div>

			<?php echo $this->Form->end(); ?>				
			<!-- end -->
		
		
		
		
		</div>		
	</div>
</div>





