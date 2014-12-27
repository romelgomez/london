<?php 

class BankAccountsController extends AppController{
	
	public $name = 'BankAccounts';
	// public $displayField ='username';

	
	public function add(){
		
		if($this->Auth->User()){
			
			if($this->data){
			
				$data = Array(
						'BankAccount' => Array
							(
								'user_id' => $this->userLogged['User']['id'],
								'company_id' => $this->userLogged['User']['company_id'],
								'bank_id' => $this->data['BankAccount']['bank_id'],
								'number' => $this->data['BankAccount']['number']
							)
				);
			
				if($this->BankAccount->save($data)){
					$this->redirect('/accountSettings');
				}
			}
			
			
			$this->loadModel('Company');
			$company = $this->Company->find('first', array('conditions' => array('Company.id' => $this->userLogged['User']['company_id'])));
			
			
			$this->loadModel('Bank');
			$allBanks = $this->Bank->find('list');
			
			
			$this->set(compact('allBanks','company'));
		
		}
	}

	public function edit($id=null){
		
		if($this->Auth->User()){
			
			if($this->data){
				
				$bankAccount = $this->BankAccount->find('first', array('conditions' => array('BankAccount.id' => $this->data['BankAccount']['id'],'BankAccount.company_id' => $this->userLogged['User']['company_id'])));
				if($bankAccount){
					$data = Array(
						'BankAccount' => Array
							(
								'id' => $bankAccount['BankAccount']['id'],
								'user_id' => $this->userLogged['User']['id'],
								'bank_id' => $this->data['BankAccount']['bank_id'],
								'number' => $this->data['BankAccount']['number']
							)
					);
					
					if($this->BankAccount->save($data)){
						$this->redirect('/accountSettings');
					}
				}
				
			}else{
			
				$bankAccount = $this->BankAccount->find('first', array('conditions' => array('BankAccount.id' => $id,'BankAccount.company_id' => $this->userLogged['User']['company_id'])));
				
				if($bankAccount){

					$this->data = $bankAccount;			
				
				}else{
					$this->redirect('/accountSettings');
				}				
				
			}	
			
			$this->loadModel('Company');
			$company = $this->Company->find('first', array('conditions' => array('Company.id' => $this->userLogged['User']['company_id'])));				
					
			$this->loadModel('Bank');
			$allBanks = $this->Bank->find('list');
					
			$this->set(compact('allBanks','company','id'));
		
		}
	}

}


//$this->redirect($this->referer());
?>
