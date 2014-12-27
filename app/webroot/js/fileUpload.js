var Forms = { CommonTasks : { View: { }, Add : { }, Edit : { }, Delete : { }, FileUpload : { } } };

Forms.CommonTasks.FileUpload = Class.create({

	// class	view-this-namespace
	// id		view-this-namespace-
	
	initialize:function(config_obj,callbacks){
		this.config_obj = config_obj;
		this.callbacks 	= callbacks;
		this.observe_this();		
	},
	observe_this:function(){
		
		/*
			Etapa 1
			insertar en el dom el elemento temporal.
				activar el indicador de carga
				cancelar la subida
				en caso de error
			insertar la imagen
			borrar la imagen
			confirmar los nuevos registros

			Etapa 2
			restringir el tipo de archivo.
		*/
		
		var config_obj 		= this.config_obj;
		var callbacks		= this.callbacks;
		var extendsFileList = this.extendsFileList; // para que ? 
 		
		config_obj.file_input_element_ids.each(function(file_input_element){
			$(file_input_element).observe('change',function(event){
				var element = event.element();
				var files 	= {};

				for(i=0; i < element.files.length; i++){
					//	files[i]= element.files[i];
					//	console.log(files);

					// start codigo casi identico: este codigo es en su mayoria el mismo para el evento soltar o drop 
					var form = new FormData();
					form.append("product_id", $('ProductId').value);
					form.append("image", element.files[i]);
					
					var xhr = new XMLHttpRequest();
					
					// Interface ProgressEvent																	Description							|	Times
					xhr.addEventListener("loadstart", 	callbacks.events.progressEvent.loadstart,	false);		//	Progress has begun. 				Once.
					xhr.addEventListener("progress", 	callbacks.events.progressEvent.progress, 	false); 	// 	In progress.						Zero or more.
					xhr.addEventListener("error", 		callbacks.events.progressEvent.error, 		false);   	// 	Progression failed.					Zero or more.		
					xhr.addEventListener("abort", 		callbacks.events.progressEvent.abort, 		false); 	// 	Progression is terminated.			Zero or more.	
					xhr.addEventListener("load", 		callbacks.events.progressEvent.load, 		false);  	// 	Progression is successful.			Zero or more.
					xhr.addEventListener("loadend", 	callbacks.events.progressEvent.loadend,		false);  	// 	Progress has stopped.				Once.
					
					xhr.open("post", "/imageAdd", true);
					xhr.send(form);
					// end codigo identico. 
					
				}
			
			});
		});
		
		
		if(config_obj.drop_element_id){
			var drop_element 	= $(config_obj.drop_element_id);
			
			drop_element.observe("dragover", function(event) {
				event.preventDefault();
				callbacks.events.dragover(); //-> callbacks
			});
			
			drop_element.observe("drop", function(event){
				event.preventDefault();
				callbacks.events.drop(); //-> callbacks
				
				var files = {};

				for(i=0; i < event.dataTransfer.files.length; i++){
					//files[i]= event.dataTransfer.files[i];
				
					// start codigo casi identico 
					var form = new FormData();
					form.append("product_id", $('ProductId').value);
					form.append("image", event.dataTransfer.files[i]);
					
					var xhr = new XMLHttpRequest();
					
					// Interface ProgressEvent																	Description							|	Times
					xhr.addEventListener("loadstart", 	callbacks.events.progressEvent.loadstart,	false);		//	Progress has begun. 				Once.
					xhr.addEventListener("progress", 	callbacks.events.progressEvent.progress, 	false); 	// 	In progress.						Zero or more.
					xhr.addEventListener("error", 		callbacks.events.progressEvent.error, 		false);   	// 	Progression failed.					Zero or more.		
					xhr.addEventListener("abort", 		callbacks.events.progressEvent.abort, 		false); 	// 	Progression is terminated.			Zero or more.	
					xhr.addEventListener("load", 		callbacks.events.progressEvent.load, 		false);  	// 	Progression is successful.			Zero or more.
					xhr.addEventListener("loadend", 	callbacks.events.progressEvent.loadend,		false);  	// 	Progress has stopped.				Once.
					
					xhr.open("post", "/imageAdd", true);
					xhr.send(form);
					// end codigo identico.
				
				}
				//console.log(files);
			});
		}
	}
});
