<?php
class ProductsController extends AppController {

	public $name = 'Products';
	public function beforeFilter(){
		$this->Auth->allow('view');
		parent::beforeFilter();
	}

	public function view($slug = null, $id = null){
		if(isset($id)){
			$productConditions = array(
				'conditions' => array('Product.id' => $id),
				'contain' => array(
					'Category',
					'Company',
					'Image' => array(
						'conditions' => array('Image.deleted' => 0)
					)
				)
			);
			
			$product	= $this->Product->find('first',$productConditions);
			if($product){
				
				$this->loadModel('Message');
				$messagesConditions  = array(
					'conditions' => array('Message.product_id'=>$id,'Message.deleted' => 0),
					'order'=> array('Message.created'=>'DESC'),
					'contain' => array()
				);
				
				$messages	= $this->Message->find('all',$messagesConditions);
				
				$this->set(compact('product','messages'));
			
			}else{
				$this->redirect('/');
			}
		
		}else{
			$this->redirect('/');
		}
	}
	
	//ajax
	public function discard(){
		if($this->Auth->User()){
			$request = $this->request->query;
			
			if($request['id']!='false'){
			
				$isOk = $this->Product->find('first', array(
					'conditions' => array('Product.id' => $request['id'],'Product.company_id'=>$this->userLogged['User']['company_id'])
				));
				
				if($isOk){
					$id = $request['id'];
					
					$productData['Product']['id'] = $id;
					$productData['Product']['deleted'] = 1;
										
					if($this->Product->save($productData)){
						$return['success'] = true;
						$this->Session->setFlash('El borrador ha sido descartado','success');
					}
				}else{
					// esta intentando borrar un posts de otra compañia.
					$return['success'] = false;
					$this->Session->setFlash('Ha ocurrido un error.','failure');
				}
				
			}else{
				
				// cuando no existe un registro y se descarga
				$return['success'] = true;
				$this->Session->setFlash('El borrador ha sido descartado.','success');
			}
			
			$this->set('return',$return);
			$this->render('discard','ajax');
		}
	}



