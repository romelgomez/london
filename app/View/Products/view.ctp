<div style="padding:10px; overflow: hidden;">
	
	<div style="overflow: hidden;" id="debug"></div>
	
	<!-- #imagen #descripción   -->
	<div style="overflow: hidden; border: 1px solid #CCC;" >
		<div style="overflow: hidden; background: whiteSmoke; border-bottom: 4px solid #575757;" >
			<div style="overflow: hidden; background: whiteSmoke; width: 500px; height: 400px; float: left; border: 4px solid #575757; border-bottom: none;" >
				<!-- 	background: #000 url('/img/ico_cargando.gif') no-repeat; -->
				<?php
					if($product['Image']){
						$arrayImagenes = array();
						foreach ($product['Image'] as $i => $arrayValues  ){
							if($arrayValues['deleted']=='0'){
								$arrayImagenes[] = $arrayValues['name'];  
							}
						}
						if(!$arrayImagenes){
							$arrayImagenes[0] = 'noImage.jpg';
						}
					}else{
						$arrayImagenes[0] = 'noImage.jpg';
					}
				?>
				<a href="<?php echo $this->Html->url('/imageProduct/900/600/2/'.$arrayImagenes[0], true); ?>" class="pirobox_gall" title="Market Of London">
					<div style="overflow: hidden;" id="image_ProductsView">
					<?php echo $this->Html->image('/imageProduct/500/400/2/'.$arrayImagenes[0]); ?>
					</div>
				</a>
							
				<div style="display:none;">
					<?php					
						foreach ($arrayImagenes as $i => $arrayValues){
							if($i > 0){ 
								// empiesa en 1 por que el 0 es referenciado cuando se llama al lighbox	 
								echo '<a href="/imageProduct/900/600/2/'.$arrayValues.'" class="pirobox_gall" title="www.santomercado.com"></a>';
							}
						}					
					?>	
				</div>
			</div>
			<div style="overflow: hidden;      border-top: none; border-left: none; background: whiteSmoke;">
					<div style="overflow:hidden; background: black; opacity: 0.65; color: white; font-family: 'Quicksand', sans-serif; font-size: 20px; padding-left: 10px; padding-top: 3px; padding-bottom: 1px;">
						<?php echo $product['Product']['title'] ?>
					</div>
					<div style="overflow:hidden; font-size: 17px; padding: 10px;">
						<b>Precio : </b><?php echo $product['Product']['price']; ?> BsF.<br>
						<b>Vendedor:</b>  
						<a href="<?php echo $this->Html->url('/store/'.strtolower(Inflector::slug($product['Company']['name'])).'/'.$product['Company']['id'], true); ?>"><?php echo $product['Company']['name']; ?> C.A. RIF: <?php echo $product['Company']['rif']; ?></a>
						
						<?php 
							$quantity 		= $product['Product']['quantity'];
							$product_id 	= $product['Product']['id'];
						?>
						
						<?php if($quantity == 0){ ?>
							<div><b>Este producto o servicio ya no está disponible. Entrar en contacto con el vendedor haciendo clic <a href="/contact_the_seller/<?php echo strtolower(Inflector::slug($product['Company']['name'])).'/'.$product['Company']['id']; ?>">aquí!</a></b></div>
						<?php }elseif($quantity == 1){ ?>
							<div><b>Sólo hay:</b> <?php echo $quantity; ?> unidad.</div>
							<?php 
								echo $this->Form->create('Product', array('url' => '/cart/add','id'=>'buyNow'));
								echo $this->Form->hidden('Product.id',array('value'=>$product_id));
								echo $this->Form->hidden('Product.quantity',array('label'=>'Cantidad: ','id'=>'quantity','value'=>1,'type'=>'text')); 
								echo $this->Form->button('Agregar al carrito', array('type'=>'submit','class'=>'g-button'));
								echo $this->Form->end();
							?>			
						<?php }elseif($quantity > 1){ ?>
							<div><b>Tengo disponible:</b> <?php echo $quantity; ?> unidades. ¿Cuántas quieres?</div>
							<?php
								echo $this->Form->create('Product', array('url' => '/cart/add','id'=>'buyNow'));
								echo $this->Form->hidden('Product.id',array('value'=>$product_id));
								echo $this->Form->input('Product.quantity',array('label'=>'<b>Cantidad:</b> ','id'=>'quantity','size'=>3,'value'=>1,'maxlength'=>3,'type'=>'text'));
								echo $this->Form->button('Agregar al carrito', array('type'=>'submit','class'=>'g-button'));
								echo $this->Form->end();
							?>
						<?php } ?>
						
					</div>
				</div>
		</div>
		<div style="overflow: hidden; border-bottom: 4px solid #575757;">
			
			<ul id="mycarousel" class="jcarousel-skin-tango"> 
				<?php foreach ($product['Image'] as $i => $arrayValues){ ?>
					
					<li>
						<a href="#" rel="/imageProduct/500/370/2/<?php echo $arrayValues['name'] ?>" class="image_ProductsView">
							<img src="/imageProduct/120/120/2/<?php echo $arrayValues['name'] ?>" class="thumb_ProductsView" border="0"/>
						</a>
					</li>
						
				<?php } ?>
			</ul>
			
		</div>
		<div style="overflow: hidden; padding: 10px;" >
			<h2 style="color: #11949C; margin: 0px;">Descripción:</h2>		
			<div style="overflow: hidden; margin-top: 5px;">
				<?php echo $product['Product']['body']; ?>
			</div>
		</div>
	</div>

	<!-- #preguntas -->
	<div style="overflow: hidden; margin-top: 10px;  border: 1px solid #E5E5E5;">
	
		<!-- Obsoleto 
				
			Nuevo: Este comportamiento se establecera en el controlador. El cliente sera avertido en un lightbox. 	
		
		start
		--> 
		<?php if(isset($userData)){ ?>
			<?php if($userData['User']['company_id'] != $product['Company']['id']){  ?>
			<?php }else{ ?>
				 <!-- <div style="overflow: hidden;"><center><h2>No, esta permitido realizar preguntas, porque su cuenta tiene privilegios para responder.</h2></center></div> -->
			<?php } ?>
		<?php }else{ ?>
			<!-- <div style="overflow: hidden;"><center><h2><a href="/your_account"> Entra o inscrivete, para hacer una pregunta.</a></h2></center></div> -->
		<?php } ?>
		<!-- 
		end 
		-->


		<div style="overflow: hidden; padding: 10px; background: whiteSmoke;  box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);">
			<div style="overflow: hidden;"><h3 style="margin: 0px;" >Pregunta:</h3></div>

			<div id="message-form" style="overflow: hidden; margin-top: 7px;" >
			<?php
				echo $this->Form->create(Null,array('url'=>'','id'=>'MessageAddForm'));
				echo $this->Form->hidden('Message.product_id',array('value'=>$product_id));
				echo $this->Form->textarea('Message.body',array());
			?>
			
				<div style="overflow: hidden; margin-top: 5px;">
					<div style="overflow: hidden; float: left; width: 220px;">
						<div style="overflow: hidden; margin-top: 10px;" >Te quedan <span id="charsLeft"></span> caracteres.</div>
					</div>	
					<div style="overflow: hidden; float: left; width:716px;">
						<center>
							<div id="success-message" style="background-color: #ECFFDB; border-radius: 6px; padding:6px; border:1px solid #A2D246; width:300px; display:none;" > ¡Se ha enviado satisfactoriamente!</div>
							<div id="error-message" style="background-color: #FFD1D1; border-radius: 6px; padding: 6px; border:1px solid red; width:300px; display:none;" >¡Ha ocurrido algun error!</div>
						</center>
					</div>	
					<div style="overflow: hidden;  width: 220px; text-align: right; float: right;">
						<?php echo $this->Form->submit('Enviar', array('class' => 'g-button submit-button')); ?>
					</div>	
				</div>
					
				
				<?php echo $this->Form->end(); ?>			
			
			</div>
		</div>
	
			
	</div>		
	
		
	<?php if($messages){ ?>
			
		<div style="overflow: hidden; margin-top: 10px; border: 1px solid #C0DADF; box-shadow: inset 0 0 70px rgba(0, 0, 0, 0.1);">
			<div style="overflow: hidden;text-align: center;background: #C0DADF;color: #333;font: bold 14px 'Arial';padding: 4px;border-bottom-right-radius: 6px; margin-bottom: 20px;width: 245px;font-size: 20px; line-height: 130%; font-family: Georgia, times, serif; font-style: italic; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3); box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);" >Preguntas realizadas:</div>
			<!-- start container mensaje -->
			<div style="overflow: hidden;  font: 14px/20px 'Arial'; color: #333;" >


			<?php 
				//debug($messages);
				$number_of_questions = count($messages);
			?>

			<?php foreach($messages as $key=>$message){ ?>
				<!-- start mensaje -->
				<div style="overflow: hidden; border-top: 1px solid #C0DADF; margin-bottom: 20px;">
					<div style="overflow: hidden; float: left; width: 70px;">
						<div style="overflow: hidden;text-align: center;background: #C0DADF;color: #333;font: bold 14px 'Arial';padding: 4px;border-bottom-right-radius: 6px; margin-bottom: 4px;font-size: 16px; line-height: 130%; font-family: Georgia, times, serif; font-style: italic; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3); box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);"><?php echo $number_of_questions-$key; ?></div>
						<div style="overflow: hidden; text-align: right;">	<?php echo $this->Time->format('d-m-y',$message['Message']['created']); ?>	</div>
						<div style="overflow: hidden; text-align: right;">	<?php echo $this->Time->format('h:i A',$message['Message']['created']); ?>	</div>
					</div>
					<div style="overflow: hidden; padding: 20px; padding-bottom: 0px; padding-right: 0px;">
						<div style="overflow: hidden; padding-right: 20px; min-height: 60px;">
							<?php  echo $message['Message']['body']; ?> 
						</div>
						<!-- start respuetas -->
						
						<!--
						<div style="overflow: hidden; margin-top: 10px;">
							<div style="overflow: hidden;"><b>Ocultar respuestas</b></div>
							<div style="overflow: hidden;">

								<div style="overflow: hidden; border-top: 1px solid #C0DADF; margin-top: 20px;">
									<div style="overflow: hidden; float: left; width: 70px;">
										<div style="overflow: hidden;text-align: center;background: #C0DADF;color: #333;font: bold 14px 'Arial';padding: 4px;border-bottom-right-radius: 6px; margin-bottom: 4px;font-size: 16px; line-height: 130%; font-family: Georgia, times, serif; font-style: italic; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3); box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);">#1&nbsp;</div>
										<div style="overflow: hidden; text-align: right;">	02-09-12		</div>
										<div style="overflow: hidden; text-align: right;">	04:21 PM	</div>
									</div>
									<div style="overflow: hidden; padding: 20px; padding-bottom: 0px; padding-right: 0px;">
										<div style="overflow: hidden; padding-right: 20px;">
											<div style="overflow: hidden;color: blue;color: #358; font-weight: bold;">
												Empresa
											</div>
											<div style="overflow: hidden;">
												GoodPeople fue otro de los que se ubicó en el tablero global. Daniel Jejcic y Pablo Orlando venden tablas de boarding e indumentaria al nicho "cool" del mercado. Allí, vieron dos oportunidades: "Una, en la venta online; otra, en la comunidad, desorganizada en Internet", dice Jejcic. GoodPeople empezó a rodar sobre ahorros familiares y en poco tiempo logró cautivar a su público, dentro y fuera de la red. Por estos días, busca fortalecer el canal online para escalar, en especial, en los Estados Unidos.
												La banda ancha y la multiplicación de usuarios consolidaron un universo de negocios paralelo. En 2007, SocialMetrix anticipó la ya impuesta necesidad de las marcas de saber qué se d								
											</div>
										</div>
									</div>
								</div>
								
								<div style="overflow: hidden; border-top: 1px solid #C0DADF; margin-top: 20px;">
									<div style="overflow: hidden; float: left; width: 70px;">
										<div style="overflow: hidden;text-align: center;background: #C0DADF;color: #333;font: bold 14px 'Arial';padding: 4px;border-bottom-right-radius: 6px; margin-bottom: 4px;font-size: 16px; line-height: 130%; font-family: Georgia, times, serif; font-style: italic; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3); box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);">#2&nbsp;</div>
										<div style="overflow: hidden; text-align: right;">	02-09-12		</div>
										<div style="overflow: hidden; text-align: right;">	04:21 PM		</div>
									</div>
									<div style="overflow: hidden; padding: 20px; padding-bottom: 0px; padding-right: 0px;">
										<div style="overflow: hidden; padding-right: 20px;">
											GoodPeople fue otro de los que se ubicó en el tablero global. Daniel Jejcic y Pablo Orlando venden tablas de boarding e indumentaria al nicho "cool" del mercado. Allí, vieron dos oportunidades: "Una, en la venta online; otra, en la comunidad, desorganizada en Internet", dice Jejcic. GoodPeople empezó a rodar sobre ahorros familiares y en poco tiempo logró cautivar a su público, dentro y fuera de la red. Por estos días, busca fortalecer el canal online para escalar, en especial, en los Estados Unidos.
											La banda ancha y la multiplicación de usuarios consolidaron un universo de negocios paralelo. En 2007, SocialMetrix anticipó la ya impuesta necesidad de las marcas de saber qué se d
										</div>
									</div>
								</div>
										
							</div>
						</div>
						-->
						
						<!-- end respuetas -->
					</div>
				</div>
				<!-- end mensaje -->
			<?php } ?>

				
				
			</div>
			<!-- end container mensaje -->
		</div>
	
	<?php } ?>


