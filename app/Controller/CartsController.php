<?php 
	class CartsController extends AppController{
	
		public $name = 'Carts';
		
		public function beforeFilter(){
			
			$this->Auth->allow('index','add','delete');
			
			parent::beforeFilter();				
		}
		
		/*
		Analogia 
			Tal dia, tal persona
			visita la web
			se crea una id de seccion y cookie, con fecha de vencimiento de dos dias
			anade 50 productos
			existiran 50 productos en la BD carts donde el campo seccion_id guarda el id de la seccion actual
			si se logea se actualisa todos los registros de la BD carts que tenga el id de la seccion actual, el campo de user_id con el del recien logeado.  
			
			si no se loguea a tiempo, el carrito queda como abandonado,
			Carritos de compras abandonados implica Secciones vencidas, esta data puede migrarse a un base de datos de tendencias.
		*/
		
		
		
		public function index(){
			
			
		
		
		}
		
		public function add(){
			
			/*
				es usuario esta logeado?
					si
						guardamos en la base de datos
						id del usuario | id del producto | cantidad
						* redirecionar a Carts::index 
					no
						guardamos en el modelo Cart el seccion_id de la secion actual.
						id de la seccion | id del producto | cantidad
						* redirecionar Carts::index
			
			*/
			
			debug($this->data);
			
			if($this->data){		
			
				$product_id	= $this->data['Product']['id'];
				$quantity	= $this->data['Product']['quantity'];

				
				if($this->Auth->User()){ // significa que el usuario esta logeado en el sitio
					
					
					$data = $this->Cart->find('first',array('conditions'=>array('Cart.product_id'=>$product_id,'Cart.user_id'=>$this->userLogged['User']['id'])));
					
					if($data){ // significa que el producto ya esta en el carrito de compras, por lo tanto no sera anadido.
							debug('el producto ya existe en la base de datos por lo tanto no sera anadido');
					}else{ // se anade el producto a la base de datos carts.
							
					
						$productData = array('Cart'=>array(
							'user_id'=> $this->userLogged['User']['id'],
							'cake_session_id'=>$_COOKIE['CAKEPHP'],
							'product_id'=>$product_id,
							'quantity'=>$quantity,
						));
					
						if($this->Cart->save($productData)){
							$this->redirect(array('controller' => 'cart', 'action' => 'index'));
						}
						else{
							debug('ha ocurrido un error, redirecionar luego de mostar un mesaje.');
						}
					}	
						
				}else{ // significa que no esta logeado
					
					$data = $this->Cart->findByCakeSessionId($_COOKIE['CAKEPHP']);
					
					if($data){ // la seccion del visitante continua vigente. 
						
						$data = $this->Cart->find('first',array('conditions'=>array('Cart.cake_session_id'=>$_COOKIE['CAKEPHP'],'Cart.product_id'=>$product_id,'Cart.user_id'=>NULL)));
						
						if($data){ // significa que el producto ya esta en el carrito de compras, por lo tanto no sera anadido.
							debug('el producto ya existe en la base de datos por lo tanto no sera anadido');
						}else{ // se anade el producto a la base de datos carts.
							
							
							$productData = array('Cart'=>array(
								'cake_session_id'=>$_COOKIE['CAKEPHP'],
								'product_id'=>$product_id,
								'quantity'=>$quantity,
							));
						
							if($this->Cart->save($productData)){
								$this->redirect(array('controller' => 'cart', 'action' => 'index'));
							}
							else{
								debug('ha ocurrido un error, redirecionar luego de mostar un mesaje.');
							}
						}
						
					}else{ // significa que esta visitando el sitio por primera vez.
						
						$productData = array('Cart'=>array(
							'cake_session_id'=>$_COOKIE['CAKEPHP'],
							'product_id'=>$product_id,
							'quantity'=>$quantity,
						));
						
						if($this->Cart->save($productData)){
							$this->redirect(array('controller' => 'cart', 'action' => 'index'));
						}
						else{
							debug('ha ocurrido un error, redirecionar luego de mostar un mesaje.');
						}
					}
				}
		
			}else{ 	$this->redirect(array('controller' => 'cart', 'action' => 'index')); }
		
		} //end function  
		
		public function delete($id=null){
		
			$this->Cart->delete($id);
			$this->redirect(array('action' => 'index'));
			
		}
		
	}
?>
