<?php
// astric

class AppController extends Controller {
	
	//public $name = 'App';
	public $helpers = array('Session', 'Html','Form','Time');
	
		public $components = array(
			'Auth' => array(
				'authenticate' => array(
					'Form' => array(
						'fields' => array('username' => 'email')
					)
				)
			),
			'Cookie',
			'DependentSelectBox',
			'Session'
		);
	
	protected $userLogged = array();
	
	
	############################################# Selectores AppController ####################################################
		
		// selectConfig: configuración de los selectores dependientes
		
		### Modificar ###
		public 		$selectConfig = array(
				'Country' => array(
					'parentClass'=>null,
					'foreignKey' => null,
					//'fields'=>array('other_field'),
					'conditions'=>null,
					'childClass'=>'State',
					'update'=>array('State','City')
				),
				'State'=>array(
						'parentClass'=>'Country',	
						'foreignKey' => 'country_id',
						//'fields'=>array('other_field'),
						'conditions'=>null,
						'childClass'=>'City',
						'update'=>array('City')
				),
				'City'=>array(
					'parentClass'=>'State',	
					'foreignKey' => 'state_id',
					'conditions'=> null,
					'childClass'=>null
				)
			);
			
	
	
	//$instancia = new className
	//	$instancia->newSimpleSelect($this->selectConfig,$this->request->data,false,$currentModel)   
	
	
	### No modificar ###	
	public function selectoresDependientes($currentModel){
			
		//	debug($this->request->data);
		//	debug(Inflector::singularize($this->request['params']['controller']));
		
		$selector = $this->DependentSelectBox->newSimpleSelect($this->selectConfig,$this->request->data,false,$currentModel);
		$this->set(compact('selector'));
		
		// para enviar el resto de la data, por colocar un input disabled
		if($this->request->data){
			foreach($this->selectConfig as $key => $value){ 				
				$disabledField = strtolower($key).'_id';	
				if(!isset($this->request->data[$currentModel][$disabledField])){  
						//debug($disabledField); 
						$this->request->data[$currentModel][$disabledField] = null; 
				}
			}
			
		}				
						
		if($this->request->is('ajax')){
						
			$selector = $this->DependentSelectBox->newSimpleSelect($this->selectConfig,$this->request->query,true,$currentModel);
			$jsonObject = json_encode($selector);
			$this->set('object',$jsonObject);
			$this->render('DependentSelectBox','ajax');
		}
		
	
	}
	############################################# End Selectores ####################################################
	
	
	public function beforeFilter(){
				
		if ($this->Auth->User()){
			$this->userLogged['User'] = $this->Auth->User();
			$this->set('userLoggedName',$this->userLogged['User']['name']);
		}else{
			if($this->request->isAjax()){
				$allowed = false;
				foreach($this->Auth->allowedActions as $action){
					if($action == $this->request->params['action']){
						$return['allowed'] = true;
					}
				}
				if(!$allowed){
					$return['allowed'] = false;
				}
				
				echo json_encode($return);
			}
		}
		
	

		
		
		
		
		
		//debug($this->userLogged);
		
		//	Para Ubicarse entre las vistas y controladores...
		$this->set('controller',$this->params['controller']);
		$this->set('action',$this->params['action']);		
		  
				
		
		// Configuracion de la Cookies
		$this->Cookie->time ='25200';	// 25200
		//$this->Cookie-> ='';	
		
		// Productos en el carrito de compras y cuantos son.
		$productsInTheCart = $this->productsInTheCart();		
		
		if($productsInTheCart){
		
			$quantityOfProductsInTheShoppingCart = 0;
			foreach($productsInTheCart as $key => $value){
				$quantityOfProductsInTheShoppingCart += count($value);
			}
		
		}else{
		
			// no hay productos en el carro de compras.
			$quantityOfProductsInTheShoppingCart = 0;
			
		}
		$this->set(compact('productsInTheCart','quantityOfProductsInTheShoppingCart'));	
		
	}
	

	
	
