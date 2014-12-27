	var UserInterface = { Lightbox : { } };

	UserInterface.Lightbox = Class.create({
		
		initialize: function(obj,callback){
			
			this.white_content_id 	= obj.white_content_id;
			this.black_overlay_id 	= obj.black_overlay_id;
			this.black_overlay_end 	= obj.black_overlay_end;
			this.start_class 		= obj.start_class;
			this.end_class 			= obj.end_class;			
			
			this.callback 			= callback;
			
			this.start();
			this.end(this.black_overlay_end);
		
		},
		start: function(){			
			
			var white_content_id		= this.white_content_id;
			var black_overlay_id		= this.black_overlay_id;
			var start_class 			= this.start_class;
			var callback 				= this.callback;
			
			$$('.'+start_class).each(function(element){
				element.observe('click',function(event){				
					event.preventDefault();
					callback.start()
					
					$(white_content_id,black_overlay_id).each(function(element){
						element.appear();
					})
					
				})
			})
			
		},
		end: function(black_overlay_end){
			var white_content_id 		= this.white_content_id;
			var black_overlay_id 		= this.black_overlay_id;			
			var end_class 				= this.end_class;
			var callback 				= this.callback;
			
			
			if(black_overlay_end){
				$$('.'+end_class,'#'+black_overlay_id).each(function(element){
					element.observe('click',function(event){				
						event.preventDefault();
						callback.end(event.element());
						
						$(white_content_id,black_overlay_id).each(function(element){
							element.fade();
						})
						
					})
				});
			}else{
				$$('.'+end_class).each(function(element){
					element.observe('click',function(event){				
						event.preventDefault();
						callback.end(event.element());
						
						$(white_content_id,black_overlay_id).each(function(element){
							element.fade();
						})
						
					})
				});
			}
		
		}
		
	});		
