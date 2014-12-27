<style type="text/css">

.productos{
	border:1px solid black;
	padding:10px;
	overflow: hidden;
}
.producto{
	border:1px solid black;
	padding:10px;
	overflow: hidden;
	margin-bottom:10px;

}
.img{
	width:150px;
	height:100px;
	border:1px solid black;
}

h1{
	width:300px;
	display:inline;
}
.img2{
	
	width:50px;
	height:35px;
	border:1px solid black;
}
.seler{
	border:1px solid black;
	padding:10px;
	overflow: hidden;
	margin-bottom:10px;
}
.compra{
	border:1px solid black;
	padding:10px;
	overflow: hidden;
	margin-bottom:10px;
}
.left{
	float:left;
}
.right{
	float:right; 	
}
.imagenBox{
	width:152px;
}
.infoBox{
	
	overflow: hidden;

}

</style>



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


<div class="contenedor-b">
	<div class="b-menu"> 

		<ul>
			<h2>backend user</h2>
				<li><a href="#">productos comprados</a></li>
				<li><a href="#">favoritos</a></li>
				<li><a href="#">datos personales</a></li>
		</ul>
		<ul>
			<h2>shoping cart</h2>
				<li><a href="#">productos por comprar</a></li>
		</ul>
		<ul>
			<h2>backend seler</h2>
				<li><a href="#">Productos</a></li>
				<li><a href="#">productos vendidos</a></li>
				<li><a href="#">pregunta y respuestas</a></li>
				<li><a href="#">calificaciones</a></li>
				<li><a href="#">datos bancarios</a></li>
		</ul>

	</div>
	<div class="b-sobre"> 
		
		
		
		<h1>[nuevo producto +]</h1>
		
		
		[nombre]
		[descripcion]
		[imagenes]
		[precio unitario]
		[cantidad disponible]
		[publicar][guardar]
		
			<div class="productos">
			
			
			
		
		<h1>Productos Vendidos</h1>

		<div class="compra">	
			
			<div><h1>7/11/2012</h1> <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img2"> <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img2"></div>

		</div>

		<div class="compra">	
			
			<div><h1>10/10/2012</h1> <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img2"> <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img2"></div>
			 
			
			
			
			<div class="seler"> Comprador: fulanito. [ Telfonos ] [ Correo ] [hora]
				<div class="producto" > 
					<div class ="left imagenBox" ><img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"></div>
					<div class ="right infoBox" >
						<table>
							<tr>
								<td>Nombre</td>
								<td>Cantidad</td>
								<td>x</td>
								<td>Precio unitario</td>
								<td>=</td>
								<td>Precio SubTotal</td>
							</tr>
							<tr>
								<td>cauchos nuevos</td>
								<td>4</td>
								<td></td>
								<td>20$</td>
								<td></td>
								<td>80$</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="producto" > <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<center><< [1,2,3,4] >> [ver todos ]</center>
				<h3>resumen</h3>	
				[Total por Pagar fulanito:][imprimir informacion general de fulanito] [direccion de envio] [Numero de deposito o transferencia] [guia]
			</div>
			<div class="seler"> Seler: mengano. [ Informacion Bancaria $] [ Telfonos ] [ Correo ]
				<div class="producto" > <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"> [nombre:caucho]  [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="http://www.marketoflondon.com:8080/img/products/ducati_monster5.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<center><< [1,2,3,4] >> [ver todos ]</center>
				<h3>resumen</h3>	
				[total a pagar a fulanito:][imprimir informacion general de mengano][direccion de envio] [guia]
			</div>
			<h4>resumen general</h4>
			[total de la operacion]	[imprimir informacion bancaria general] [imprimir resumen general de la operacion]  		
		</div>
		<div class="compra">	
			<h1>12/10/2012</h1>
			<div class="seler"> Seler: fulanito. [ Informacion Bancaria $] [ Telfonos ] [ Correo ]
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho]  [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<center><< [1,2,3,4] >> [ver todos ]</center>
				<h3>resumen</h3>	
				[total a pagar a fulanito:][imprimir informacion general de fulanito][direccion de envio][guia]
				[direccion de envio]
				
			</div>
			<div class="seler"> Seler: mengano. [ Informacion Bancaria $] [ Telfonos ] [ Correo ]
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho]  [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<div class="producto" > <img src="independencedayvenezuela11-hp.jpg" class="img"> [nombre:caucho] [cantidad] [precio] [subTotal] </div>
				<center><< [1,2,3,4] >> [ver todos ]</center>
				<h3>resumen</h3>	
				[total a pagar a fulanito:][imprimir informacion general de mengano][direccion de envio][guia]
			</div>
			<h4>resumen general</h4>
			[total de la operacion]	[imprimir informacion bancaria general] [imprimir resumen general de la operacion]  		
		</div>
		
		<center><< [1,2,3,4] >> [ver todos ]</center>
		<div class="estadisticas"><h1>Estadisticas</h1>
			[total comprado] [total gastado] [nivel: comprador novato] [desglosar todo] [ imprimir estadisticas ]
		</div>
	</div>

			
	
	</div>
</div>	
	
	



	
