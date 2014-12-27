document.observe("dom:loaded", function(){
		
		
		// <--- edit draft --->		
		// En caso de estar editando un borrador, si exiten imagenes cargadas activadas, es preciso activar los proceso involucrados.
		// start
		if($$('#mycarousel li').length){
			// console.log('cuando existen lis');
										
			//ocultar start-upload
			$('start-upload').setStyle({
				display: 'none',
			});							

			//mostrar el elemento con id mycarrousel
			$('mycarousel').setStyle({
				display: 'inherit',
			});
										
			// mostrar link -continuar cargando-
			$('continue-upload').setStyle({
				display: 'inline',
			});
								
			// llamar la clase
			new S2.UI.Carousel("mycarousel");		
		}
		
		// borrar las miniaturas en el carrusel.
		if($$('.delete-this-image2').length){
			$$('.delete-this-image2').each(function(element){
											
				element.stopObserving();
				element.observe('click',function(event){
					event.preventDefault();
					var element = event.element();
					element.parentNode.parentNode.parentNode.remove(); // removemos <li></li>
											
					// start cambiamos el estado de la imagen a eliminada. 
					var img_element = element.parentNode; 	
					img_element.id
											
					str_replace = function(cadena, cambia_esto, por_esto) {
						return cadena.split(cambia_esto).join(por_esto);
					}
												
					// creamos el obj
					var obj = {};
												
					// añadimos el id de la imagen
					obj.image_id = str_replace(img_element.id,'image-id-','');
												
					// añadimos product_id 
					obj.product_id = $('ProductId').value;
																				
					// ajax
					var action = '/updateImageData';
					var config = {
						method:'post',
						parameters:obj,
						onComplete: function(response){
							// console.log(response);
						}
					}																				
					new Ajax.Request(action,config); 												
					// end
											
					// eliminar los obsevadores
					$$('.ui-carousel-next','.ui-carousel-prev','.ui-carousel-container ul').each(function(element){
						element.stopObserving();
					});	
												
					exist_thumbnails2();
											
				});						
			});
		}
																		
		// ¿siguen existiendo minaturas luego de borrar una? no, entonces se normaliza la vista.
		var exist_thumbnails2 = function(){
			if($$('#mycarousel li').length){
				//llamar la clase											
				new S2.UI.Carousel("mycarousel");
			}else{
				//ocultar el elemento con id mycarrousel
				$('mycarousel').setStyle({
					display: 'none',
				});
				//muestro start-upload
				$('start-upload').setStyle({
					display: 'inherit',
				});
			}
		}
		// end
		
		
		
		
		
		// <--- lightbox --->
		
		if($('lightbox-container-a')){
			
			var lightbox_config_obj_a = {
				"white_content_id":"lightbox-white-a",
				"black_overlay_id":"lightbox-black-a",
				"black_overlay_end":false,
				"start_class":"lightbox-start-a",
				"end_class":"lightbox-end-a"
			}
			var lightbox_callbacks_a = {
				"start":function(){
					
					if(!$('ProductId').value){
						//ProductFormsClass.saveDraft();
						SaveDraft.save_draft_request();
					}
					
				},
				"end":function(element){
					
					// se aprueban la imagenes recien cargadas
					if(element.id == 'save-this'){
						if($$('#drop-files .thumbnail').length){
							console.log($$('#drop-files .thumbnail').length);
							
							str_replace = function(cadena, cambia_esto, por_esto) {
								return cadena.split(cambia_esto).join(por_esto);
							}
							
							var images_ids = [];
							$$('#drop-files .thumbnail').each(function(element){
								images_ids.push(str_replace(element.id,'image-uploaded-id-',''));
							});
							
							// creamos el obj
							var obj = {};
							
							// añadimos los id de las imagenes
							obj.images_ids = serialize(images_ids);
														
							// añadimos product_id 
							obj.product_id = $('ProductId').value;
							
							// ajax
							var action = '/updateImageData';
							var config = {
								method:'post',
								parameters:obj,
								onComplete: function(response){
									
									//console.log(response);
									
									var c = response.responseText
									var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
									var e = d.evalJSON()
												
									standar_part = new Template(
										'<li>'+
											'<div class="thumbnail2" style="overflow: hidden; background: whitesmoke; border: 1px solid gray; width: 200px; height: 200px; float: left; margin: 5px; box-shadow: rgba(0, 0, 0, .2) 0 4px 16px;       -webkit-box-shadow:rgba(0, 0, 0, .2) 0 4px 16px;       -moz-box-shadow:rgba(0,0,0,.2) 0 4px 16px;">'+
												'<div style="overflow: hidden; width: 200px; height: 200px; z-index: 0; position: relative;">'+
													'<center>'+
														'<img src="/img/uploads/images-tmp/#{thumbnail_of_200x200px}" title="santomercado.com" />'+
													'</center>'+
												'</div>'+
												'<div id="image-id-#{img_id}" class="delete-this-image2" style="overflow: hidden; z-index: 1; margin-top:-200px; position: relative; float: right; padding-right: 2px; padding-top: 2px; width: 24px; height: 24px; cursor: pointer;">'+
													'<img style="width: 24px;" src="/img/x2.png">'+
												'</div>'+
											'</div>'+
										'</li>'
									);
									
									var lis = '';
									
									e.each(function(obj){
										var show = {
										  thumbnail_of_200x200px: obj.thumbnail_of_200x200px,
										  full_img_name: obj.name,
										  img_id: obj.id
										};
										lis += standar_part.evaluate(show);
									});									
									
									if($$('#mycarousel li').length){
									// console.log('cuando existen lis');
										
										// eliminar los obsevadores
										$$('.ui-carousel-next','.ui-carousel-prev','.ui-carousel-container ul').each(function(element){
											element.stopObserving();
										});	
										
										// incertar los nuevos elementoss
										$$('#mycarousel ul').each(function(element){
											element.insert({
												bottom: lis
											});								
										});
										
										// llamar la clase
										new S2.UI.Carousel("mycarousel");
																			
									}else{
									// console.log('cuando no existen lis')	
										
										//ocultar start-upload
										$('start-upload').setStyle({
											display: 'none',
										});
										
										//insertar los lis en el carrusel
										$$('#mycarousel ul').each(function(element){
											element.insert({
												bottom: lis
											});								
										});
										
										//mostrar el elemento con id mycarrousel
										$('mycarousel').setStyle({
											display: 'inherit',
										});
										
										// mostrar link -continuar cargando-
										$('continue-upload').setStyle({
											display: 'inline',
										});
										
										//llamar la clase											
										new S2.UI.Carousel("mycarousel");
									}
									
									// borrar las miniaturas en el carrusel.
									if($$('.delete-this-image2').length){
										$$('.delete-this-image2').each(function(element){
											
											element.stopObserving();
											element.observe('click',function(event){
												
												event.preventDefault();
												var element = event.element();
												element.parentNode.parentNode.parentNode.remove(); // removemos <li></li>
											
												// start cambiamos el estado de la imagen a eliminada. 
												var img_element = element.parentNode; 	
												img_element.id
											
												str_replace = function(cadena, cambia_esto, por_esto) {
													return cadena.split(cambia_esto).join(por_esto);
												}
												
												// creamos el obj
												var obj = {};
												
												// añadimos el id de la imagen
												obj.image_id = str_replace(img_element.id,'image-id-','');
												
												// añadimos product_id 
												obj.product_id = $('ProductId').value;
																				
												// ajax
												var action = '/updateImageData';
												var config = {
													method:'post',
													parameters:obj,
													onComplete: function(response){
														// console.log(response);
													}
												}																				
												new Ajax.Request(action,config); 												
												// end
											
												// eliminar los obsevadores
												$$('.ui-carousel-next','.ui-carousel-prev','.ui-carousel-container ul').each(function(element){
													element.stopObserving();
												});	
												
												exist_thumbnails2();
											
											});
											
										});
									}
																		
									// ¿siguen existiendo minaturas luego de borrar una? no, entonces se normaliza la vista.
									var exist_thumbnails2 = function(){
										if($$('#mycarousel li').length){
											//llamar la clase											
											new S2.UI.Carousel("mycarousel");
										}else{
											
											//ocultar el elemento con id mycarrousel
											$('mycarousel').setStyle({
												display: 'none',
											});
											
											//muestro start-upload
											$('start-upload').setStyle({
												display: 'inherit',
											});
										}
									}
								
								}
							}
							// Updater	
							// Request
							new Ajax.Request(action,config); 
							
							// removemos las miniaturas 'thumbnail' del lightbox
							if($$('#drop-files .thumbnail').length){								
								$$('#drop-files .thumbnail').each(function(element){
									element.remove();	
								});
								
								$('optional-selection-container').setStyle({
									display: 'block'
								});
								$('second-files-button').setStyle({
									display: 'none'
								});
								
								// no permitimos guardar
								$('save-this').addClassName('disabled'); 
								
								var attributes_of_save_this = {}
								attributes_of_save_this.disabled = 'disabled';
								$('save-this').writeAttribute(attributes_of_save_this);								
							}
						
						}
					}
					
				}
			}

			lightbox_a = new UserInterface.Lightbox(lightbox_config_obj_a,lightbox_callbacks_a);
		}
		
		// <--- file_upload --->
		
		var file_upload_config_obj = {
			"file_input_element_ids":["first-files","second-files"],	
			"drop_element_id"		:"drop-files"	
		};
		
		var file_upload_callbacks = {
			"events":{
				"dragover":function(element){
					$('drop-files').setStyle({
					  border: '2px dashed #357AE8',
					});
					$('lightbox-white-a').setStyle({
					  border: '1px solid #357AE8',
					});
				},
				"drop":function(element){
					$('drop-files').setStyle({
					  border: '2px dashed #DCDCDC',
					});	
					$('lightbox-white-a').setStyle({
					  border: '1px solid gray',
					});	
				},
				'progressEvent':{
					'loadstart':function(evt){
						//	Description					|	Times
						//	Progress has begun. 			Once. 
						//	console.log(evt);
						console.log('Progress has begun.');
					
						var temporary_event = new Template(
							'<div class="thumbnail" style="overflow: hidden; background: whitesmoke; border: 1px solid gray; width: 200px; height: 150px; float: left; margin: 5px;" >'+
								'<div style="overflow: hidden; width: 200px;" >'+
									'<div style="overflow: hidden; float: right; padding-right: 2px; padding-top: 2px; width: 24px; height: 24px;">'+
										'<a class="qq-upload-cancel" href="#" title="Cancelar"><img style="width: 24px;" src="/img/x2.png"></a>'+
									'</div>'+
								'</div>'+
								'<div style="overflow: hidden; width: 200px; " ><center><img src="/img/photocamera.png" ></center></div>'+
								'<div style="overflow: hidden; width: 200px; " >'+
									'<center>'+
										'<span class="upload-file-name"></span>'+
										'<span class="upload-size"></span>'+
									'</center>'+
								'</div>'+
								'<div style="overflow: hidden; width: 200px; margin-top: 5px;" >'+
									'<center>'+
										'<span class="upload-progress"><img src="/img/loading.gif" ></span>'+
										'<span class="upload-failed" style="display:none;" >Error</span>'+
									'</center>'+
								'</div>'+
							'</div>'
						);
						
						// $('drop-files').childElements().length
						// insertar los elementos temporales
						
						if($('optional-selection-container')){
							
							$('optional-selection-container').setStyle({
							  display: 'none'
							});
							$('drop-files').insert(temporary_event.evaluate());
							
							this.last_element_inserted =  $('drop-files').childElements().last();
							
						}else{
							
							$('drop-files').insert({"bottom":temporary_event.evaluate()});
							 
							this.last_element_inserted =  $('drop-files').childElements().last();
						
						}
						
						// añadir mas
						$('second-files-button').setStyle({display: 'block' });
						
						// permitimos guardar
						$('save-this').removeClassName('disabled'); 
						
						var attributes_of_save_this = {}
						attributes_of_save_this.disabled = false;
						$('save-this').writeAttribute(attributes_of_save_this);
						
					},
					'progress':function(evt){
						//	Description					|	Times
						//	In progress.					Zero or more.
						console.log('In progress');
						
						
						// this.last_element_inserted
						
						if (evt.lengthComputable) {  
							var percentComplete = evt.loaded / evt.total;  
						} else {
							// console.log('Unable to compute progress information since the total size is unknown');
						}
						
						/*						
						var progressBar = document.getElementById("p"),
						client = new XMLHttpRequest()
						client.open("GET", "magical-unicorns")
						client.onprogress = function(pe) {
							if(pe.lengthComputable) {
							  progressBar.max = pe.total
							  progressBar.value = pe.loaded
							}
						 }
						client.onloadend = function(pe) {
							progressBar.value = pe.loaded
						}
						client.send()
						*/
						
					},
					'error':function(evt){
						//	Description					|	Times
						// 	Progression failed.				Zero or more.
						console.log("Progression failed."); 
					
					},
					'abort':function(evt){
						//	Description					|	Times
						//	Progression is terminated.		Zero or more.
						console.log("Progression is terminated.");
					},
					'load':function(evt){
						//	Description					|	Times
						//  Progression is successful.		Zero or more.
						console.log('Progression is successful.');
					},
					'loadend':function(evt){
						//	Description					|	Times
						// 	Progress has stopped.			Once.
						//	console.log('Progress has stopped.');
						//	console.log(this.responseText);
						//	console.log(this.last_element_inserted);
					
						var a 		= this.responseText;
						var data 	= a.evalJSON();
					
						// actualizar el elemento con la la imagen cargada
						var myTemplante = new Template(
							'<div style="overflow: hidden; width: 200px; height: 150px; z-index: 0; position: relative;" ><center><img src="/img/uploads/images-tmp/#{image}" ></center></div>'+
							'<div class="delete-this-image" style="overflow: hidden; z-index: 1; margin-top:-150px; position: relative; float: right; padding-right: 2px; padding-top: 2px; width: 24px; height: 24px; cursor: pointer;">'+
								'<img style="width: 24px;" src="/img/x2.png">'+
							'</div>'
						);
						
						var img = {image:data.imagen_tmp};
						this.last_element_inserted.update(myTemplante.evaluate(img));
						
						// añadimos el atributo id
						var attr = {}
						attr.id = 'image-uploaded-id-'+data.imagen_id;
						this.last_element_inserted.writeAttribute(attr);
						
						// borrar la imagen del dom
						this.last_element_inserted.select('div.delete-this-image').each(function(element){
							element.observe('click',function(event){
								event.preventDefault();
								var element = event.element();
								element.parentNode.parentNode.remove();
							
								exist_thumbnails();
							});
						});
						
						// ¿siguen existiendo minaturas luego de borrar una? no, entonces se normaliza la vista.
						var exist_thumbnails = function(){
							if(!$$('#drop-files .thumbnail').length){
								$('optional-selection-container').setStyle({
									display: 'block'
								});
								$('second-files-button').setStyle({
									display: 'none'
								});
								
								// no permitimos guardar
								$('save-this').addClassName('disabled'); 
								
								var attributes_of_save_this = {}
								attributes_of_save_this.disabled = 'disabled';
								$('save-this').writeAttribute(attributes_of_save_this);
								
							}
						}
					
					}
				}
			}
		};
				
				
		new Forms.CommonTasks.FileUpload(file_upload_config_obj,file_upload_callbacks);
		
	});
