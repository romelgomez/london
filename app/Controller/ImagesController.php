<?php 

App::import('Vendor','ObjetivoPhpImagen');
class ImagesController extends AppController{
	
	public $uses		= array();
	public $components	= array('Upload');
	
	public function beforeFilter(){
			
		$this->Auth->allow('imageProduct','customImg');
			
		parent::beforeFilter();				
	
	}
	
	
	public function index(){
		//...
	}
	public function add(){
		$request = $this->request;

		//print_r($request);
		
		$destination = WWW_ROOT."img/uploads/products/";
				
		$file = $this->request->params['form']['image'];

		if($file['name']){
			$this->Upload->upload($file, $destination); // al parecer el orde de subida influye, esta linea si va de primera las demas subidas no se ejecutan.
			$image_name = $this->Upload->result;
		}
	
		$imagen	 = array(
			'Image' => Array
				(
					'product_id' => $this->request->data['product_id'],
					'name' => $image_name,
					'deleted' => 1,
				)
		);									
		
		if($this->Image->save($imagen,false)){
			$return['imagen_id'] = $this->Image->id;
		};
		
		// creo una -imagen para ver- de la imagen recien cargada
		$return['imagen_tmp'] = $this->customImg(200,150,2,$image_name);
		
		$this->set('return',$return);
		$this->render('ajax-view','ajax');
		
		
	}
	
	public function updateImageData(){
		$request = $this->request;
		// debug($request);
		$product_id = $this->request->data['product_id'];
		
		if(isset($this->request->data['image_id'])){
			// luego de que la imagen esta en el carrusel y es preciso eliminarla. 
			
			$image_id = $this->request->data['image_id'];
			
			$image = $this->Image->find('first', array(
				'conditions' => array('Image.id'=>$image_id,'Image.product_id'=>$product_id)
			));
			
			if($image){
				$image['Image']['deleted'] = 1;
				if($this->Image->save($image)) {
					// handle the success.
				}
			}
			
			$return = null;
			
		}else{
			// imagenes aprobadas, introduciendoce en el carrusel. 
			$images_ids = unserialize($this->request->data['images_ids']);		
			
			// verificar y actualizar los registros.
			foreach($images_ids as $k=>$image_id){
				$image = $this->Image->find('first', array(
					'conditions' => array('Image.id' => $image_id,'Image.product_id'=>$product_id)
				));	
				if($image){
					$image['Image']['deleted'] = 0;
					$return[$k]['id']						= $image['Image']['id'];
					$return[$k]['name'] 					= $image['Image']['name'];
					$return[$k]['thumbnail_of_200x200px']	= $this->customImg(200,200,2,$image['Image']['name']);
					
					if ($this->Image->save($image)) {
						// handle the success.
					}
				}
			}
		}
		
		$this->set('return',$return);
		$this->render('ajax-view','ajax');		
	}
	