</div>

<!-- ################################################################################## start login  ############################################################################ -->
<!-- 

	lightbox para login, si se detecta la intención de enviar una pregunta de parte de un usuario no logueado.   

-->

		<!-- lightbox start -->
		<div id="lightbox-container-a" style="overflow: hidden;">
			<div id="lightbox-white-a" class="white_content"  style="display:none;">
				<!-- lightbox content start  -->
	

				<div style="overflow: hidden;">
					<div style="overflow: hidden; border-bottom: 1px solid #DCDCDC; padding: 10px;">
						<div style="overflow: hidden; float: left;"><span>Ingresá al sitio</span></div>
						<div style="overflow: hidden; float: right;"><a href="#" class="lightbox-end-a" style="border: none;"><img src="/img/x2.png" title="Cancelar" style="width: 24px;"></a></div>
					</div>
					<div style="overflow: hidden; padding: 10px;">
						
						<?php
							echo $this->Form->create('User', array('action' => 'login'));
							echo $this->Form->input('User.email',array('label'=>array('text' => 'Email','style'=>'font-size: 17px;'),'class'=>'login-input'));
							echo $this->Form->input('User.password',array('label'=>array('text' => 'Clave','style'=>'font-size: 17px;'),'class'=>'login-input'));
						?>
						
						<div style="overflow: hidden; padding-top: 4px;">
							<div style="overflow: hidden; float: left;"></div>
							<div style="overflow: hidden; float: right;"><?php echo $this->Form->submit('Entrar', array('class' => 'g-button submit-button')); ?></div>	
						</div>
						
					</div>
				</div>
				
				<!-- lightbox content end -->
			</div>
			<div id="lightbox-black-a" class="black_overlay" style="display:none;"></div>
		</div>
		<!-- lightbox end -->
		
