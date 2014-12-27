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

<?php 
	echo $this->Html->script('forms',false);
	echo $this->Html->script('categories',false);
	echo $this->Html->script('php.default.min',false);
	echo $this->Html->css('google_css',false);
	
	// lightbox
	echo $this->Html->css('lightbox',false);
	echo $this->Html->script('lightbox',false);
	// fileUpload
	echo $this->Html->script('fileUpload',false);
	// add product
	echo $this->Html->script('add.product',false);
	// carrusel
	echo $this->Html->css('carousel',false);
	echo $this->Html->script('carousel',false);
?>

<div class="contenedor-b"  style="padding: 10px;">
	
		<div class="preguntas"  id="preguntas" style=" overflow: hidden; ">
		
			<div id="debug"></div>
			
			<!-- start -->
			<?php echo $this->Form->create('Product',  array('url' => "/newProduct", 'type' => 'file')); ?>
			
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
				<div id="add-product" style="overflow: hidden; display: none;">
					
					<div style="overflow: hidden; padding-top: 10px;">
						
						<?php
						$urlAction = strstr($this->request->url, '/', true); // Desde PHP 5.3.0
						
						// edit
						if($urlAction =='edit'){
							
							$status = $this->request->data['Product']['status']; // status de la publicación
							
						?>
							<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Actualizar',		array('id'=>'update','class' => 'red g-button','type'=>'button')); ?></div>
							
							<?php if($status){ 	// esta publicado,	por lo tanto el elemento activate_container debe esta oculto.  ?>
								<div id="pause_container"		style="overflow: hidden; float: left; padding-right: 5px;" >
									<?php echo $this->Form->button('Pausar',	array('id'=>'pause','class' => 'g-button','type'=>'button')); ?>
								</div>
								<div id="activate_container"	style="display:none; overflow: hidden; float: left; padding-right: 5px;" >
									<?php echo $this->Form->button('Activar',	array('id'=>'activate','class' => 'g-button','type'=>'button')); ?>
								</div>
							<?php }else{ 		// esta pausado,	por lo tanto el elemento pause_container debe esta oculto. ?>
								<div id="pause_container"		style=" display:none; overflow: hidden; float: left; padding-right: 5px;" >
									<?php echo $this->Form->button('Pausar',	array('id'=>'pause','class' => 'g-button','type'=>'button')); ?>
								</div>
								<div id="activate_container"	style="overflow: hidden; float: left; padding-right: 5px;" >
									<?php echo $this->Form->button('Activar',	array('id'=>'activate','class' => 'g-button','type'=>'button')); ?>
								</div>
							<?php } ?>
							
							<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Borrar',			array('id'=>'delete','class' => 'g-button','type'=>'button')); ?></div>
		
							<div style="overflow: hidden; float: left; padding-right: 5px;" >
								<div id="debugTime" style="padding-top: 6px; display:none;">La publicación se ha actulizado a las <span id="lastTimeSave"></span> (Hace <span id="minutesElapsed">1</span> minutos)</div>
							</div>
						
						<?php }
						// newProduct, editDraft  
						if($urlAction =='edit_draft' || $urlAction == false){
						?>	
							<!-- newProduct, editDraft -->
							<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Publicar',			array('id'=>'publish','class' => 'red g-button','type'=>'button')); ?></div>	
							<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Guardar Ahora',	array('id'=>'save-now','class' => 'g-button','type'=>'button')); ?></div>	
							<div style="overflow: hidden; float: left; padding-right: 5px;" ><?php echo $this->Form->button('Descartar',		array('id'=>'discard','class' => 'g-button','type'=>'button')); ?></div>
							<div style="overflow: hidden; float: left; padding-right: 5px;" >
								<div id="debugTime" style="padding-top: 6px; display:none;">El borrador se ha guardado a las <span id="lastTimeSave"></span> (Hace <span id="minutesElapsed">1</span> minutos)</div>
							</div>
							<!-- edit -->

						<?php }	?>
													
					</div>
					
						
					<div style="overflow: hidden;padding-top: 10px;">  
						<button id="edit-category" style="margin: 0px; height: 29px;" class="g-button" type="button" >Editar Categoria</button>
						<span id="path2"></span>.
					</div>
					
					<div style="display:none"><?php echo $this->Form->hidden('Product.id'); ?></div>
															
					<div style="padding-top: 20px; overflow: hidden;">
						<?php echo $this->Form->input('Product.title',array('label'=>'Titulo:','class'=>'input-basic')); ?>
						<span style="opacity: 0.70;">Al escribir el titulo por favor sigue esta conveción: Marca - Nombre - Característica relevante - Numero de parte o Modelo.</span>	
					</div>
				
					<div style="padding-top: 10px; overflow: hidden;">	
						<?php echo $this->Form->input('Product.body',array('label'=>'Descipción:','class'=>'input-basic input-body','type'=>'textarea')); ?> 
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
			
					<div style="overflow: hidden; padding-top: 10px;" >
						<div style="overflow: hidden; padding-bottom: 7px;" class="required" ><span>Imagenes:</span> <a id="continue-upload" style="display:none" href="#" class="lightbox-start-a" >añadir mas</a> </div>
						<div id="carousel" style="overflow: hidden;">
							
							<style type="text/css">
							
							#start-upload{
								border: 1px solid gray;
								background-color: white;
							}
							
							</style>
							
							<div id="start-upload" class="lightbox-start-a" style=" cursor: pointer; height: 212px;  overflow: hidden; box-shadow:rgba(0, 0, 0, .2) 0 4px 16px;  -webkit-box-shadow:rgba(0, 0, 0, .2) 0 4px 16px;  -moz-box-shadow:rgba(0,0,0,.2) 0 4px 16px; -moz-border-radius: 2px; border-radius: 2px;">
								<div style="overflow: hidden; padding-top: 25px;"><center><img src="/img/sube_imagenes.png"></center></div>
							</div>
							
							
							<!-- Carrusel  -->
							<div id="mycarousel" class="ui-carousel-horizontal" style="display:none;">
								<div class="ui-carousel-prev ui-state-disabled"><a href="#" onclick="return false">&lt;</a></div>
									<div class="ui-carousel-container">
										<ul>										

							<?php 
								if(isset($this->request->data)){
									$draftData = $this->request->data;
									if(isset($draftData['Image'])){
										foreach($draftData['Image'] as $imgKey=>$imgData){
											if($imgData['deleted'] == 0){
								?>
												<li>
													<div class="thumbnail2" style="overflow: hidden; background: whitesmoke; border: 1px solid gray; width: 200px; height: 200px; float: left; margin: 5px; box-shadow: rgba(0, 0, 0, .2) 0 4px 16px;       -webkit-box-shadow:rgba(0, 0, 0, .2) 0 4px 16px;       -moz-box-shadow:rgba(0,0,0,.2) 0 4px 16px;">
														<div style="overflow: hidden; width: 200px; height: 200px; z-index: 0; position: relative;">
															<center>
																<img src="/imageProduct/200/200/2/<?php echo $imgData['name']; ?>" title="santomercado.com" />
															</center>
														</div>
														<div id="image-id-<?php echo $imgData['id']; ?>" class="delete-this-image2" style="overflow: hidden; z-index: 1; margin-top:-200px; position: relative; float: right; padding-right: 2px; padding-top: 2px; width: 24px; height: 24px; cursor: pointer;">
															<img style="width: 24px;" src="/img/x2.png">
														</div>
													</div>
												</li>
								<?php 
											}
										}
									}
								}
							?>

										</ul>
									</div>
								<div  class="ui-carousel-next"><a href="#" onclick="return false">&gt;</a></div>
							</div>
							

						
						
						</div>
					</div>
			
					<div style="padding-left: 10px; overflow: hidden;">	
						<div class="admonition note"  style="margin: 20px 0px 0px;">
							<p class="first admonition-title">Notas: </p>
							<p class="last">
								 <span style="color: #e32; display:inline;">*</span> Campos con un asterico son requeridos para publicar. Pero no para guardar un borrador. <br>
								 Las imagenes son de caracter obligatorio. De no tener al menos una imagen, el sistema no mostrara la publicación a los clientes.
 							</p>
						</div>	
					</div>			
						