	//ajax - no valido la data-en cosecuensia-no envio errores- el producto tiene un status 0 - se supone que es un borrador. 
 	public function saveDraft(){
		if($this->Auth->User()){
			$request = $this->request->query;
		
			// start
			// esta logica es cuando se guardo un borrador, por lo tanto existe un id ya definido.
			// se verifica que el usuario este trabajando en un post suyo o de otro vendedor de misma compañia
			// de no cumplir o intentar modificar el dom, el script creara otro borrador.
			if($request['id']){
				$isOk = $this->Product->find('first', array(
					'conditions' => array('Product.id' => $request['id'],'Product.company_id'=>$this->userLogged['User']['company_id'])
				));
				if($isOk){
					$id = $request['id'];
				}else{
					$id = null; 
					// esta intentando modificar un posts de otra compañia.
				}
			}else{
				$id = null; 
			}
			// end
											
			$producto =	array(
				'Product'=>Array
					(	
						'id'=>$id,						
						'company_id'=>$this->userLogged['User']['company_id'],
						'user_id'=>$this->userLogged['User']['id'],
						'department_id'=>1,
						'category_id'=>$request['category_id'],
						'title'=>$request['title'],
						'body'=>$request['body'],
						'price'=>$request['price'],
						'quantity'=>$request['quantity'],
						'condition'=>1,
						'status'=>0,
						'deleted'=>0
					)
			);

			if($this->Product->save($producto,false)){
				$productData = $this->Product->read();
				
				$id = $productData['Product']['id'];
				$lastSave = $productData['Product']['modified'];
				
				$return['id'] = $id;
				
				// 2.1
				App::uses('CakeTime', 'Utility');
				$return['time'] = CakeTime::format('H:i',$lastSave);
				
				$this->set('return',$return);
			}
						
			$this->render('saveDraft','ajax');	
		}
	}
	
	
	// Ajax
	public function addNew(){
		if($this->Auth->User()){
			
			$request = $this->request->query;
			
			// al guardar un borrador o intentar subir una imagen se define el id del producto.
			
			// print_r($request);
			/*
			Array
			(
				[id] => 214
				[category_id] => 18
				[title] => borrador 2
				[body] => 
				[price] => 100
				[quantity] => 100
			)
			
			intentar publicar,  sin guardar un borrador o intentar subir una imagen ,  
			Array
			(
				[id] => 
				[category_id] => 19
				[title] => 
				[body] => 
				[price] => 
				[quantity] => 
			)

			*/
			
			//$this->loadModel('User');
			// missing_pictures
			
			$this->loadModel('Image');
			if($request['id']){
				
			//print_r($request);	
				
			// se guardo un borrador o se intento cargar una imagen, es decir product_id esta definido
				// se determina si hay imgenes cargadas-activadas.
				if($this->Image->find('first',array('conditions' => array('Image.product_id' => $request['id'],'Image.deleted' => 0)))){
				// si hay imgenes
					// se envia que no faltan imagenes, al menos existe una.
					$return['missing_pictures'] = false; 
					
					// se valida los campos del formulario
					$this->Product->set($request);
					if($this->Product->validates()){
						
						// start
						// esta logica es cuando se guardo un borrador, por lo tanto existe un id ya definido.
						// la data ya fue validada. 
						// se verifica que el usuario este trabajando en un post suyo o de otro vendedor de misma compañia
						// de no cumplir o intentar modificar el dom, el script creara una nueva publiación.
						if($request['id']){
							$isOk = $this->Product->find('first', array(
								'conditions' => array('Product.id' => $request['id'],'Product.company_id'=>$this->userLogged['User']['company_id'])
							));
							
							if($isOk){
								$id = $request['id'];
							}else{
								$id = null; 
								// esta intentando modificar un posts de otra compañia.
							}
						}else{
							$id = null; 
						}
						// end
						
						$producto =	array(
							'Product'=>Array
							(
								'id'=>$id,							
								'company_id'=>$this->userLogged['User']['company_id'],
								'user_id'=>$this->userLogged['User']['id'],
								'department_id'=>1,
								'category_id'=>$request['category_id'],
								'title'=>$request['title'],
								'body'=>$request['body'],
								'price'=>$request['price'],
								'quantity'=>$request['quantity'],
								'condition'=>1,
								'status'=>1,
								'deleted'=>0
							)
						);

						// se guarda y se envia ok
						if($this->Product->save($producto)){
							$return['result'] = 'ok';
							$this->Session->setFlash('Publicado con exito!','add_new_ok');
						}
						
						
					}else{
						// se envia los campos faltantes.
						// didn't validate logic
						$errors = $this->Product->validationErrors;
						foreach($errors as $k=>$v){
							$tmp = 'product_'.$k;
							$return[Inflector::camelize($tmp)] = $v[0]; // {"ProductBody":"Describe el producto"}
						}				
					}
				}else{
				// no hay imgenes
					// se envia que faltan la imagenes
					$return['missing_pictures'] = true;
					
					// se valida los campos del formulario		
					$this->Product->set($request);
					if($this->Product->validates()){
						// no se hace nada
					}else{
						// se envia los campos faltantes.
						// didn't validate logic
						$errors = $this->Product->validationErrors;
						foreach($errors as $k=>$v){
							$tmp = 'product_'.$k;
							$return[Inflector::camelize($tmp)] = $v[0]; // {"ProductBody":"Describe el producto"}
						}				
					}
				
				}
			}else{
			// 	sin guardar un borrador o intentar subir una imagen, product_id no esta definido.
				// se envia que faltan la imagenes
				$return['missing_pictures'] = true;
					
				// se valida los campos del formulario		
				$this->Product->set($request);
				if($this->Product->validates()){
					// no se hace nada
				}else{
					// se envia los campos faltantes.
					// didn't validate logic
					$errors = $this->Product->validationErrors;
					foreach($errors as $k=>$v){
						$tmp = 'product_'.$k;
						$return[Inflector::camelize($tmp)] = $v[0]; // {"ProductBody":"Describe el producto"}
					}				
				}
				//print_r($return);
			}
			
			$this->set('return',$return);
			
			
			$this->render('addNew','ajax');
		}
	}
	
	
	// Ajax
	public function change(){
		if($this->Auth->User()){
			
			$request = $this->request->query;

			# chequeando que el formulario no ha sido corrompido.
			$productData = $this->Product->find('first', array(
				'conditions' => array('Product.id' => $request['id'],'Product.company_id' => $this->userLogged['User']['company_id'])
			));
			if($productData){
			//El formulario no ha sido corrompido.	
				
				// se determina si hay imgenes cargadas-activadas.
				$this->loadModel('Image');
				if($this->Image->find('first',array('conditions' => array('Image.product_id' => $request['id'],'Image.deleted' => 0)))){
				// si hay imgenes
					// se envia que no faltan imagenes, al menos existe una.
					$return['missing_pictures'] = false; 
					
					// se valida los campos del formulario
					$this->Product->set($request);
					if($this->Product->validates()){
						// se guarda y se envia ok
						if($this->Product->save($request)){
							
							$productData = $this->Product->read();
							$lastSave = $productData['Product']['modified'];
							
							// A partir de 2.1 Cakephp
							App::uses('CakeTime', 'Utility');
							$return['time'] = CakeTime::format('H:i',$lastSave);
							
							$return['result'] = 'ok'; // existe cuando, hay imagenes cargadas-ativadas y la data del formulario esta completamente validada.
						
						}
						
					}else{
						// se envia los campos faltantes.
						$errors = $this->Product->validationErrors;
						foreach($errors as $k=>$v){
							$tmp = 'product_'.$k;
							$return[Inflector::camelize($tmp)] = $v[0]; // {"ProductBody":"Describe el producto"}
						}				
					}
				}else{
				// no hay imgenes
					// se envia que faltan la imagenes
					$return['missing_pictures'] = true;
					
					// se valida los campos del formulario		
					$this->Product->set($request);
					if($this->Product->validates()){
						// no se hace nada
					}else{
						// se envia los campos faltantes.
						// didn't validate logic
						$errors = $this->Product->validationErrors;
						foreach($errors as $k=>$v){
							$tmp = 'product_'.$k;
							$return[Inflector::camelize($tmp)] = $v[0]; // {"ProductBody":"Describe el producto"}
						}				
					}
				
				}
			}else{
			// El formulario ha sido corrompido
				// redirect
				$return['result'] = 'redirect';  // existe cuando el formulario ha sido corropido.
			}
			
			$this->set('return',$return);
			$this->render('addNew','ajax');
		}
	}
	
