<style type="text/css"> 
	.contenedor-b{
		overflow: hidden;
	}
	.b-menu{
		width:200px;
		float:left;
	}
	.b-menu ul{
		list-style-type:none;
		padding:0px 0px 0px 10px;
	}	
	
	.b-menu h2{
		color: #076A8B;
		font-size: 18px;
		margin-bottom: 5px;
		margin-top: 0;
		font:"Trebuchet MS",Verdana,"DejaVu Sans",sans-serif;		
	}	
	.b-menu li a{
		font:13px/20px Arial,Helvetica,"Nimbus Sans L",sans-serif;
	}
	
	.separador {
		margin: 6px 0 0;
		padding: 6px 0 0;
		border-top: 1px dotted #BBB;
		
	}
	.b-menu ul ul.separador{
		padding:0px 0px 0px 0px;
	}
	
	.b-sobre{
		width:1000px;
		float:right;
	}
	
	.contenedor-c{
		overflow: hidden;
	}
		
	.contenedor-d{
		overflow: hidden;
	}
	
	
	
	
	
</style>

<div class="">	
	<!-- a) logo, buscador, acceder 
	
	<div class="">
		<div class="">
			logo
		</div>
		<div class="">
			<div class=""> buscador </div>
			<div class=""> acceder </div>
		</div>
	</div>
	
	-->
	
	<!-- b) menu, sobre marker of london / menu -->


<div class="contenedor-b">
	<div class="b-menu"> 

	<?php 
	
	foreach($allCategories as $fatherValue){
	
		echo '<ul>';
		
		echo '<h2>'.$fatherValue['Nspace']['name'].'</h2>';	
			
			foreach($fatherValue['children'] as $childrenValues){
					
					echo  '<li><a href="'.$childrenValues['Nspace']['id'].'">'.$childrenValues['Nspace']['name'].'</a></li>'; 
					
			}
		
		echo '</ul>';
		
	} 
	
	
	?>
	</div>
	<div class="b-sobre"> sobre marker of london / menu </div>
</div>	
	
	
	<div class="contenedor-b">
		<div class="b-menu"> 
		
			<ul>
				<h2>Classifieds</h2>
					<li><a href="#">Cars, Motorcycles & Other</a></li>		
					<li><a href="#">estate</a></li>		
					<li><a href="#">services</a></li>
			</ul>
			<ul>		
				<h2>Categories</h2>
					
						<li><a href="#">Vehicle Accessories</a></li>		
						<li><a href="#">Animals & Pets</a></li>		
						<li><a href="#">For Babies</a></li>		
						<li><a href="#">Cameras and Accessories</a></li>		
						<li><a href="#">Cell Phones</a></li>		
					
					<ul class="separador"></ul>
						<li><a href="#">Collectibles & Hobbies</a></li>		
						<li><a href="#">computing</a></li>		
						<li><a href="#">Video Games & Consoles</a></li>		
						<li><a href="#">Sports & Fitness</a></li>		
						<li><a href="#">Appliances</a></li>		
					
					<ul class="separador"></ul>
						<li><a href="#">Electronics, Audio and Video</a></li>		
						<li><a href="#">Home Furniture</a></li>		
						<li><a href="#">industries</a></li>		
						<li><a href="#">Musical Instruments</a></li>		
						<li><a href="#">Toys & Games</a></li>		
					
					
					<ul class="separador"></ul>
						<li><a href="#">Books, Music and Movies</a></li>		
						<li><a href="#">Tickets & Jewellery</a></li>		
						<li><a href="#">Clothing, Shoes & Accessories</a></li>		
						<li><a href="#">Health and Beauty</a></li>		
						<li><a href="#">other categories</a></li>
					
			</ul>		
		
		</div>
		<div class="b-sobre"> sobre marker of london / menu </div>
	</div>
	
	<!-- c) destacados -->
	<div class="contenedor-c">
	
		<h1>Destacados</h1>
		<div class="productos_UsersIndex">
		<!-- Productos -->
		<?php
			foreach ($products as $product):
		?>
		<a href="<?php echo $this->Html->url('/'.$product['User']['username'].'/'.Inflector::slug($product['Product']['title']).'/'.$product['Product']['id'], true); ?>" class="box">
			<span class="imagen_producto">
				<div style="display:none;">
					<?php
					/* Este foreach arma un array que contiene todas la imagenes en el tamano 270x270px que tiene el producto....
					* array(
					* 		 [0] => imagen.jpg
					* 		 [1] => imagen1.jpg
					* 	)
					* 		  
					* */
					$arrayImagenes = array();
					foreach ($product['Image'] as $i => $arrayValues  ){
								if($arrayValues['size']=='270x270px'){
										$arrayImagenes[] = $arrayValues['name'];  
									}
							}
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
		<?php endforeach; ?>
		<!-- Fin Productos -->
		</div>

	<div class="paginacion_bloque_UsersIndex">
		<div class="caja_general_UsersIndex"> 
	
				<?php if($this->params['paging']['Product']['prevPage']){ ?>
			<div class="caja_isquierda_UsersIndex">
				<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array('class'=>'flecha', 'id'=>'prev'), null, array());?>
			</div>
				<?php } else { ?>
			<div class="caja_isquierda_UsersIndex">
				<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array(), null, array('class'=>'flecha_pagina_1', 'id'=>'prev'));?>
			</div>
				<?php } ?>
				
			<div class="caja_centrar_UsersIndex">
				<div class="paginas_UsersIndex">
					<?php echo $this->Paginator->numbers();?>
				</div>
			</div>
				 
				<?php if($this->params['paging']['Product']['nextPage']){ ?>
			
			<div class="caja_derecha_UsersIndex">
				<?php 
						echo $this->Paginator->next(__('Proximo', true) . ' >>', array('class' => 'flecha','id'=>'next'), null, array());  
						// 1 array es para el link a, 2 arrar es para la etiqueta <span>
				?>
			</div>				 
				<?php } else { ?>		
			<div class="caja_derecha_UsersIndex">
				<?php echo $this->Paginator->next(__('Proximo', true) . ' >>', array(), null, array('class' => 'flecha_pagina_1','id'=>'next'));?>
			</div>
				<?php } ?>	
		
		</div>
	</div>


		
	</div>	
	<!-- d) vistos recientemente -->
	<div class="contenedor-d">
	
		<h1>Vistos Recientemente</h1>
		
	</div>	
</div>
