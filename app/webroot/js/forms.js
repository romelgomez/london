	// en la vista echo  $this->Html->script('nombre',False);  permite llamar un script para una vista.
	/*
		acciones	
		si el producto no ha sido publicado:
			publicar producto - si es verdadero redireciona a list product	
			guardar borrador - guarda la data que este para el momento, si no existe nada, igual guarda. 
			descartar
			
				INGLES
				id - funcion
				publish - publishProduct
				save-now - saveDraft 	
				discard - discard
				
		si el producto ha sido publicado - esta vista es editar
			pausar publicación vs activar publicación 
			actualizar
		
				INGLES
				id - funcion
				pause - pausePublication - estos botones seran movidos productos publicados.
				activate - activatePublication - estos botones seran movidos productos publicados. 
				update - update - se valida - 
		
		al llamar addNew puede suceder que hay campos requerido o  no. 
		
			de haber campos requeridos
				se envia un objeto que indica culaes son y su mesaje
			de no haber
				se guarda y se no se envia nada
					se detecta que es null por lo tanto todo a trancurrido con exito, se envia el mesaje flash y luego se redireciona. 
					* 
			
			añadir una publicación nueva - se valida
			activar una publicación pausada - se valida
			
			actualizar una publicación activa - se valida
			actualizar una publicación pausada - se valida
			* una publicación pausada sigues estando disponible en el buscador, solo que no es ofertable. esta disponible como referencia al cliente y este se comunique 
			
			
			guardar un borrador - no se valida
	*/

var ProductFormTasksClass = { Publish:{ AddNew: {}, SaveDraft: {}, Discard: {}}, Update:{ Change: {}, Pause: {}, Activate: {}, Delete: {} }};

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

ProductFormTasksClass.Publish.AddNew 	= Class.create({
	initialize:	function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks	= callbacks;
		this.add_new();
	
	},
	add_new: function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		
		$('publish').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false)	
		});
	}
});

ProductFormTasksClass.Publish.SaveDraft	= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.save_draft();		
	},
	save_draft:function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		 
		$('save-now').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false);	
		});
		
	},
	save_draft_request:function(){
	// para ser llamda desde la instancia. 	
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		new AjaxRequest(config_obj,callbacks,false);
	}
});
ProductFormTasksClass.Publish.Discard	= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.discard();		
	},
	discard:function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		
		$('discard').observe('click',function(){
			
			if($('ProductId').value){
				// 	borrar el borrador 
				var obj = {"id":$('ProductId').value}
			}else{
				//Set flash
				var obj = {"id":false}
			}
			
			new AjaxRequest(config_obj,callbacks,obj)	
		
		});
	}
});

ProductFormTasksClass.Update.Change		= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.change();		
	},
	change:function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		 
		$('update').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false)	
		});
	}
});

ProductFormTasksClass.Update.Pause		= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.pause();		
	},
	pause:function(){
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		$('pause').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false)
		});
		
	}
});

ProductFormTasksClass.Update.Activate		= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.activate();		
	},
	activate:function(){
		
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		$('activate').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false)
		}); 
		
	}
});

ProductFormTasksClass.Update.Delete		= Class.create({
	initialize: function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks = callbacks;
		this.delete_config();		
	},
	delete_config:function(){
		
		var config_obj	= this.config_obj;
		var callbacks	= this.callbacks;
		$('delete').observe('click',function(){
			new AjaxRequest(config_obj,callbacks,false)
		}); 
		
	}
});


var config_obj = {
	"publish":{
		"add_new": {
			"action":"/addNew",
			"obj":{"id":"ProductId","category_id":"ProductCategoryId","title":"ProductTitle","body":"ProductBody","price":"ProductPrice","quantity":"ProductQuantity"},
			"console_log":true,
		}, 
		"save_draft": {
			"action":"/saveDraft",
			"obj":{"id":"ProductId","category_id":"ProductCategoryId","title":"ProductTitle","body":"ProductBody","price":"ProductPrice","quantity":"ProductQuantity"},
			"console_log":true,
		}, 
		"discard": {
			"action":"/discard",
			"console_log":true,
		}
	}, 
	"update":{ 
		"change": {
			"action":"/update",
			"obj":{"id":"ProductId","category_id":"ProductCategoryId","title":"ProductTitle","body":"ProductBody","price":"ProductPrice","quantity":"ProductQuantity"},
			"console_log":true,
		}, 
		"pause": {
			"action":"/pause",
			"obj":{"id":"ProductId"},
			"console_log":true,	
		},
		"activate": {
			"action":"/activate",
			"obj":{"id":"ProductId"},
			"console_log":true,
		}, 
		"_delete": {
			"action":"/delete",
			"obj":{"id":"ProductId"},
			"console_log":true,
		}
	}
};
		

