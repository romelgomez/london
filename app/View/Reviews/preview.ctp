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
				<li><a href="#">Account settings</a></li>
		</ul>

	</div>
	<div class="b-sobre"> 
		<?php 
		
			// debug($preview);
			echo $preview['Review']['title'].'<br><br>';
			echo $preview['Review']['body'].'<br><br>';
			echo $preview['Review']['rating'].'<br><br>';
			
		?>
		
		<a href="<?php echo $this->Html->url('/review/ok/'.$preview['Review']['id'], true); ?>">Termine! Publicalo</a>
		</br>
		<a href="<?php echo $this->Html->url('/review/edit/'.$preview['Review']['id'], true); ?>">Continua Editando</a>
		 
	</div>
</div>	
	
	



	




	

