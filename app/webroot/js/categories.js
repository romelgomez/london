// administrativo.
var CategoryController = Class.create({
		
	addObservers:function(){
		
		requiredFields = function (formId){		
			var required = 0;
			// mejoras pendientes
			// hay 2 esenarios, cuando hay o no un modelo. si lo hay se toma el valor del error devuelto. si no simplemente se validad que el campo no este vacio.  
			// 1) tomar el valor del error que envia el modelo. esto requiere Ajax.Request
					
			$$('#'+formId+' div[class*=required] input').each(function(element){
				
				if(!element.value){
					$(element.id).parentNode.addClassName('error');
					required+=1
					$(element.id).observe('change',function(event){					
						this.parentNode.removeClassName('error');										
						required-=1
					})				
				}
			})
			
			$$('#'+formId+' div[class*=required] select').each(function(element){
				if(!element.value){
					$(element.id).parentNode.addClassName('error');
					required+=1
					$(element.id).observe('change',function(event){					
						this.parentNode.removeClassName('error');					
						required-=1
					})
				}
			})
			return required
		}
		
		ajaxRequest = function(obj,action){
				
			var config = { 
				method:'get',
				parameters:obj,
				insertion:'bottom',				
				onSuccess: resetForm()
			}
			new Ajax.Updater('mytree-standard',action,config)		
		
		}
	
		resetForm = function(){
			$('CategoryIndexForm').reset()
		}	
		
		$('CategoryIndexForm').observe('submit',function(event){
			event.stop();
			var required = requiredFields('CategoryIndexForm')
			if(!required){
				var obj = {"name":$('CategoryName').value,"is":$('CategoryIs').value}
				var action = '/categories/'
				ajaxRequest(obj,action)
			}
		})			
	
	}

	
})


// add
var MenuClass = Class.create({
	// esta funcion recibe el id de un ul, y para cada uno de los hijos 'li', se observan    
	// el ul que recibe esta funcion, sus vecinos son eliminados del dom 
	addObservers:function(id){		
		$(id).childElements().each(function(element){
			element.observe('click', function(event){
				
				$(id).nextSiblings().each(function(element){ element.remove() }) // default-options
				var element = event.element();
					
				str_replace = function(cadena, cambia_esto, por_esto) {
					return cadena.split(cambia_esto).join(por_esto);
				}
				
				var elementId = str_replace(element.id,'category-id-','')
						
				MenuClass.elementId = elementId
				MenuClass.getChildElements(elementId)
				
				// style
				a = $(element.id)
				parent = a.parentElement
				b = parent.childElements()
				b.each(function(element){ 
					if(element.hasClassName('li-selected')){
						element.removeClassName('li-selected');
					}
				})
				a.addClassName('li-selected');
				
			});
		})
	},
	// esta funcion toma el id de una categoria y recibe los hijos
	getChildElements:function(id){
		
	
		var obj = {"parent":id}
		var action = '/categories/getChildElements'
	
		var config = { 
			method:'get',
			parameters:obj,
			//insertion:'bottom',				
			onSuccess: this.setMenu
		}
		
		// Updater	
		new Ajax.Request(action,config)	

	},
	// esta funcion determina si existen hijos, y de ser cierto construlle un ul con li's
	setMenu:function(response){
	
	
		var c = response.responseText
		
		
		function aleatorio(inferior,superior){ 
			numPosibilidades = superior - inferior 
			aleat = Math.random() * numPosibilidades 
			aleat = Math.round(aleat) 
			return parseInt(inferior) + aleat 
		} 
		
		
		var v = c.evalJSON()
		//if(!v.last){ debug(c) }		
						
		if(!v.last){	// si  existe decedientes		
						
			// los elementos que esten + 1					
			currentElements = $('menu').childElementCount 
			newCurrentElements = currentElements + 1 
			newWidth = newCurrentElements * 251
			
			$('menu').setStyle({
			  width: newWidth+'px'
			});			
				
			//var srollValue = $('menu-box').scrollLeft	
			a = $('menu')
			parentObjDimensions = a.parentElement.getDimensions()
			childObjDimensions = a.getDimensions()
			
			if(childObjDimensions.width >parentObjDimensions.width){
				$('menu-box').scrollLeft = childObjDimensions.width - parentObjDimensions.width; // + 2
			}							
						
			var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
			this.e = d.evalJSON()

			var tmp1 = aleatorio(1,9999)
			var tmp2 = aleatorio(10000,20000)
			var id = 'dependent-options-'+aleatorio(tmp1,tmp2)

			var ul = ''
			ul += '<div class="ulMenu" id="'+id+'">' 
			var f = Object.keys(this.e)
			f.each(function(g){
				 ul +=  '<div id="category-id-'+g+'" class="liMenu"> '+this.e[g]+'</div>'
			})
			ul += '</div>'
						
			$('menu').insert({
			  bottom: ul
			});					
				
			// se observa este nuevo elemento
			MenuClass.addObservers(id)
			// se actualisa el Path
			MenuClass.getPathOf(MenuClass.elementId)				
						
			$('ProductCategoryId').value = null						
			$('add-content').writeAttribute("disabled","disabled")
			
											
		}else{		
			
			currentElements = $('menu').childElementCount 
			currentWidth = currentElements * 251
			newWidth = currentWidth + 301
			
			$('menu').setStyle({
			  width: newWidth+'px'
			});
			
			a = $('menu')
			parentObjDimensions = a.parentElement.getDimensions()
			childObjDimensions = a.getDimensions()
			
			if(childObjDimensions.width >parentObjDimensions.width){				
				$('menu-box').scrollLeft = childObjDimensions.width - parentObjDimensions.width; // + 2				
			}		
			
			MenuClass.getPathOf(MenuClass.elementId)
		
			var ul = '<div id="category-selected" class="category-selected"><div><center><span class="category-selected-text">Categoria selecionada!</span> <br><img src="/img/ok.png" alt="Gracias" /></center></div></div>'
			$('menu').insert({
			  bottom: ul
			});
	
			// en este lugar se detecta que no hay mas categorias dependienetes. 
			// en este lugar se havilita el bonton 
			
			$('ProductCategoryId').value = v.last			
			$('add-content').writeAttribute("disabled",false)
			
		}					
	},
	getPathOf:function(id){
		
		var obj = {"pathOf":id}
		var action = '/categories/getPathOf'
		
		var config = { 
			method:'get',
			parameters:obj,
			insertion:'bottom',				
			onSuccess: this.updatePath
		}
		// Updater
		// Request	
		new Ajax.Request(action,config)		
		
	},
	updatePath:function(response){
		
		var c = response.responseText
		var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
		var e = d.evalJSON()

			var h = ''
			e.each(function(f){			
				h += '<span id="'+'path-category-id-'+f.id+'"> ➯ '+f.name+'</span>'		
			})
			$('path').update(h)
			$('path2').update(h)
			
			//path-category-id-
			//category-id-
			
			// link path 
			$('path').childElements().each(function(element){
				element.observe('click', function(event){
											
					str_replace = function(cadena, cambia_esto, por_esto){
						return cadena.split(cambia_esto).join(por_esto);
					}
					
					var fullElementId = str_replace(element.id,'path-','')   
					var parentElementId = $(fullElementId).parentElement.id 
					var elementId = str_replace(element.id,'path-category-id-','') 
														
					$(parentElementId).nextSiblings().each(function(element){ element.remove() })
					
					MenuClass.elementId = elementId
					MenuClass.getChildElements(elementId)
					
					// style
					a = $(fullElementId)
					parent = a.parentElement
					b = parent.childElements()
					b.each(function(element){ 
						if(element.hasClassName('li-selected')){
							element.removeClassName('li-selected');
						}
					})
					a.addClassName('li-selected');
									
				});
			})

	
	}	
		
});