<!-- ################################################################################## end  login  ############################################################################ -->

<style type="text/css">
.black_overlay{
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: whiteSmoke;
	-moz-opacity: 0.6;
	opacity:.6;
	filter: alpha(opacity=60);
		
	position: fixed;
	z-index:1001;
}
.white_content {
	top: 20%;
	left: 40%;
	width: 350px;
	border: 1px solid #C0DADF;
	background-color: white;
	overflow: hidden;
			
	position: fixed;
	z-index:1002;

	border-radius: 6px;
	overflow: hidden;
	color: #333;
	font: bold 14px 'Arial';
	font-size: 20px;
	line-height: 130%;
	font-family: Georgia, times, serif;
	font-style: italic;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.3);
	box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.1);
	padding: 4px;
}
.login-input{
	width: 100%;
	height: 32px;
	font-size: 15px;
	direction: ltr;
	border-radius: 1px;
	box-sizing: border-box;
	border-top: 1px solid silver;
	margin: 0;
	padding: 0 8px;
	background: white;
	display: inline-block;
	border-left: 1px solid silver;	
}
.login-input:focus{
	outline: none;
	border: 1px solid #C0DADF;
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3);
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3);
}
</style>


<script type="text/javascript">
/**
* limitar lo caracteres 
**/

jQuery(document).ready(function(){
	
	if(jQuery('#MessageBody').length){
		
		(function($){ 
			 $.fn.extend({  
				limit: function(limit,element) {
					
					var interval, f;
					var self = jQuery(this);
							
					jQuery(this).focus(function(){
						interval = window.setInterval(substring,100);
					});
					jQuery(this).blur(function(){
						clearInterval(interval);
						substring();
					});
					substringFunction = "function substring(){ var val = $(self).val();var length = val.length;if(length > limit){$(self).val($(self).val().substring(0,limit));}";
					if(typeof element != 'undefined')
						substringFunction += "if($(element).html() != limit-length){$(element).html((limit-length<=0)?'0':limit-length);}"
						
					substringFunction += "}";
					
					eval(substringFunction);
					
					substring();
				} 
			}); 
		})(jQuery);
		jQuery('#MessageBody').limit('1000','#charsLeft');	
	
	
	}



});
</script>	




