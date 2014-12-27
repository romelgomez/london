var ImageController = Class.create({

	addInput:function(){
		var elements = $$('#add-image input')
		var name = elements.last().name
		var num = name.gsub(/^data\[(.*?)\]\[(.*?)\]/,'#{2}');
		var a = parseInt(num)
		var newInputInt = a+1
		
		newInput = '<div class="input file"><label for="addStoreImage'+newInputInt+'">'+newInputInt+') </label><input type="file" name="data[addStoreImage]['+newInputInt+']" id="addStoreImage'+newInputInt+'"></div>'
		
		$('add-image').insert({
			bottom: newInput
		});
	}	
	
	
})

var imagen = new ImageController();

document.observe("dom:loaded", function() {
	
	if($('add-input-image-button')){
		var element = $('add-input-image-button') 
		
		element.observe('click',function(event){
					imagen.addInput()
		})
	}

});