	public function productsInTheCart(){
		
        $this->loadModel('Cart');
        
        // toma todos los productos que pudisen ser anadidos durante la seccion no logeada del usuario y lo suma al carrito de compra que tiene vigente.
				if ($this->Auth->User()){
			
				//$userData = $this->Auth->User();
				
			
				$cart = $this->Cart->find('all', array('conditions' => array('Cart.cake_session_id' => $_COOKIE['CAKEPHP'],'Cart.user_id'=>NULL)));
				
					if($cart){
						foreach($cart as $cartKeys => $cartValues){
					
							//debug($cartValues);
							// el producto ya esta en el carrito de compra del cliente?
							$inCart = $this->Cart->find('first', array('conditions' => array('Cart.user_id' => $this->userLogged['User']['id'],'Cart.product_id'=>$cartValues['Cart']['product_id'])));
							
							if($inCart){
								//debug('este producto ya esta en el carrito de compras');
								//debug($inCart);
								$this->Cart->delete($cartValues['Cart']['id']);
							}else{
							
								$cartValues['Cart']['user_id'] = $this->userLogged['User']['id'];
								$this->Cart->save($cartValues['Cart']);
									
							}
						}
					}
				}
			
			/*	
				el usuario esta logeado?
					si
						cargamos todos los productos que esten en el modelo Cart
					no
						cargamos todos lo productos que esten en modelo Cart que tenga como seccion_id el id de la secion actual.
			*/


			$this->loadModel('User');
			$this->loadModel('Image');			
			$this->loadModel('Product');
			$this->loadModel('Company');
			
			if($this->Auth->User()){ // significa que esta logeado
				
				
			//	debug($this->Auth->User());
				
				$this->set('userData',$this->userLogged);


				$preCart = $this->Cart->find('all', array('conditions' => array('Cart.user_id' => $this->userLogged['User']['id'])));
				
				if($preCart){
				
					foreach($preCart  as $preCartKey => $preCartValues){
					
						
						$company = $this->Company->findById($preCartValues['Product']['company_id']); // seler
						$imagen = $this->Image->findAllByProductId($preCartValues['Product']['id']);
					
						$preCartValues['Company'] = $company['Company'];
					
							foreach($imagen as $imagenKey => $imagenValues){
							
								$preCartValues['Image'][$imagenKey] = $imagenValues['Image'];
							
							}
					
							$productsInTheCartOrderBySeller[$preCartValues['Company']['name']][$preCartKey] = $preCartValues; // se renombra de User a UserSeler por que el modelo Cart esta relacionado con el modelo User, ya que la data que trae por defecto es del usuario que tiene cuenta en el sitio y tiene muchos productos en el carrito de compras, y en este caso me interesa que la data del vendedor que tambien pertenece al modelo user este disponible, en resumen se renombra para evitar una colicion. 
						
					}
				
				$this->set(compact('productsInTheCartOrderBySeller'));
				return $productsInTheCartOrderBySeller;	
						
				}else{
				
					return null;
					
				}
				
			
			
			
			}else{ // significa que no esta logeado
				
				if(isset($_COOKIE['CAKEPHP'])){
					$preCart = $this->Cart->find('all', array('conditions' => array('Cart.cake_session_id' => $_COOKIE['CAKEPHP'],'Cart.user_id'=>NULL)));
					
					if($preCart){
					
						foreach($preCart  as $preCartKey => $preCartValues){
						
						
							$this->loadModel('Company');
							$company = $this->Company->findById($preCartValues['Product']['company_id']); // seler
							
							$imagen = $this->Image->findAllByProductId($preCartValues['Product']['id']);
						
							$preCartValues['Company'] = $company['Company'];
							
								foreach($imagen as $imagenKey => $imagenValues){
								
									$preCartValues['Image'][$imagenKey] = $imagenValues['Image'];
								
								}
						
								$productsInTheCartOrderBySeller[$preCartValues['Company']['name'].' '.$preCartValues['Company']['type']][$preCartKey] = $preCartValues; // se renombra de User a UserSeler por que el modelo Cart esta relacionado con el modelo User, ya que la data que trae por defecto es del usuario que tiene cuenta en el sitio y tiene muchos productos en el carrito de compras, y en este caso me interesa que la data del vendedor que tambien pertenece al modelo user este disponible, en resumen se renombra para evitar una colicion. 
							
						}
					
						//debug($productsInTheCartOrderBySeller);
					
						$this->set(compact('productsInTheCartOrderBySeller'));
						return $productsInTheCartOrderBySeller;
					 
					}else{ 
						return null; 
					} 
				
				}else{
					return null;
				}
			}
        	
	}
	


	
}