<script type="text/javascript">

// ###################################################	LightBox Object	###########################################################################

var UserInterface = { LightBox : { } };

	UserInterface.LightBox = {
		initialize: function(config_obj){			
			this.start(config_obj);
			this.end(config_obj);		
		},
		start: function(config_obj){
			config_obj.callbacks.start();
			var ids = config_obj.content_id+','+config_obj.overlay_id;
			jQuery(ids).each(function(){
				jQuery(this).fadeIn();
			});
		},
		end: function(config_obj){			
			if(config_obj.overlay_end){
				// LightBox desaparece al hacer click afuera de el y en la x 
				end = config_obj.end_class+','+config_obj.overlay_id;
			}else{
				// LightBox desaparece al hacer click solo en en la x
				end = config_obj.end_class;
			}
			jQuery(end).each(function(){
				jQuery(this).click(function(event){
					event.preventDefault();
					config_obj.callbacks.end();
					var ids = config_obj.content_id+','+config_obj.overlay_id;
					jQuery(ids).fadeOut();
				});
			});
		}
	};

// ###################################################	AjaxRequest Class	###########################################################################

var AjaxRequest = function(config_obj,obj){		
	if(!obj){
		obj = {};
		jQuery.each(config_obj.data,function(k,db_field){				
			obj[k] = jQuery('#'+db_field).val();
		});
	}	
	var set_obj ={
		type: config_obj.type,
		url: config_obj.url,
		data: obj,
		global: false,
		complete: function(response){
			config_obj.callbacks.complete(response);
		}
	}	
	if(config_obj.console_log){
		jQuery('#debug').load(set_obj.url,set_obj.data,function(response, status,xhr){ config_obj.callbacks.complete(xhr); });
	}else{
		jQuery.ajax(set_obj);
	}	
}

