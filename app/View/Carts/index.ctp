<?php

		//debug($productsInTheCartOrderBySeller); // no logeado 
	
/*
_____________________________________________________________
	|
	|
	|		[seler: shylo]
	|		| 	Procesador intel 3.2 Ghz -------------------------> 300 $ 
	|		|	Case GAME				-------------------------> 200 $
	|		|_____________________________________________________________
	|		
	|
	|		[seler: razden]
	|		|	Memoria 2Gb 2000 Ghz	 -------------------------> 200 $
	|		|_____________________________________________________________   
	|		
	|	
	|	Total General: 700$
	|

*/

?>




<?php  if(isset($userData)){  ?>

<div class="contenedor-b" style="padding: 10px;">
	<div class="b-menu"> 
<?php echo $this->element('menu'); ?>
	</div>
	
<div class="b-sobre" style ="width: 978px;"> 
	<div class="preguntas">
		
		<?php if(isset($productsInTheCartOrderBySeller)){ ?>
			
		<h3>Productos en el carrito de compras.</h3>	
			
				<?php 
							$total = 0;
							foreach($productsInTheCartOrderBySeller as $selerKey => $cartDataValues){
								
								foreach($cartDataValues as $companyType){
									$type= $companyType['Company']['type'];
									$companyId= $companyType['Company']['id'];
								}
								
								echo '<div class="inCart" style="padding: 4px;">';
								
									echo '<h4> Vendedor: <a href="'.$this->Html->url('/store/'.Inflector::slug($selerKey).'/'.$companyId, true).'">'.$selerKey.' '.$type.'</a></h4>';
									
									$subTotal = 0;
									foreach($cartDataValues as $data){
										
										$arrayImagenes = array();
										foreach ($data['Image'] as $i => $arrayValues  ){
											if($arrayValues['deleted']=='0'){
												$arrayImagenes[] = $arrayValues['name'];  
											}
										}
										if(!$arrayImagenes){
											$arrayImagenes[0] = 'noImage.jpg';
										}
										
							
									echo '<div style="margin: 0 6px 10px 6px;">';	
										echo '<div class="product-universal-container">';
											echo '<div style="float:left; width: 121px; overflow: hidden;">';
												echo '<a href="'.$this->Html->url('/product/'.Inflector::slug($data['Product']['title']).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
													echo $this->Html->image('/imageProduct/120/120/2/'.$arrayImagenes[0],array('class'=>'product-universal-image'));
												echo '</a>';
											echo '</div>';
											echo '<div style=" overflow: hidden;">';
												echo '<a href="'.$this->Html->url('/product/'.Inflector::slug($data['Product']['title']).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
													echo'<div class="product-universal-name">'.$data['Product']['title'].'</div>';
												echo '</a>';
												echo '<div class="product-universal-options">'; 
													echo '<div style="float: left; ">Condición: Nuevo. <br><a href="/cart/delete/'.$data['Cart']['id'].'">Borrar</a></div>';  
													echo '<div style="overflow: hidden; float: right; padding-left: 30px">Cantidad: <br> <center>'.$data['Cart']['quantity'].'</center></div>';
													echo '<div style="overflow: hidden; float: right;" >Precio:  <br> <center>'.$data['Product']['price'].' BsF</center> </div>';
												echo'</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
										
										$total +=  $data['Cart']['quantity']*$data['Product']['price'];
										$subTotal +=  $data['Cart']['quantity']*$data['Product']['price'];
									}
								
								echo '<h4>Subtotal: '.$subTotal.'</h4>';							
								
								echo '</div>';
							}
				?>
		
			
		
		<?php
		
				echo '<h4>El total de su carrito de compra es de:'. $total.'</h4>';
 				echo  '<a class="g-button-red g-button" style="text-decoration: none;" href="/completeYourOrder" class="sidebars_has_tu_compra_ProductsView">Complete su orden ahora!</a>'; 
 				echo ' ó ';
 				echo  '<a class="g-button-submit g-button" style="text-decoration: none;" href="#" class="sidebars_has_tu_compra_ProductsView">GENERE UN PRESUPUESTO.</a>'; 
 			
				// un  cliente genera un presupuesto para que le aprueben un credito por el banco. ademas el vendedor le llega un correo que tal 
				// cliente le genero tal presupuesto este podra segun la manitud del presupueto llamar al cliente y ofrecerle un descuento por generar la orden de compra.
			
		
		}else{
			echo '<center><h2>No hay productos en el carrito de compras</h2></center>';
		}	
		?>	
			
	</div>
	</div>
</div>	
	
<?php }else{ ?>

<div class="contenedor-b">




	<div class="preguntas">
		
		<?php if(isset($productsInTheCartOrderBySeller)){ ?>
			
		<h3>Productos en el carrito de compras.</h3>	
			
				<?php 
							$total = 0;
							foreach($productsInTheCartOrderBySeller as $selerKey => $cartDataValues){
								
								echo '<div class="inCart">';
								
								echo '<h4> Vendedor: '.$selerKey.'</h4>';
									$subTotal = 0;
									foreach($cartDataValues as $data){
							
									echo '<div style="margin: 0 6px 10px 6px;">';	
										echo '<div class="product-universal-container">';
											echo '<div style="float:left; width: 121px; overflow: hidden;">';
												echo '<a href="'.$this->Html->url('/product/'.Inflector::slug($data['Product']['title']).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
													echo $this->Html->image('products/'.$data['Image']['4']['name'],array('class'=>'product-universal-image'));
												echo '</a>';
											echo '</div>';
											echo '<div style=" overflow: hidden;">';
												echo '<a href="'.$this->Html->url('/product/'.Inflector::slug($data['Product']['title']).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
													echo'<div class="product-universal-name">'.$data['Product']['title'].'</div>';
												echo '</a>';
												echo '<div class="product-universal-options">'; 
													echo '<div style="float: left; ">Condición: Nuevo. <br><a href="/cart/delete/'.$data['Cart']['id'].'">Borrar</a></div>';  
													echo '<div style="overflow: hidden; float: right; padding-left: 30px">Cantidad: <br> <center>'.$data['Cart']['quantity'].'</center></div>';
													echo '<div style="overflow: hidden; float: right;" >Precio:  <br> <center>'.$data['Product']['price'].' BsF</center> </div>';
												echo'</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
										
										$total +=  $data['Cart']['quantity']*$data['Product']['price'];
										$subTotal +=  $data['Cart']['quantity']*$data['Product']['price'];
									}
								
								echo '<h4>Subtotal: '.$subTotal.'</h4>';							
								
								echo '</div>';
							}
				?>			
		
		<?php		
		
				echo '<h4>El total de su carrito de compra es de:'. $total.'</h4>';
 				echo  '<a class="g-button-red g-button" style="text-decoration: none;" href="/completeYourOrder" class="sidebars_has_tu_compra_ProductsView">Complete su orden ahora!</a>'; 
 				echo  '<a class="g-button-red g-button" style="text-decoration: none;" href="#" class="sidebars_has_tu_compra_ProductsView">Genere un Presupuesto.</a>'; 
 				
			
		
		}else{
			echo '<center><h2>No hay productos en el carrito de compras</h2></center>';
		}	
		?>	
			
	</div>
</div>	
		
<?php } ?>	



	




	
