<div style="overflow: hidden; padding: 10px; ">	
	<div style="overflow: hidden;" id="debug"></div>
	<div class="b-menu" style="overflow: hidden; width: 200px; float: left;">
		<?php echo $this->element('menu'); ?>
	</div>
	<div style="overflow: hidden; width: 978px; float: right;">
		<div style="overflow: hidden; padding: 10px; background: whiteSmoke; border: 1px solid #E5E5E5;" >
			
			
			<?php if(isset($questionsThatMake)){ ?>
				<div style="background: #424242; color: white; padding: 10px; font-size: 17px;"> <span>De Vendedores:</span> </div>
				<div style="overflow: hidden;" >
					<?php foreach($questionsThatMake as $vendedor => $dataEtapa1){ ?>
						<div style="overflow: hidden; border: 1px solid #CCC; background: #EFEFEF; margin-top: 10px;">
							<div style="overflow: hidden; background: black; color: white; padding: 7px; ">
								<span style="font-size: 17px;"> Vendedor: <?php echo $vendedor; ?></span>
							</div>
							<div style="overflow: hidden; padding: 10px; padding-top: 0px;">
								<?php foreach($dataEtapa1 as $fecha => $dataEtapa2){ ?>
									<div style="overflow: hidden; padding-top: 10px;" >					
										<div style="overflow: hidden;" ><span><b>Fecha: <?php echo $fecha; ?> </b></span></div>
										<div style="overflow: hidden; padding-left: 10px;">
											<?php foreach($dataEtapa2 as $hora => $dataEtapa3){ ?>
												<div style="overflow: hidden; border:1px solid #CCC; padding: 10px; background: #DBDBDB; -webkit-border-radius: 3px 3px; margin-top: 10px;">
													<div style="overflow: hidden;" ><span><b>Hora: <?php echo $hora; ?></b></span></div>
													<div style="overflow: hidden;">
														
														
														<?php foreach($dataEtapa3 as $data){ ?>
															<!-- producto -->
															<div class="product-questions-container" style="margin-top: 10px; background: whiteSmoke url(/img/fondo-preguntas.png) repeat-y;">
																<div style="float:left; width: 121px; overflow: hidden; ">
																	
																	<?php echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($data['Product']['title'])).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">'; ?>
																		<?php	echo $this->Html->image('/imageProduct/120/120/2/'.$data['Product']['Image'][0]['name'],array('class'=>'product-questions-image')); ?>
																	<?php echo '</a>'; ?>
																   
																	<div style="padding:10px; padding-top: 7px; font-size: 17px; font-family: 'Times New Roman',Georgia,Serif;" >
																		Precio:
																		<br>
																		<?php echo $data['Product']['price']; ?> BsF
																	</div>
																	
																</div>
																<div style=" overflow: hidden;">
																	<?php 
																		echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($data['Product']['title'])).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
																		echo '<div class="product-questions-name">'.$data['Product']['title'].'</div>'; 
																		echo '</a>'; 
																	?>
																	
																	<div style="overflow: hidden; font-size: 15px; padding: 10px;"> 
																		<div style="overflow: hidden;">
																			<b>Pregunta:</b>
																			<?php echo $data['Question']['body']; ?>
																		</div>
																		<div style="overflow: hidden;">
																			<?php
																				if($data['Answer']['body']){
																					echo '<br><b>Respuesta:</b>';
																					echo $data['Answer']['body'];
																				}else{
																					echo '<center><h4>Sin respuesta ahun.</h4></center>';
																				}
																			?>
																		</div>
																	</div>
																</div>
															</div>
															<!-- end -->
														<?php } ?>	
														
														
														
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php }else{ ?>
				<h2>No hay preguntas nuevas.</h2>
			<?php } ?>
		
			<br><br><br>	
			
			<?php if(isset($questionsToAnswer)){ ?>
				<div style="background: #424242; color: white; padding: 10px; font-size: 17px;"> <span>De Clientes:</span> </div>
				<div style="overflow: hidden;" >
					<?php foreach($questionsToAnswer as $vendedor => $dataEtapa1){ ?>
						<div style="overflow: hidden; border: 1px solid #CCC; background: #EFEFEF; margin-top: 10px;">
							<div style="overflow: hidden; background: black; color: white; padding: 7px; ">
								<span style="font-size: 17px;"> Comprador: <?php echo $vendedor; ?></span>
							</div>
							<div style="overflow: hidden; padding: 10px; padding-top: 0px;">
								<?php foreach($dataEtapa1 as $fecha => $dataEtapa2){ ?>
									<div style="overflow: hidden; padding-top: 10px;" >					
										<div style="overflow: hidden;" ><span><b>Fecha: <?php echo $fecha; ?> </b></span></div>
										<div style="overflow: hidden; padding-left: 10px;">
											<?php foreach($dataEtapa2 as $hora => $dataEtapa3){ ?>
												<!-- producto -->
												<div style="overflow: hidden; border:1px solid #CCC; padding: 10px; background: #DBDBDB; -webkit-border-radius: 3px 3px; margin-top: 10px;">
													<div style="overflow: hidden;" ><span><b>Hora: <?php echo $hora; ?></b></span></div>
													<div style="overflow: hidden;">
														
														<?php //debug($dataEtapa3); ?>
														
														<?php foreach($dataEtapa3 as $data){ ?>
															<!-- producto -->
															<div class="product-questions-container" style="margin-top: 10px; background: whiteSmoke url(/img/fondo-preguntas.png) repeat-y;">
																<div style="float:left; width: 121px; overflow: hidden; ">
																	<?php 
																		echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($data['Product']['title'])).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
																		echo $this->Html->image('/imageProduct/120/120/2/'.$data['Product']['Image'][0]['name'],array('class'=>'product-questions-image'));
																		echo '</a>'; 
																	?>
																	<div style="padding:10px; padding-top: 5px; font-size: 17px; font-family: 'Times New Roman',Georgia,Serif;">
																		Precio:
																		<br>
																		<?php echo $data['Product']['price']; ?> 
																	</div>
																</div>
																<div style=" overflow: hidden;">
																	
																	<?php 
																		echo '<a href="'.$this->Html->url('/product/'.strtolower(Inflector::slug($data['Product']['title'])).'/'.$data['Product']['id'], true).'" style="text-decoration: none;">';
																		echo '<div class="product-questions-name">'.$data['Product']['title'].'</div>';
																		echo '</a>'; 
																	?>
																	<div  style="overflow: hidden; font-size: 15px; padding: 10px;"> 
																		<div style="overflow: hidden;">
																			<b>Pregunta:</b>
																			<div style="overflow: hidden; padding-top: 5px;">
																				<?php echo  $data['Question']['body']; ?>
																			</div>
																		</div>
																		<div style="overflow: hidden; padding-top: 10px;">
																			<b>Respuesta:</b>
																			
																			<div id="<?php echo 'ok_'.$data['Question']['id']; ?>" style="overflow: hidden; padding-top: 5px;">
																				<?php 
																					echo $this->Form->create('Answer',array('url'=>'','id'=>'question_'.$data['Question']['id'],'class'=>'question'));
																					echo $this->Form->textarea('Answer.body',array('id'=>'AnswerBody_'.$data['Question']['id']));
																					echo $this->Form->submit('Enviar', array('class' => 'g-button'));
																					echo $this->Form->end(); 
																				?>
																			</div>	
																				
																		</div>
																	</div>
																</div>
															</div>
															<!-- end -->
															
														<?php } ?>	
														
														
														
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
								
								<div style="padding: 7px;" ><button type="submit" class="g-button">enviar respuestas</button></div>
								
							</div>
						</div>
					<?php } ?>
				</div>
			<?php }else{ ?>
				<h2>No hay preguntas nuevas.</h2>
			<?php } ?>
			
			
		</div>
	</div>
</div>


<script type="text/javascript">
var QuestionTasksClass = {Reply:{},Delete: {}};

var AjaxRequest = Class.create({
	initialize:	function(config_obj,callbacks,obj){
		this.request(config_obj,callbacks,obj);
	},
	request:function(config_obj,callbacks,obj){
		
		// si el objeto no esta definido.
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

QuestionTasksClass.Reply 	= Class.create({
	initialize:	function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks	= callbacks;
		this.add_new();
	},
	add_new: function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
			
		$$('.question').each(function(element){
			$(element.id).observe('submit',function(event){	
				event.preventDefault();				
								
				var element = event.element();
				
				str_replace = function(cadena, cambia_esto, por_esto){
					return cadena.split(cambia_esto).join(por_esto);
				}
								
				var element_id = str_replace(element.id,'question_','');
				
				var obj = {};
				obj.question_id 	= element_id; 
				obj.body		= $('AnswerBody_'+element_id).value;
				
				new AjaxRequest(config_obj,callbacks,obj);																		
				
			});
		});
	
	}
});

var callbacks = {
	"reply":{
		"onSuccess":function(response){
			
			var c	= response.responseText
			var d	= c.replace(/^\s+/g,'').replace(/\s+$/g,'')
			var obj = d.evalJSON()
			
			if(obj.login){
				window.location = "/login";
			}			
				
			if(!obj.result){
				var f = Object.keys(obj)
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
				
				$('ok_'+obj.id).update(obj.body);
					
			}	
			
		}
	}
};
		
var config_obj = {
	"reply":{
		"action":"/respond",
		"console_log":true
	}
}

document.observe("dom:loaded", function(){

	if($$('.question').length){
		new QuestionTasksClass.Reply	(config_obj.reply,	callbacks.reply);
	}

});																		
																		
																		
</script>




