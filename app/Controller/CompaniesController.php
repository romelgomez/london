<?php
class CompaniesController extends AppController{
	
	public $name ='Companies';
	
	
	public function beforeFilter(){
			
		$this->Auth->allow('index','contactTheSeller');
			
		parent::beforeFilter();				
	}
	
	
	public function index($company=null,$id=null){

		$companyData = $this->Company->findById($id);
	
		if($companyData){
			//debug($companyData);
			$opciones = array(
				'conditions' => array(
										'Product.company_id'=>$companyData['Company']['id'],
										'Product.status' => '1',
										'Product.quantity >=' => '1'
									)
			);
			$products = $this->Product->find('all',$opciones);
			
			$this->set(compact('products','companyData'));
			// una mejora. si se consige que el modelo Company, que el modelo Product venga con toda la data, no sera necesario crear otra consulta.
			
		}else{
		
			// busca un producto. por # parte, nombre, etc. 
			// si no ecuentra nada $this->redirect(array('action'=>'index'));			
		}
	}

	public function contactTheSeller($action=null,$company=null,$id=null){
		
			$opciones = array(
				'conditions' => array(
										'Company.id'=>$id,
										'Company.status' => '1'
									)
			);
			$company = $this->Company->find('first',$opciones);
			
			
			$opciones = array(
				'conditions' => array(
										'Store.company_id'=>$id,
										'Store.deleted' => 0,
										'Store.status' => 1
									)
			);			
			$stores = $this->Company->Store->find('all',$opciones);


	//debug($company);
	//debug($stores);
	
			$this->set(compact('company','stores'));
			
	}

	public function policiesOfTheSeller($action=null,$company=null,$id=null){
		
			$opciones = array(
				'conditions' => array(
										'Company.id'=>$id,
										'Company.status' => '1'
									)
			);
			$company = $this->Company->find('first',$opciones);		
			
			
			$this->set(compact('company'));
		
	}
	
	public function warrantiesOfTheSeller($action=null,$company=null,$id=null){
		
			$opciones = array(
				'conditions' => array(
										'Company.id'=>$id,
										'Company.status' => '1'
									)
			);
			$company = $this->Company->find('first',$opciones);
			
			$this->set(compact('company'));
			
	}
	
	
	
	public function policies(){
		
		if($this->Auth->User()){
				
				$user = $this->User->find('first', array('conditions' => array('User.id' => $this->userLogged['User']['id'])));	
			
				if($user['Company']['policies']){
						
						$this->set('policies',$user['Company']['policies']);
						
				}else{
					$this->redirect('/policiesEdit');
				}
		}
		
	}
	
	public function policiesEdit() {

		if($this->Auth->User()){
			
			if($this->data){
					
					//debug($this->data);
					$company = array(
						'Company'=>array(
							'id'=>$this->userLogged['User']['company_id'],
							'policies'=>$this->data['Company']['policies'],
							'policies_status'=>$this->data['Company']['policies_status']
						)
					);
					
					if($this->Company->save($company)){
					
						$this->redirect('/policies');
					}					
			}else{
				
				$company = $this->Company->find('first', array('conditions' => array('Company.id' => $this->userLogged['User']['company_id'])));	

				$this->data = $company;
			}
		}
	}
	
	public function warranties(){
		
		if($this->Auth->User()){
				
				$user = $this->User->find('first', array('conditions' => array('User.id' => $this->userLogged['User']['id'])));	
			
				if($user['Company']['warranties']){
						
						$this->set('warranties',$user['Company']['warranties']);
						
				}else{
					$this->redirect('/warrantiesEdit');
				}
		}
		
	}
	
	public function warrantiesEdit(){

		if($this->Auth->User()){
			
			if($this->data){
					$company = array(
						'Company'=>array(
							'id'=>$this->userLogged['User']['company_id'],
							'warranties'=>$this->data['Company']['warranties'],
							'warranties_status'=>$this->data['Company']['warranties_status']
						)
					);
					
					if($this->Company->save($company)){
					
						$this->redirect('/warranties');
					}					
			}else{
				
				$company = $this->Company->find('first', array('conditions' => array('Company.id' => $this->userLogged['User']['company_id'])));	

				$this->data = $company;
			}
		}
	}

	
	
} // end class	


//$this->redirect($this->referer());
