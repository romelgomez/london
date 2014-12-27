<?php
class FrontEndsController extends AppController {
	
	
	// propierties 
	public $name = 'FrontEnds';
	public $uses = array();
	
	public function beforeFilter(){
			
		$this->Auth->allow('index');

		parent::beforeFilter();				
	}
	
	function index(){
		
		
			//debug(AuthComponent::password('123123'));
		 
			# PRODUCTOS DESTACADOS
			$this->loadModel('Product');
			
			// los destacados seran elegidos a dedo. 
			$products = $this->Product->find('all',array('conditions' => array('Product.id' =>array(1,2,3,4),'Product.status' => 1,'Product.quantity >=' => 1),'limit' => 4));
			//debug($products);
			
			
			# CATEGORIAS
			$this->loadModel('Category');
			$allCategories = $this->Category->find('threaded');
			
			# SET VISTA
			$this->set(compact('products','allCategories'));
			
			//debug($this->Auth->User());
			
		}
	}


?>