<!-- ################################################################################## start 	images  ############################################################################ -->
<!-- lightbox start -->
		<div id="lightbox-container-a" style="overflow: hidden;">
			<div id="lightbox-white-a" class="white_content"  style="display:none;">
				<!-- lightbox content start  -->
	
				<div style="overflow: hidden;">
					<div style="overflow: hidden; border-bottom: 1px solid #DCDCDC; padding: 10px;">
						<div style="overflow: hidden; float: left;"  ><span>Carga imagenes del producto o servicio</span></div>
						<div style="overflow: hidden; float: right;" ><a href="#" class="lightbox-end-a" ><img src="/img/x2.png" title="Cancelar" style="width: 24px;"></a></div>
					</div>
					<div style="overflow: hidden; padding: 10px;">
						<!-- #4c8efa  azul -->
						<div id="drop-files" class="drop-element" style="overflow: auto;padding: 10px; height: 600px; border: 2px dashed #DCDCDC; border-radius: 5px 5px;">
							
							<div id="optional-selection-container" style="overflow: hidden; margin-top: 200px;">
								<div style="overflow: hidden;" ><center><span style="font-size: 37px; opacity: 0.2;" >Suelta las imagenes aqui</span></center></div>
								<div style="overflow: hidden;" ><center><span style="opacity: 0.3;" > O si prefieres...</span></center></div>
								<div style="overflow: hidden; margin-top: 5px;" >
									<center>
										<button type="submit" class="g-button gblue" style="position: relative; overflow: hidden; direction: ltr; ">Seleciona las imagenes desde la computadora<input id="first-files" multiple="multiple" type="file" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; "></button>
									</center>
								</div>
							</div>
								
						</div>
					</div>
					<div style="overflow: hidden;  border-top: 1px solid #DCDCDC; padding: 10px;">
						<div style="overflow: hidden; float: left;"  >
							<button type="submit" id="save-this"	class="g-button gblue disabled lightbox-end-a" disabled="disabled">Guardar</button>
							<button type="submit" id="cancel-this"	class="g-button standar lightbox-end-a" style="margin-left: 5px;">Cancelar</button>
						</div>
						<div style="overflow: hidden; float: right;" >
							<button id="second-files-button" type="submit" class="g-button gblue" style="position: relative; overflow: hidden; direction: ltr; display:none;">Añadir mas<input id="second-files" multiple="multiple" type="file" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; "></button>
						</div>
					</div>
				</div>
				
				<!-- lightbox content end -->
			</div>
			<div id="lightbox-black-a" class="black_overlay" style="display:none;"></div>
		</div>
		<!-- lightbox end -->
		
<!-- ################################################################################## end 	images  ############################################################################ -->
		
				
				</div>

			<?php echo $this->Form->end(); ?>				
			<!-- end -->
		
		
		
		</div>
</div>





