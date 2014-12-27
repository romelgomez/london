/* 
	Nota: No es necesario modificar el script
*/	
	
	var SelectorsController = Class.create({
		createObject: function(select,action){		

			// Get Address of data[Address][country_id]
			var currentModel = select.name.gsub(/^data\[(.*?)\]\[(.*?)\]/,'#{1}');

			str_replace = function(cadena, cambia_esto, por_esto) {
				return cadena.split(cambia_esto).join(por_esto);
			}
			var key = str_replace(select.id,currentModel,'')	
			var key2 = str_replace(key,'Id','')	
					
			var a = {}
			a[key2] = select.value
			a['currentModel'] = currentModel
	
			//debug(a)
			
			this.ajaxRequest(a,action)
			
		},
		ajaxRequest:function(obj,action){			
						
			var config = { 
					method:'get',
					parameters:obj,
					onComplete: this.getResponse
				}
			// Updater	
			// Request
			new Ajax.Request(action,config) 
		},
		getResponse:function(response){ 
			
			//debug(response)
			
			var c = response.responseText
			var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
			this.e = d.evalJSON()
			
			var f = Object.keys(this.e)
			f.each(function(currentModel){
				camelCaseTargetFields = Object.keys(this.e[currentModel])
				camelCaseTargetFields.each(function(targetField){
						
						//debug(currentModel)
						//debug(targetField)
						var g = $(currentModel+targetField)	
						//debug(g)
					
						var options = g.childElements()
						
						var estandar = options[0]
						
						options.each(function(optionElement){
							optionElement.remove()
						})
						
						objectKeys = Object.keys(this.e[currentModel][targetField])
						
						opciones =''
						objectKeys.each(function(k){
							opciones +='<option value="'+k+'">'+this.e[currentModel][targetField][k]+'</option>'
						})
											
						g.insert(opciones);	
						
						g.insert({
							top:	estandar
						});
						
						var optionsLength = g.childElements()
												
						if(optionsLength.length > 1){
							
							g.disabled = false
							elemento = optionsLength.first() 	
							elemento.selected = 'selected'
						
						}else{
							g.disabled = true
						}
							
				})
			})
		}	
	})


	var i = new SelectorsController();


document.observe("dom:loaded", function() {

	var Selects = $$('#selectores-dependientes select') 
	
	Selects.each(function(element){	
			element.observe('change',function(event){				
				
				var element = event.element();
				
				i.createObject(element,'/selectAjaxRequest')		
			
			})		
	})

});