// ################################################# 	ErrorHelper Class ###########################################################################

var ErrorHelper = function(obj){

	if(obj.allowed){
		// si esta permitido
		// console.log('si esta permitido');
		
		if(!obj.validates){
			jQuery.each(obj.fields,function(elementId,message){
				jQuery('#'+elementId).addClass('requiredInput');
				jQuery('#'+elementId).click(function(){
					jQuery(this).removeClass('requiredInput');
				});
				jQuery('#'+elementId).focus(function(){
					jQuery(this).removeClass('requiredInput'); 
				});
			});
		}
		
		if(obj.validates){
			// validates = true
			obj.success_accion(obj);
			
			if(obj.scheme == 1){
				fade_this = function(array){
					jQuery(array).each(function(k,elementId){
						jQuery('#'+elementId).fadeOut();
					});
				}
				appear_this = function(array){
					jQuery(array).each(function(k,elementId){
						jQuery('#'+elementId).fadeIn();
					});
				}
				// se verifica si se guardo 
				if(obj.save){
					document.getElementById(obj.ids.form_id).reset();
					jQuery('#'+obj.ids.error).fadeOut();
					appear_this([obj.ids.success]);
					setTimeout(function(){fade_this([obj.ids.success]);}, 3000);
				}else{
					appear_this([obj.ids.error]);
				}
			}
			if(obj.scheme == 2){
				if(obj.save){
					document.getElementById(obj.ids.form_id).reset();
				}
			}
		}
			
	}else{
		// no esta permitido
		// forsamos el login
		// console.log('no esta permitido');
		// console.log('forsamos el login');
	}
	
}