	public function pause(){
		if($this->Auth->User()){
			$request = $this->request->query;
	
			$productData = $this->Product->find('first', array(
				'conditions' => array('Product.id' => $request['id'],'Product.company_id' => $this->userLogged['User']['company_id'])
			));
			if($productData){
			//El formulario no ha sido corrompido.
				
				$data['Product']['id'] 		= $productData['Product']['id'];
				$data['Product']['status']	= 0;
				
				if($this->Product->save($data)){
					$return['result'] = 'ok';	
					$return['status'] = 0;	
				};
			
			}else{
				$return['result'] = 'redirect';
			}
	
			$this->set('return',$return);
			$this->render('addNew','ajax');
		}
	}
	public function activate(){
		if($this->Auth->User()){
			$request = $this->request->query;
	
			$productData = $this->Product->find('first', array(
				'conditions' => array('Product.id' => $request['id'],'Product.company_id' => $this->userLogged['User']['company_id'])
			));
			if($productData){
			//El formulario no ha sido corrompido.
				
				$data['Product']['id'] 		= $productData['Product']['id'];
				$data['Product']['status']	= 1;
				
				if($this->Product->save($data)){
					$return['result'] = 'ok';	
					$return['status'] = 1;
				};
			
			}else{
				$return['result'] = 'redirect';
			}
	
			$this->set('return',$return);
			$this->render('addNew','ajax');
		}
	}


