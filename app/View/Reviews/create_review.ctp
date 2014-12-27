
<?php

	//debug($productsInTheCartOrderBySeller);
	
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
				<li><a href="/edit">Edit product [products]</a></li>
				<li><a href="/delete">Delete product [products]</a></li>
				<li><a href="/soldProducts">Sold products</a></li>
				<li><a href="/listProducts">List all products [products]</a></li>
				<li><a href="#">Reputation</a></li>
				<li><a href="#">Account seler settings</a></li>
		</ul>

	</div>
	<div class="b-sobre"> 
	
	




Star here <br><br>
<?php 

//debug($purchase);
//debug();
echo 'estas escriviendo una review de:';

?>

<a href="<?php echo $this->Html->url('/'.$purchase['User']['username'].'/'.Inflector::slug($purchase['Product']['title']).'/'.$purchase['Product']['id'], true); ?>" >
																		<?php  
																			echo $purchase['Product']['title']; 
																		?>
																		</a>

<?php						

echo '<br><img src="/img/products/'.$product['Image'][3]['name'].'" class="thumb_ProductsView" border="0"/></br>';


echo $this->Form->create('Review', array('url' => '/previewOfReview'));

echo '1) how do you rate this item xxxxx<br>';
$options = array('1' => 'lo peor', '2' => 'deficiente', '3' => 'regular', '4' => 'bueno', '5' => 'exelente');
echo $this->Form->select('rating', $options);
echo '<br><br>';
echo '2) please enter a title for your review<br>';
echo $this->Form->input('title');
echo '<br><br>';
echo 'Share your opinion<br> 3)Written review<br>';
echo $this->Form->textarea('body');

echo $this->Form->hidden('Purchase.id',array('value'=>$purchase['Purchase']['id']));


echo $this->Form->end('Preview you review');

?>	
	</div>
</div>	
	
	



	




	