var ProductClass = Class.create(MenuClass,{
	
	actions:function(){
		
		// cuando refresca la pagina se pierde la data - por que es un form ajax. 
		// el form queda, para cargar un nuevo producto
		// lo mejor es al detectar cambios en el form guardar 
		
		// esta logia sirve para cuando se va editar.		
		if($('ProductCategoryId').value){
			
			id = $('ProductCategoryId').value
			UpdateAllMenu.buildMenu(id)
						
			$('category-selector').setStyle({
				  display: 'none'
			});	
			$('add-product').setStyle({
				  display: 'block'
			});
		}else{		
			$('category-selector').setStyle({
				  display: 'block'
			});	
			$('add-product').setStyle({
				  display: 'none'
			});		
		}
			
		if($('add-content')){		
			$('add-content').observe('click', function(event){
							
				$('category-selector').setStyle({
				  display: 'none'
				});	
				$('add-product').setStyle({
				  display: 'block'
				});				
				
			})
		}	
		
		if($('edit-category')){		
			$('edit-category').observe('click', function(event){	
				
				
				
				$('category-selector').setStyle({
				  display: 'block'
				});	
				$('add-product').setStyle({
				  display: 'none'
				});			
						
				// si se envio el formulario o se recargo la pagina. - esto tiene sentido si el form no es ajax
				if(!$('category-selected')){				
					id = $('ProductCategoryId').value
					
					UpdateAllMenu.buildMenu(id)
					// fixed path,  este problema solo se precenta si el form es post y no ajax. 
					// en edit no debe ser un problema tambien
				
				}
				
				a = $('menu')
				parentObjDimensions = a.parentElement.getDimensions()
				childObjDimensions = a.getDimensions()
					
				if(childObjDimensions.width >parentObjDimensions.width){
					$('menu-box').scrollLeft = childObjDimensions.width - parentObjDimensions.width; // + 2
				}
			
			})
		}
	}
	
}) 

// UpdateAllMenu solo recive el id de la categoria selecionada o guardada en la base de datos y rescontruye todo el menu, 
// a diferencia de la otra clase que solo recive el id de una categoria  y contrulle parte por parte el menu 