// #################################################	MessageAddForm	 ###########################################################################

var ContactObject = {
	AddNew: function(config_obj){
		jQuery("#MessageAddForm").submit(function(event){
			event.preventDefault();
			new AjaxRequest(config_obj,false);
		});
	}
};

var contact_form_obj = {
	"contact":{
		"add_new": {
			"type":"post",
			"url":"/add_message", 
			"data":{"product_id":"MessageProductId","body":"MessageBody"},
			"console_log":true,
			"callbacks":{
				"complete":function(response){
					
					var a = response.responseText;
					var obj = jQuery.parseJSON(a);

					errorHelperConfigObject 				=  {}; 
					errorHelperConfigObject 				= obj;
					errorHelperConfigObject.scheme 			= 1;
					errorHelperConfigObject.ids 			= {
						"form_id":"MessageAddForm",
						"success":"success-message",
						"error": "error-message"
					};
					errorHelperConfigObject.success_accion = function(obj){
						console.log(obj);
						console.log('ok');
					}
					
					new ErrorHelper(errorHelperConfigObject);
					
				}
			}
		}
	}
};

jQuery(document).ready(function(){
	ContactObject.AddNew(contact_form_obj.contact.add_new);
});

</script>


<script type="text/javascript">

/*

	var UserInterface = { Authentication : { } };

	UserInterface.Authentication = Class.create({
		
		initialize: function(obj,callback){
			
			this.start(obj,callback);
			this.end(obj,callback);
		
		},
		start: function(obj,callback){			
			
			callback.start()
			$(obj.white_content_id,obj.black_overlay_id).each(function(element){
				element.appear();
			});
			
		},
		end: function(obj,callback){
			
			if(obj.black_overlay_end){
				$$('.'+obj.end_class,'#'+obj.black_overlay_id).each(function(element){
					
					element.stopObserving();
					element.observe('click',function(event){				
						event.preventDefault();
						callback.end(event.element());
						
						$(obj.white_content_id,obj.black_overlay_id).each(function(element){
							element.fade();
						})
						
					})
					
					
				});
			}else{
				
				$$('.'+obj.end_class).each(function(element){
					
					element.stopObserving();
					element.observe('click',function(event){				
						event.preventDefault();
						callback.end(event.element());
						
						$(obj.white_content_id,obj.black_overlay_id).each(function(element){
							element.fade();
						})
						
					})
					
				});
			}
		
		}
		
	});

	// <--- lightbox --->
	var lightbox_config_obj_a = {
		"white_content_id":"lightbox-white-a",
		"black_overlay_id":"lightbox-black-a",
		"black_overlay_end":true,
		"start_class":"lightbox-start-a",
		"end_class":"lightbox-end-a"
	}
	var lightbox_callbacks_a = {
		"start":function(){
		},
		"end":function(element){
			
			
			
		}
	}

	// new UserInterface.Authentication(lightbox_config_obj_a,lightbox_callbacks_a);
	
*/

