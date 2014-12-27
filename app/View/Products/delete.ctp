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
		width:998px;
		float:right;
	}
	
	.contenedor-c{
		overflow: hidden;
	}
		
	.contenedor-d{
		overflow: hidden;
	}
	
</style>

	
	



<div class="contenedor-b">
	<div class="b-menu"> 


		<ul>
			<h2>User</h2>
				<li><a href="/myPurchases">Purchased products</a></li>
				<li><a href="/questionsAndAnswers">Questions and answers</a></li>
				<li><a href="#">Account settings</a></li>
				<li><a href="#">How to use</a></li>
		</ul>
		<ul>
			<h2>Seler</h2>
				<li><a href="/newProduct">New product</a></li>
				<li><a href="/edit">Edit product</a></li>
				<li><a href="/delete">Delete product</a></li>
				<li><a href="/soldProducts">Sold products</a></li>
				<li><a href="/listProducts">List all products</a></li>
				<li><a href="#">Reputation</a></li>
		</ul>


	</div>
	<div class="b-sobre"> 

<h3>Delete</h3>
Cualidades:<br>
- abra un filtro que perimitira indentificar los registros de interes. <br>

<!-- Productos -->
		<?php
			
		if($products){		
			foreach ($products as $product):
			//debug($products);
			
				if($product['Image']){
					$arrayImagenes = array();
					foreach ($product['Image'] as $i => $arrayValues  ){
							if($arrayValues['size']=='270x270px'){
									$arrayImagenes[] = $arrayValues['name'];  
							}
					}
				}else{
					$arrayImagenes[0] = 'noImage.jpg';
				}

			
			
		?>
		
			
		<a href="<?php echo $this->Html->url('/deleteProduct/'.$product['Product']['id'], true); ?>" class="box">

			
			<span class="imagen_producto">
				<div style="display:none;">
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
		<?php endforeach; 
		
			}else{
			echo 'no hay productos publicados, no hay producto que eliminar.';
		}	
				
		?>
		<!-- Fin Productos -->
		
		
	</div>
</div>	