UpdateAllMenu = Class.create(MenuClass,{
	buildMenu:function(id){
		
		MenuClass.getPathOf(id)
		
		var obj = {"id":id}
		var action = '/categories/buildMenu'
					
		var config = { 
			method:'get',
			parameters:obj,
			insertion:'bottom',				
			onSuccess: this.process
		}
		// Updater
		// Request	
		new Ajax.Request(action,config)		
	},
	process:function(response){
			
		var c = response.responseText
		var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
		var e = d.evalJSON()		
		
		function aleatorio(inferior,superior){ 
				numPosibilidades = superior - inferior 
				aleat = Math.random() * numPosibilidades 
				aleat = Math.round(aleat) 
				return parseInt(inferior) + aleat 
		}
			
		// desenglosar - observar
		e.each(function(f){
			
			var obj = f.children
			
			if(!obj.last){
					
					
				//debug('hay hijos')
				// los elementos que esten + 1					
				currentElements = $('menu').childElementCount 
				newCurrentElements = currentElements + 1 
				newWidth = newCurrentElements * 251
				
				$('menu').setStyle({
				  width: newWidth+'px'
				});			
					
				//var srollValue = $('menu-box').scrollLeft	
				a = $('menu')
				parentObjDimensions = a.parentElement.getDimensions()
				childObjDimensions = a.getDimensions()
				
				if(childObjDimensions.width >parentObjDimensions.width){
					$('menu-box').scrollLeft = childObjDimensions.width - parentObjDimensions.width; // + 2
				}							
							
				var tmp1 = aleatorio(1,9999)
				var tmp2 = aleatorio(10000,20000)
				var id = 'dependent-options-'+aleatorio(tmp1,tmp2)

				var ul = ''
				ul += '<div class="ulMenu" id="'+id+'">' 
				var cake = Object.keys(obj)
				cake.each(function(g){
					 ul +=  '<div id="category-id-'+g+'" class="liMenu"> '+obj[g]+'</div>'
				})
				ul += '</div>'
							
				$('menu').insert({
				  bottom: ul
				});					
					
				// se observa este nuevo elemento
				MenuClass.addObservers(id)
							
				//Selecionar
				composedId = 'category-id-'+f.id
				$(composedId).addClassName('li-selected');
							
			
			}else{
				
				//debug('no hay hijos')
				
				
				currentElements = $('menu').childElementCount 
				currentWidth = currentElements * 251
				newWidth = currentWidth + 301
				
				$('menu').setStyle({
				  width: newWidth+'px'
				});
				
				a = $('menu')
				parentObjDimensions = a.parentElement.getDimensions()
				childObjDimensions = a.getDimensions()
				
				if(childObjDimensions.width >parentObjDimensions.width){				
					$('menu-box').scrollLeft = childObjDimensions.width - parentObjDimensions.width; // + 2				
				}		
					
				var ul = '<div id="category-selected" class="category-selected"><div><center><span class="category-selected-text">Categoria selecionada!</span> <br><img src="/img/ok.png" alt="Gracias" /></center></div></div>'
				$('menu').insert({
				  bottom: ul
				});
		
				// en este lugar se detecta que no hay mas categorias dependienetes. 
				// en este lugar se havilita el bonton 
								
				//Selecionar
				composedId = 'category-id-'+f.id
				$(composedId).addClassName('li-selected');
				
				$('add-content').writeAttribute("disabled",false)
				
			}
			
		})
				
	}	
})


document.observe("dom:loaded", function(){


	// Vendedor 
	if($('default-options')){
		MenuClass = new MenuClass;
		MenuClass.addObservers('default-options');	
	}
	
	if($('category-selected') || $('category-selector')){
		UpdateAllMenu = new UpdateAllMenu;
	}
	
	if($('ProductCategoryId')){
		ProductClass = new ProductClass;
		ProductClass.actions()
		
	}


/*
	new Form.Element.Observer($('ProductCategoryId'),0.1, function(event){ 
			
		if($('ProductCategoryId').value){
			debug('actulizo path');
			debug($('ProductCategoryId').value);
		}
			
	})
			
*/
	
	
	
	
	/*
	//Parte administrativa
	if($('menu-container')){
		i = new CategoryController;	
		i.addObservers()		
	}	
	
	if($('mytree-standard')){		
					
		new	Axent.DragDropTree('mytree-standard',{
			
			afterDropNode: function(node,dropOnNode,point){
				var src = node.identify();
				var dst = (node.up('li') != undefined) ? node.up('li').identify() : '';
				var prv = (node.previous('li') != undefined) ? node.previous('li').identify() : '';
				
				debug('src: '+src)
				debug('dst: '+dst)
				debug('prv: '+prv)
				var obj = {"element":src,"parent":dst,"previous":prv}
				
				new Ajax.Request('/categories/editTree',{
					parameters:obj
				});			 
			}			
		});
	}
	
	*/
	

});