/*

var MessageFormTasksClass = { Publish:{ AddNew: {},Replay: {}}};

var AjaxRequest = Class.create({
	initialize:	function(config_obj,callbacks,obj){
		this.request(config_obj,callbacks,obj);
	},
	request:function(config_obj,callbacks,obj){
		
		if(!obj){
			obj = {};
			var f = Object.keys(config_obj.obj)
			f.each(function(elementId){				
				obj[elementId] = $(config_obj.obj[elementId]).value; 
			});
		}
		
		var config = {
			method:'get',
			parameters:obj,
			onSuccess: function(response){
				callbacks.onSuccess(response);
			}
		}
		
		if(config_obj.console_log){
			new Ajax.Updater('debug',config_obj.action,config);
		}else{
			new Ajax.Request(config_obj.action,config);
		}
			
	}
});

MessageFormTasksClass.Publish.AddNew 	= Class.create({
	initialize:	function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks	= callbacks;
		this.add_new();
	
	},
	add_new: function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		
		$('MessageAddForm').observe('submit',function(event){
			event.preventDefault();
			new AjaxRequest(config_obj,callbacks,false)	
		});
	}
});

var config_obj = {
	"publish":{
		"add_new": {
			"action":"/addMessage", 
			"obj":{"product_id":"MessageProductId","body":"MessageBody"},
			"console_log":true,
		}
	}
};
		
*/

/*	

var callbacks = {
	"publish":{
		"add_new": {
			"onSuccess":function(response){
				
				var a = response.responseText;
				var b = a.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var obj = b.evalJSON();
				
				if(obj.login){	// sin credenciales.
					// new class longin
				}else{			// con credenciales.
					//
				}
				
				
				if(!obj.result){
					var f = Object.keys(obj);
					f.each(function(elementId){	
						$(elementId).addClassName('requiredInput');
						$(elementId).observe('click',function(){
							this.removeClassName('requiredInput'); 
						});
						$(elementId).observe('focus',function(){
							this.removeClassName('requiredInput'); 
						});
					});
				}else{
					var templates = {full:{},part:{}};
					
					templates.full = new Template(
						'<div style="overflow: hidden; margin-top: 10px;"><h3 style="margin: 0px;">Preguntas realizadas:</h3></div>'+
						'<div id="questions" style="overflow: hidden;">'+
							'<div style="margin-top: 7px; border: 1px solid #CCC; background: #EFEFEF; padding: 4px; border-radius: 3px;">'+
								'<div style="border:1px solid #888F8A; background: white; padding:5px; overflow: hidden;" >'+
									'<b>P:</b>	#{body}'+  
								'</div>'+
							'</div>'+
						'</div>'
					);
					templates.part = new Template(
						'<div style="margin-top: 7px; border: 1px solid #CCC; background: #EFEFEF; padding: 4px; border-radius: 3px;">'+
							'<div style="border:1px solid #888F8A; background: white; padding:5px; overflow: hidden;" >'+
								'<b>P:</b>	#{body}'+  
							'</div>'+
						'</div>'
					);
					
					var data = {body:obj.body};
					if($('questions')){
						// part
						$('questions').insert({
							top: templates.part.evaluate(data)
						});
					}else{
						// full
						$('questions-container').insert({
							top: templates.full.evaluate(data)
						});
					}
				
					$('QuestionBody').value = '';
				}
				
				
				
			}
		}
	}
}

*/


/*

document.observe("dom:loaded", function(){
	if($('MessageAddForm')){
		new MessageFormTasksClass.Publish.AddNew	(config_obj.publish.add_new,	callbacks.publish.add_new);
	}
});

*/

</script>