var callbacks = {
	"publish":{
		"add_new": {
			"onSuccess":function(response){
				
				console.log(response);
				
				var c = response.responseText
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'')
				var e = d.evalJSON()
						
				if(!e.result){
					// hay detalles
					
					// campos
					var f = Object.keys(e)
					f.each(function(elementId){				
						//debug($(elementId))
						if(elementId != 'missing_pictures'){
							$(elementId).addClassName('requiredInput');
							$(elementId).observe('click',function(){
								this.removeClassName('requiredInput'); 
							});
							$(elementId).observe('focus',function(){
								this.removeClassName('requiredInput'); 
							});
						}else{
							var missing_pictures = elementId;
							if(e[missing_pictures]){
								
								/*
								$('start-upload').setStyle({
									backgroundColor: '#FFD1D1',
									border: '1px solid red'
								});
								*/
								$('start-upload').setStyle({
									backgroundColor: '#FFD1D1',
									border: '1px solid red'
								});
								$('start-upload').observe('click',function(){
									this.setStyle({
										backgroundColor: 'white',
										border: '1px solid gray'
									});
								});
								$('start-upload').observe('focus',function(){
									this.setStyle({
										backgroundColor: 'white',
										border: '1px solid gray'
									}); 
								});								
														
							}
						}
					});
					
				}else{
					// todo ok
					// se redirecciona	
					window.location = "/list_products"
				}
			}
		}, 
		"save_draft": {
			"onSuccess":function(response){	
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				//debug(e)
						
				if(e.id){
					$('ProductId').value = e.id;
					$('debugTime').setStyle({
						display: 'block'
					});
					$('lastTimeSave').innerText = e.time

					// elapsedTime
					if(this.pan){
						clear = true
					}else{
						clear = false
					}
					this.pan = TimeClass.elapsedTime('minutesElapsed',60,clear)
					// se prende
					// se apaga y luego se prende
					// se apaga y luego se prende
					// end elapsedTime
				}
			}
		}, 
		"discard": {
			"onSuccess":function(response){
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				
				//debug(e);
				if(e.success){
					window.location = "/list_drafts"			
				}else{
					window.location = "/list_drafts"
				}
			}	
		}
	}, 
	"update":{ 
		"change": {
			"onSuccess":function(response){
				
				
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				
				
				// debug(e)
				if(!e.result){
			
					// campos
					var f = Object.keys(e)
					f.each(function(elementId){				
						//debug($(elementId))
						if(elementId != 'missing_pictures'){
							$(elementId).addClassName('requiredInput');
							$(elementId).observe('click',function(){
								this.removeClassName('requiredInput'); 
							});
							$(elementId).observe('focus',function(){
								this.removeClassName('requiredInput'); 
							});
						}else{
							var missing_pictures = elementId;
							if(e[missing_pictures]){
								
								$('start-upload').setStyle({
									backgroundColor: '#FFD1D1',
									border: '1px solid red'
								});
								$('start-upload').observe('click',function(){
									this.setStyle({
										backgroundColor: 'white',
										border: '1px solid gray'
									});
								});
								$('start-upload').observe('focus',function(){
									this.setStyle({
										backgroundColor: 'white',
										border: '1px solid gray'
									}); 
								});								
														
							}
						}
					});
			
					
				}else{
					if(e.result == 'ok'){
						//debug('ok')
						
						$('debugTime').setStyle({
							display: 'block'
						});
						$('lastTimeSave').innerText = e.time

						// elapsedTime
						if(this.pan){
							clear = true
						}else{
							clear = false
						}
						this.pan = TimeClass.elapsedTime('minutesElapsed',60,clear)
						
					}else{
						window.location = "/list_products"
					}
				}
				
				
				
			}
		},
		"pause": {
			"onSuccess":function(response){
				
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				
				if(e.result){
					$('pause_container').setStyle({
					  display: 'none'
					}); 
					$('activate_container').setStyle({
					  display: 'inline'
					});
				}
				
			}
		},
		"activate": {
			"onSuccess":function(response){
				
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				
				if(e.result){
					$('pause_container').setStyle({
					  display: 'inline'
					}); 
					$('activate_container').setStyle({
					  display: 'none'
					});
				}
			
			}
		},
		"_delete": {
			"onSuccess":function(response){
				console.log(response);
				var c = response.responseText;
				var d = c.replace(/^\s+/g,'').replace(/\s+$/g,'');
				var e = d.evalJSON();
				
				if(e.result){
					window.location = "/list_products"
				}			
			
			}
		} 
	}
}



var TimeClass = Class.create({
	elapsedTime:function(elementId,everyInSeconds,clear){		
		$(elementId).innerText = 0;
		
		if(clear){ elapsedTime.stop() }
				
		var elapsedTime = new PeriodicalExecuter(function(a){
			var tmp =  $(elementId).innerText;
			tmp = parseInt(tmp);
			$(elementId).innerText = tmp+1;	
		},everyInSeconds)
		
		return true
	}
})

TimeClass = new TimeClass;

document.onkeydown = function(event){
	e = event;

	if($('add-product')){
		if($('add-product').getStyle('display') == 'block'){
			if ((e.ctrlKey && e.keyCode == 'S'.charCodeAt(0))) {
				event.preventDefault();
				ProductFormsClass.saveDraft()
			
			}	
			if ((e.ctrlKey && e.keyCode == 'G'.charCodeAt(0))) {
				event.preventDefault();
				ProductFormsClass.saveDraft()
			
			}	
		}
	}	

}

document.observe("dom:loaded", function(){

	if($('publish')){
		new ProductFormTasksClass.Publish.AddNew	(config_obj.publish.add_new,	callbacks.publish.add_new);
		new ProductFormTasksClass.Publish.Discard	(config_obj.publish.discard,	callbacks.publish.discard);
		
		SaveDraft = new ProductFormTasksClass.Publish.SaveDraft	(config_obj.publish.save_draft,	callbacks.publish.save_draft);
	
	}
	if($('update')){
		new ProductFormTasksClass.Update.Change		(config_obj.update.change,		callbacks.update.change);
		new ProductFormTasksClass.Update.Pause		(config_obj.update.pause,		callbacks.update.pause);
		new ProductFormTasksClass.Update.Activate	(config_obj.update.activate,	callbacks.update.activate);
		new ProductFormTasksClass.Update.Delete		(config_obj.update._delete,		callbacks.update._delete);
	}

});
