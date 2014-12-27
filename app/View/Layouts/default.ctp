<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>

<title>
	<?php
		if(isset($seller)){ echo ucfirst(strtolower($seller)).' | '; } 
		if(isset($product_title)){ echo ucfirst(strtolower($product_title)).' | '; } 
	?>
		| Santo Mercado Venezuela
</title>


<?php
	echo $this->Html->script('prototype');
	echo $this->Html->script('s2');
	//echo $this->Html->script('src/scriptaculous');
	echo $this->Html->script('jquery-1.8.1');
	echo '<script>jQuery.noConflict();</script>';
	
	// para activar el menu - agregar categorias y subcategorias - insdipensable, drag and drop - http://weblog.axent.pl/examples/js.drag-drop-tree/
	// dependencias: prototype y scrip.taculo.us
	//echo $this->Html->script('drag-drop-tree');
	//echo $this->Html->script('cookie');
	
	echo $this->Html->script('select');

	// CSS3
	echo $this->Html->css(array('basico','falcon'));
	
	// products/view only
	echo $this->element('galeria');
	echo $this->element('carousel');
	echo $this->element('piroblox');

	echo $this->fetch('css');
	echo $this->fetch('script');
?>

</head>

<style type="text/css">
    .drag-drop-tree li {
        list-style-type:none;padding:0;margin:0;
    }
    .drag-drop-tree ul {
        padding:0;margin:0;padding-left:20px;
    }
    .drag-drop-tree-node-handle {
        cursor:pointer;
    }
    .drag-drop-tree-dropon-node > .drag-drop-tree-node-handle {
        border-bottom:2px #000000 solid;
        border-right:2px #000000 solid;
    }
    .drag-drop-tree-dropafter-node > .drag-drop-tree-node-handle {
        border-right-color:#FFFFFF;
    }
</style>


<body>

<!-- Todas la eiquetas de /layouts/default.ctp heredan _LayoutsDefault    -->

<div class="contenedor_LayoutsDefault"> 
    <div class="header_LayoutsDefault"> 
				
		<a href="/" class="logo-LayoutsDefault" title="SantoMercado" ><img src="/img/pagetop2.png"></a>
        <a href="/your_account" class="inscribete_LayoutsDefault">Su cuenta</a>
		<span class="hello-LayoutsDefault">
        <?php
        
		
			if(isset($userLoggedName)){
					echo 'Hola, '.$userLoggedName.'. ';
					echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout'));
			}
        ?>
        </span>
        
   </div> 
        
	<div class="contenido_LayoutsDefault"> 
		<div class="subtitulo_LayoutsDefault">
			
			<div style="float: left;">
				<div style="float: left; width: 397px; font-family:  'Quicksand', sans-serif; font-size: 22px;">
					<div style="padding-top: 1px;">
					<?php 
						echo '<a href="';
							if(isset($seller) && isset($product)){ 
							
								echo $this->Html->url('/store/'.strtolower(Inflector::slug($product['Company']['name'])).'/'.$product['Company']['id'], true);
							
								echo '">';			
									echo $product['Company']['name'];
									//if((strlen($product['Company']['name']))>11){ echo"...";}
									echo ' '.$product['Company']['type'];
								echo '</a>';
							
							}else{ 
								echo '/">';
								echo 'Menu';
								echo '</a>';
							}  
					?>
					</div>
				</div>
				<div style="float: right;">
					<style type="text/css">
						.search{
							-webkit-border-radius: 6px;
							background:#CCC;
							box-shadow: inset 0 2px 3px rgba(0,0,0,.24);
							
							width:600px;
							height: 22px;
							color:#4E4E4E;
							padding-top: 4px;
							padding-left: 7px;
							border:none;
							float: left;
							font-size: 21px; 
						}
						.button-go{
							-webkit-border-radius: 6px;
							color: #4E4E4E;  
							border: solid 1px #494949;  
							font-size: 19px;  
							height: 27px;  
							width: 81px;  
							text-shadow: 0 1px 1px rgba(0,0,0,.6);  
							background: #FFFFFF;  
							border:none;
							cursor: pointer;
							box-shadow: inset 0 2px 3px rgba(0,0,0,.24);
							margin-left: 5px;
						}
					</style>
					<div>
						<form>  
							<input class="search" type="text" value="Buscar..." onfocus="if (this.value == 'Buscar...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Buscar...';}" />
							<input class="button-go" type="button" value="Buscar" />
						</form>	 
					</div>
				</div>
			</div>
			<div style="float: right; width: 87px; font-family:  'Quicksand', sans-serif; font-size: 27px;">
				<a href="/cart" >
					<img src="/img/2.png" style="height: 22px;">
					<?php 	
							echo $quantityOfProductsInTheShoppingCart;
					?>
				</a>
			</div>
        
        </div>            
		<div class="central_LayoutsDefault" >
		
		<?php // debug($product); ?>
		
			<?php // echo $this->Session->flash(); ?>
			<?php
				echo $content_for_layout; 
			?>			
		</div>
	</div> 
	
<style type="text/css">
	.footer-a{
		margin: 0 auto;
		border-right:1px solid #CCC;
		border-left:1px solid #CCC;
		border-bottom:1px solid #CCC;
		width: 1194px;
		height:3px;
	}
	.footer-b{
		margin: 0 auto;
		border-right:1px solid #CCC;
		border-left:1px solid #CCC;
		border-bottom:1px solid #CCC;
		width: 1188px;
		height:3px;	
	
	}
</style>	
	
	<div>
		<div class="footer-a"></div>
		<div class="footer-b"></div>
	</div>
	

<br>
<center>En santomercado.com solo publican empresas certificadas. Exige tu factura.</center>
<br>
<center>Copyright © 2012 Santo Mercado Venezuela C.A J-777777777-G</center>


</div>


<?php 
	echo '<br /><br /><br />';
	//echo $this->element('sql_dump');
			
			echo 'Controller: '.$controller.'_controller.php'.'<br />';
			echo 'View: '.$action.'.ctp';
	
	
	//echo $this->Js->writeBuffer();
?>
</body>
</html>