	public function add($id=null){
		if($this->Auth->User()){
			
			// newProduct - id no esta definida.
			if($id){
				$productData = $this->Product->find('first', array(
					'conditions' => array('Product.id' => $id,'Product.company_id'=>$this->userLogged['User']['company_id'])
				));	
				if($productData){
					$this->request->data = $productData;
					//debug($this->request->data);
				}else{
				// el usuario esta jugando con la url.
					$urlAction = strstr($this->request->url, '/', true); // Desde PHP 5.3.0
					
					// edit
					if($urlAction =='edit'){
						// se redirecciona a /listProducts
						$this->redirect('/list_products');
					}
					// editDraft
					if($urlAction =='editDraft'){
						$this->redirect('/list_drafts');
					}
					
				}
			}
			$this->setCategoryMenu();		
		}
	}

/*
	// es obsoleta, la logica se inserta en la funcion add.
	public function edit($id=null){
		if($this->Auth->User()){
			$productData = $this->Product->find('first', array(
				'conditions' => array('Product.id' => $id,'Product.company_id' => $this->userLogged['User']['company_id'])
			));
			if($productData){
				$this->request->data = $productData;
			}else{
				$this->redirect('/listProducts');
			}
			$this->setCategoryMenu();
		}
	}
*/


	public function setCategoryMenu(){
	
			$this->loadModel('Category');
			$namespaces = $this->Category->find('all', array(
				'conditions' => array('Category.parent_id'=>null),
				'order' => 'lft ASC'
			));
			
			$this->set('namespaces',$namespaces);	 
		
	}





	############## edit y listProduct es una simple paginacion.
	// modificado. - hay que crear la vista
	function published(){
		if($this->Auth->User()){			

		
				$products = $this->Product->find('all',array('conditions' => array('Product.user_id' => $this->userLogged['User']['id'],'Product.deleted'=>0)));
				$this->set('products',$products);
		
		}	
	}
	
	function listProducts(){

		if($this->Auth->User()){
			
				$products = $this->Product->find('all',array(
															'conditions' => array('Product.company_id' => $this->userLogged['User']['company_id'],'Product.deleted'=>0,'Product.status'=>1),
															'order' => array('Product.created DESC')
															));
				$this->set('products',$products);
				
		}
	}
	function listDrafts(){
		if($this->Auth->User()){
			
				$products = $this->Product->find('all',array(
															'conditions' => array('Product.company_id' => $this->userLogged['User']['company_id'],'Product.deleted'=>0,'Product.status'=>0),
															'order' => array('Product.created DESC'),
															));
				
				//debug($products);
				$this->set('products',$products);
		}
	}
	
	function  delete(){
		if($this->Auth->User()){
			$request = $this->request->query;
	
			$productData = $this->Product->find('first', array(
				'conditions' => array('Product.id' => $request['id'],'Product.company_id' => $this->userLogged['User']['company_id'])
			));
			if($productData){
			//El formulario no ha sido corrompido.
				
				$data['Product']['id'] 		= $productData['Product']['id'];
				$data['Product']['deleted']	= 1;
				
				if($this->Product->save($data)){
					$return['result'] = 'ok';	
					$return['deleted'] = 1;
				};
			
			}else{
				$return['result'] = 'redirect';
			}
	
			$this->set('return',$return);
			$this->render('addNew','ajax');
		}
	}
	
	function buyNow(){
	
		debug($this->request->data);
		
	}
	

}
?>