	public function imageProduct($anchoDestino=null,$altoDestino=null,$modo=null,$imagen=null){
		//$this->response->header(array('Content-type: image/jpeg'));
		$this->response->type('jpg');
		
		$img = $this->customImg($anchoDestino,$altoDestino,$modo,$imagen);
				
		$this->viewClass = 'Media';
        $params = array(
            'id'        => $img,
            'download'  => false,
            'extension' => 'jpg',
            'path'      => 'img/uploads/images-tmp/',
            'cache'		=> true
        );
        $this->set($params);
	}
	
	
	public function customImg($anchoDestino=null,$altoDestino=null,$modo=null,$imagen=null){
				
		// EXISTEN DOS MANERAS DE LLAMAR A LA FUNCION 
		// UNA SOLICITUD HTTP
		// DESDE OTRA FUNCION 
				
		// GOOGLE ACCEDE DIRETAMENTA A LA FUNCION HTTP -				
				
		// si existe la imagen en /img_tmp se envia.
		// de no, se crear y se envia.
		
		#################################################################################
		# EXPLICACION DE MODOS															#
		#################################################################################
		/**
		 * La clase consta de 4 Modos del 0 al 3.
		 * (Escala = ancho /alto)
		 * Modo 0:	Respeta la Proporcionalidad (Escala) de la imagen y toma como base el ancho.
		 * Modo 1: 	Respeta la Proporcionalidad de la imagen y toma como base el alto.
		 * Modo 2: 	Respeta el ancho y alto indicado, asi como la proporcionalidad pero recortando la imagen.
		 * Modo 3: 	Re-escala la imagen a el alto y ancho indicado, no manteniendo la proporcionalidad si las escalas
		 * 		    de origen y destino no coinciden.
		*/

		// test http://www.imagen.com:8080/customImg/gcwp_ver02_1920x12006.jpg/500/500/2
		
		// http://www.imagen.com:8080/customImg/a0.jpg/500/500/2
		
		// ajax
		//debug($this->request);
		
		// ajax
		/*
		if($this->request->query){
			$request		= $this->request->query;
			
			$imagen			=	$request['imagen'];
			$anchoDestino	=	$request['anchoDestino'];
			$altoDestino	=	$request['altoDestino'];
			$modo			=	$request['modo'];
		}
		*/	
		// end ajax
		
		$sourcePath =	'img/uploads/products/'; 
		$targetPath =	'img/uploads/images-tmp/';
				
		$pathinfo = pathinfo($imagen);
        $filename = $pathinfo['filename'];
        $ext = $pathinfo['extension'];
		
		$replaceOldFile = false;
		
		// se coloca en minusculas.
        $filename = strtolower($filename);
        
        // se elimina los espacios en blanco al pricipio y al final.
        $filename = trim($filename); 
        
        // se elminia los espacios en blanco dentro de la cadena o nombre del archivo
		$filename = str_replace(array(' ',':','-'),'_',$filename);	
		
		// no sobre-escribe un archivo        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            $i = 0;
            while (file_exists($targetPath . $filename . $i . '.' . $ext)) {
				$i++; 
            }
            $filename.=$i;
        }
		
		$destino = $filename.'.'.$ext;
		
		// mejora, de set a un array. - luego no importara el orden en que se definan 
		
		$obj_img	= new Imagen();
		$obj_img	->set("sourcePath",$sourcePath);
		$obj_img	->set("targetPath",$targetPath);
		$obj_img	->set("imagenOrigen",$imagen);
		$obj_img	->set("imagenDestino",$destino);
		$obj_img	->set("sourcePath",$sourcePath);
		$obj_img	->set("targetPath",$targetPath);
		$obj_img	->set("anchoDestino",$anchoDestino);
		$obj_img	->set("altoDestino",$altoDestino);
		$obj_img	->set("recorte",array('filas'=> 3,'columnas'=> 3,'centrado'=>4));
		$obj_img	->set("calidadImagen",100);
		$obj_img	->set("generarArchivo",true); // true genera un archivo en el servidor False la envia para descargar en este caso no se puede enviar nada al servidor).
		$obj_img	->set("modo",$modo);
			
		$obj_img	->procesarImagen();
		
		$return		=	$obj_img->get("resultado");
		
		//debug($return);
		
		return $return;
		
		
		
		//$this->set('return',$return);
		//$this->render('add','ajax');
	}
	
	// 99999999999999999999999999999999999999999999999999999999999999999999999999999>  prototypos 
	
	function deleteImage($name){
		// en este metodo no se eliminan imagenes, solo se cambia el estado de la imagen a eleminada.
		if($this->Auth->User()){			
					
				$imagen = $this->Image->findByName($name);
				if($imagen){
					
					if($this->userLogged['User']['company_id']!=$imagen['Product']['company_id']){
							// si es verdad - el usuario esta intentando borrar la imagen de otro usuario.
							$this->redirect('/edit');	
					}else{
						
						if($imagen['Image']['parent_id']){
							$imagenes = $this->Image->findAllByParentId($imagen['Image']['parent_id']);
							$imagenCompleta = $this->Image->findById($imagen['Image']['parent_id']);
							array_push($imagenes,$imagenCompleta);
							
							foreach($imagenes as $key => $values){
								 $values['Image']['deleted'] = 1;
								 $registrosModificados[] = $values;
							}
							
							$this->Image->saveAll($registrosModificados);
							
							//debug($registrosModificados);
							$this->redirect('/editProduct/'.$imagen['Product']['id']);
						}
					
					}
				}
		}
		
	}
	
	
	
}?>
