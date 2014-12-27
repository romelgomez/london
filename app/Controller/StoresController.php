<?php class StoresController extends AppController{
	
	public $name = 'Stores';
 	public $components = array('Upload');
 	
 	
 	public function beforeFilter(){
			
		//$this->Auth->allow('view','add');
			
		parent::beforeFilter();				
	
	}
 	
 	
 	public function addAddress(){	
	
		if($this->request->data){
		//debug($this->data);	
		}

		if($this->Auth->User()){
		//etapa 1	
			
			$this->selectoresDependientes('Store');	
			
			if($this->request->data){
								
				$store =	array(
					'Store'=>Array
						(							
						   'company_id'=>$this->userLogged['User']['company_id'],
						   'country_id'=>$this->request->data['Store']['country_id'],
						   'state_id'=>$this->request->data['Store']['state_id'],
						   'city_id'=>$this->request->data['Store']['city_id'],
						   'name'=>$this->request->data['Store']['name'],
						   'address'=>$this->request->data['Store']['address'],
						   'phones'=>$this->request->data['Store']['phones'],
						   'email'=>$this->request->data['Store']['email'],
						   'map'=> null,
						   'status'=>$this->request->data['Store']['status'],
						   'deleted'=>0
						)
				);
								
					if($this->Store->save($store)){
									
						$destination = WWW_ROOT."img/stores/";
						// en este foreach se verifica si existe alguna imagen, y se sube al servidor.
						foreach($this->request->data['addStoreImage'] as $file){
							if($file['name']){
								// etapa 3 	
								$this->Upload->upload($file, $destination,null, array('type' => 'resizecrop', 'size' => array('900', '600'), 'output' => 'jpg'));
								$parentFileNames['900x600px'] = $this->Upload->result;
								$this->Upload->upload($file, $destination,null, array('type' => 'resizecrop', 'size' => array('120', '120'), 'output' => 'jpg'));
								$parentFileNames['120x120px'] = $this->Upload->result;
								$this->Upload->upload($file, $destination); // al parecer el orde de subida influye, esta linea si va de primera las demas subidas no se ejecutan.
								$images[$this->Upload->result] = $parentFileNames;
							}
						}						
						
						//debug($this->Product->id); // id del producto recien guardado
						// las imagenes .JPG estan dando error, las .jpg no, un parche: if($key != 0)
						// deveria dar error para la imagen que no carga.
						//debug($images);
						
						
						if(isset($images)){							
							$this->loadModel('StoreImage');							
							foreach($images as $key=>$values){
								
								if($key){
								
									$imagenCompleta = array(
															'StoreImage' => Array
																(
																	'company_id'=>$this->userLogged['User']['company_id'],
																	'store_id'=>$this->Store->id,
																	'parent_id' => NULL,
																	'size' => 'full',
																	'name' => $key,
																	'deleted' => 0,
																)
														);									
									$this->StoreImage->save($imagenCompleta);
									$idImagePadre = $this->StoreImage->id;
									$this->StoreImage->create();
									foreach($values as $size=>$name){
											$imagenTruncada = array(
																	'StoreImage' => Array
																		(
																			'company_id'=>$this->userLogged['User']['company_id'],
																			'store_id'=>$this->Store->id,
																			'parent_id' => $idImagePadre,
																			'size' => $size,
																			'name' => $name,
																			'deleted' => 0,																			
																		)
																);
											$this->StoreImage->save($imagenTruncada);
											$this->StoreImage->create();					
																								
									} 
								}
							}
						}
						//$this->Session->setFlash('Ya se guardo, puede seguir editandolo si quieres. ten en cuenta que el producto se publicara autumaticamente si la informacion solicitada esta completa');	
						//$this->redirect('/editStoreAddress'.$this->Store->id);	
						$this->redirect('/accountSettings');
					}
				
			}
			
			# CATEGORIAS
			//$allCategories = $this->Category->find('list');
			//$this->set(compact('allCategories'));
		
			
		}
		
	}
	
	public function editAddress($controller,$slug,$id){
		
		if($this->Auth->User()){
						
			$store = $this->Store->find('first', array('conditions' => array('Store.id' => $id,'Store.company_id'=>$this->userLogged['User']['company_id'],'Store.deleted'=>0)));
			if($store){

				//debug($store);

				if(empty($this->request->data)){
					
					
					
					$this->request->data = $store;
					$this->selectoresDependientes('Store');
				
				}else{
					
					$this->selectoresDependientes('Store');
					
					$storeUpdate =	array(
						'Store'=>Array
							(	
							   'id'=>$id,
							   'country_id'=>$this->request->data['Store']['country_id'],
							   'state_id'=>$this->request->data['Store']['state_id'],
							   'city_id'=>$this->request->data['Store']['city_id'],
							   'name'=>$this->request->data['Store']['name'],
							   'address'=>$this->request->data['Store']['address'],
							   'phones'=>$this->request->data['Store']['phones'],
							   'email'=>$this->request->data['Store']['email'],
							   'map'=> null,
							   'status'=>$this->request->data['Store']['status'],
							   'deleted'=>0
							)
					);
				
					if($this->Store->save($storeUpdate)){
						
						######### save ############
						$destination = WWW_ROOT."img/stores/";
						// en este foreach se verifica si existe alguna imagen, y se sube al servidor.
						foreach($this->request->data['addStoreImage'] as $file){
							if($file['name']){
								// etapa 3 	
								$this->Upload->upload($file, $destination,null, array('type' => 'resizecrop', 'size' => array('900', '600'), 'output' => 'jpg'));
								$parentFileNames['900x600px'] = $this->Upload->result;
								$this->Upload->upload($file, $destination,null, array('type' => 'resizecrop', 'size' => array('120', '120'), 'output' => 'jpg'));
								$parentFileNames['120x120px'] = $this->Upload->result;
								$this->Upload->upload($file, $destination); // al parecer el orde de subida influye, esta linea si va de primera las demas subidas no se ejecutan.
								$images[$this->Upload->result] = $parentFileNames;
							}
						}
						
						//debug($this->Product->id); // id del producto recien guardado
						// las imagenes .JPG estan dando error, las .jpg no, un parche: if($key != 0)
						// deveria dar error para la imagen que no carga.
						//debug($images);
						
						if(isset($images)){
							
							$this->loadModel('StoreImage');
							
							foreach($images as $key=>$values){
								
								if($key){
								
									$imagenCompleta = array(
															'StoreImage' => Array
																(
																	'company_id'=>$this->userLogged['User']['company_id'],
																	'store_id'=>$this->Store->id,
																	'parent_id' => NULL,
																	'size' => 'full',
																	'name' => $key,
																	'deleted' => 0,
																)
														);									
									$this->StoreImage->save($imagenCompleta);
									$idImagePadre = $this->StoreImage->id;
									$this->StoreImage->create();
									foreach($values as $size=>$name){
											$imagenTruncada = array(
																	'StoreImage' => Array
																		(
																			'company_id'=>$this->userLogged['User']['company_id'],
																			'store_id'=>$this->Store->id,
																			'parent_id' => $idImagePadre,
																			'size' => $size,
																			'name' => $name,
																			'deleted' => 0,																			
																		)
																);
											$this->StoreImage->save($imagenTruncada);
											$this->StoreImage->create();					
																								
									} 
								}
							}
						}
						
						//$this->Session->setFlash('Your stuff has been saved.');
						$this->Session->setFlash('Ya se guardo, puede seguir editandolo si quieres.');	
						//$this->redirect('/editStoreAddress'.$this->Store->id);	
						//$this->redirect($this->referer());
						$this->request->data = $this->Store->read();
					}					
					######### end save ############	
				}
				
			}else{
				$this->redirect('/accountSettings');
			}
		}	
	}
	
	
	public function deletedAddress($id){
			if($this->Auth->User()){
				
			$store = $this->Store->find('first', array('conditions' => array('Store.id' => $id,'Store.company_id'=>$this->userLogged['User']['company_id'])));
			if($store){	
				
				$store['Store']['deleted'] = 1;
				$this->Store->save($store);		
				$this->redirect('/accountSettings');
			}else{
				$this->redirect('/accountSettings');
			}
		}	
			
	}
	
	function deleteAddressImage($name){
		// en este metodo no se eliminan imagenes, solo se cambia el estado de la imagen a eleminada.
		if($this->Auth->User()){			
						
				$this->loadModel('StoreImage');		
				$imagen = $this->StoreImage->findByName($name);
				
				//debug($imagen);
				//debug($name);
				
				if($imagen){
					
					if($this->userLogged['User']['company_id']!=$imagen['StoreImage']['company_id']){
						// si es verdad - el usuario esta intentando borrar la imagen de otro usuario.
							
							
						//$this->redirect($this->referer());
					}else{
						
						//debug($imagen['StoreImage']['parent_id']);
						if($imagen['StoreImage']['parent_id']){
							// si intencionalmente envian una imagen que no tiene padre, la consulta afectan a todas las imagenes 
							// que son padre.
							
							$imagenes = $this->StoreImage->findAllByParentId($imagen['StoreImage']['parent_id']);
							$imagenCompleta = $this->StoreImage->findById($imagen['StoreImage']['parent_id']);
							array_push($imagenes,$imagenCompleta);
							foreach($imagenes as $key => $values){
								 $values['StoreImage']['deleted'] = 1;
								 $registrosModificados[] = $values;
							}
							
							$this->StoreImage->saveAll($registrosModificados);
							
							//debug($registrosModificados);
		
							$this->redirect($this->referer());
							//debug($imagenes);
							//debug('hola');
						}
						
						
					}
				}
				
		}
		
	}
	
	function test(){
		
			if($imagen){
					
					if($this->userLogged['User']['company_id']!=$imagen['StoreImage']['company_id']){
							// si es verdad - el usuario esta intentando borrar la imagen de otro usuario.
							
						debug($imagen);
							
							//$this->redirect($this->referer());
					}else{
						
						$imagenes = $this->StoreImage->findAllByParentId($imagen['StoreImage']['parent_id']);
						$imagenCompleta = $this->StoreImage->findById($imagen['StoreImage']['parent_id']);
						array_push($imagenes,$imagenCompleta);
						
						foreach($imagenes as $key => $values){
							 $values['StoreImage']['deleted'] = 1;
							 $registrosModificados[] = $values;
						}
						
						$this->Image->saveAll($registrosModificados);
						
						debug($registrosModificados);
						//$this->redirect($this->referer());	
						//$this->redirect('/editProduct/'.$imagen['Product']['id']);
					
					}
				}
	
	
	}
	
	
	
	
} // end of StoreController


?>
