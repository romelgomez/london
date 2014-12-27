<?php
class UsersController extends AppController{
	
	###################################### propierties ####################################################
	
	public $name ='Users';
	//public $paginate
	// public $displayField ='username';
	
	###################################### functions ######################################################
	public function beforeFilter(){
			
		$this->Auth->allow('index');
			
		parent::beforeFilter();				
	}
	
	public function settings(){
		
		if($this->Auth->User()){
				
			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->userLogged['User']['id'])));	
		
			$this->loadModel('Address');
			$addresses = $this->Address->find('all', array('conditions' => array('Address.user_id' => $user['User']['id'],'Address.deleted'=>0)));
			
			//debug($addresses);
			//debug($user);

				if($user['Company']['id']){
					
					$this->loadModel('Store');
					$stores = $this->Store->find('all', array('conditions' => array('Store.company_id' => $user['Company']['id'],'Store.deleted'=>0)));
					//debug($stores);	
					
					$this->loadModel('BankAccount');
					$bankAccounts = $this->BankAccount->find('all', array('conditions' => array('BankAccount.company_id' => $user['Company']['id'])));

					if($bankAccounts){
						foreach($bankAccounts as $k=>$v){
							
							$banksName[$v['Bank']['id']] = $v['Bank']['name']; 
						} 
						
						foreach($banksName as $k => $v){
							foreach($bankAccounts as $k2=>$v2){
								
								if($k == $v2['Bank']['id']){
									$bankAccountsData[$k]['name'] = $v;
									$bankAccountsData[$k]['bankAccounts'][$k2] = $v2;
								}
								
							}
						}
						
						
					}
					
				}
				
				$this->set(compact('user','addresses','stores','bankAccountsData'));

			}
	}
	
	
	public function index($username=null){
		
		debug('user-index');
		
		$user = $this->User->findByUsername($username);

		if(empty($user)){
				$this->redirect(array('action'=>'index'));			
			}
		if(!empty($user)){
			$this->set('seller',$user['User']['username']);					
			
	
	
			
			$opciones = array(
				'conditions' => array(
										'Product.user_id'=>$user['User']['id'],
										'Product.status' => '1',
										'Product.quantity >=' => '1'
									)
			);
			$products = $this->Product->find('all',$opciones);
			
			$this->set('products', $products);
		}
	}

	public function login(){
		
		if($this->request->isAjax()){
			
			//$request = $this->request;
			//debug($request);
			// $this->set('return',$return);
			//$this->render(null,'ajax');
			/*
				$tmpUser['User']['username'] = $this->request->params['username'];
				$tmpUser['User']['password'] = $this->request->params['password'];
				if($this->Auth->login($tmpUser))
				{
					$this->Session->setFlash('Login Passed');
				}
			*/
		
		}else{
			if($this->Auth->login()){
				// ... 
				return $this->redirect($this->Auth->redirect());
			} else {
				// ...
			}
		}
		
		//debug($this->referer());
		//debug($this->Auth);
		// return $this->redirect($this->Auth->redirect());
		//debug($this->referer());   - luego de solicitar login - se actualiza la dirección a redirigir.
		// $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
		
	}
	
	function logout() {       
		$this->Auth->logout();
		$this->redirect('/');
	}
	
	function edit(){

		if($this->Auth->User()){
			
				
			if($this->data){
				
				$user = array(
					'User'=>array(
						'id'=>$this->userLogged['User']['id'],		
						'name'=>$this->data['User']['name'],	
						'family_name'=>$this->data['User']['family_name'],	
						'email'=>$this->data['User']['email'],	
						'phone'=>$this->data['User']['phone']
					)
				);
				
				if($this->User->save($user)){
					$this->redirect('/accountSettings');
				}
				
			}else{
						
				$user = $this->User->find('first', array('conditions' => array('User.id' => $this->userLogged['User']['id'])));	
				$this->data = $user;
				$this->set(compact('user'));
			
			}
		}
	}
	
	function editPassword(){
		
		
		if($this->Auth->User()){
			
			if($this->data){
				//debug($userData);
				$ok = $this->User->find('first', array('conditions' => array('User.id' => $this->userLogged['User']['id'],'User.password' => $this->Auth->password($this->data['User']['current_password']))));
				if($ok){
					
					if($this->Auth->password($this->data['User']['new_password']) == $this->Auth->password($this->data['User']['new_password_repeated'])) {    
						//$data = $this->Auth->password('hola');
						
						debug('ok');
						
						$user = array(
							'User'=>array(
								'id'=>$this->userLogged['User']['id'],		
								'password'=>$this->Auth->password($this->data['User']['new_password'])
							)
						);
					
						if($this->User->save($user)){
							$this->redirect('/accountSettings');
						}
					}
				}
			}
		}
	
	
		
	}
	
}	

//$this->redirect($this->referer());
//debug($this->params);

?>
