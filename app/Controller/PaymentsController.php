<?php class PaymentsController extends AppController {
	
	public $name = 'Payments';

	
	public function add($id){
		
		if($this->Auth->User()){
			
			$this->loadModel('Purchase');
			$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $id,'Purchase.user_id' => $this->userLogged['User']['id'])));
				
			//	debug($purchase);	
				
				
				if($purchase){
					
					$this->loadModel('BankAccount');
					$bankAccounts = $this->BankAccount->find('all', array('conditions' => array('BankAccount.company_id' => $purchase['Company']['id'])));
					
					# Banesco Banco Universal C.A - Nº 1222-1110-2223-2222  
					# Mercantil C.A Nº 1222-1110-2223-2222

					# http://www.php.net/manual/es/function.chunk-split.php#97158
					function mbStringToArray ($str) {
						if (empty($str)) return false;
						$len = mb_strlen($str);
						$array = array();
						for ($i = 0; $i < $len; $i++) {
							$array[] = mb_substr($str, $i, 1);
						}
						return $array;
					}

					function mb_chunk_split($str, $len, $glue) {
						if (empty($str)) return false;
						$array = mbStringToArray ($str);
						$n = -1;
						$new = '';
						foreach ($array as $char) {
							$n++;
							if ($n < $len) $new .= $char;
							elseif ($n == $len) {
								$new .= $glue . $char;
								$n = 0;
							}
						}
						return $new;
					}
					# end

					
					if($bankAccounts){
						foreach($bankAccounts as $k=>$v){							
							$banksName[$v['Bank']['id']] = $v['Bank']['name']; 
						} 
						foreach($banksName as $k => $v){
							foreach($bankAccounts as $k2=>$v2){
								if($k == $v2['Bank']['id']){									
									$bankAccountsData[$v2['BankAccount']['id']] = $v.' - Nº '.mb_chunk_split($v2['BankAccount']['number'], 4, '-');									
								}
							}
						}
					}
					
					//debug($bankAccountsData);
					
					$this->loadModel('Company');
					$company = $this->Company->find('first', array('conditions' => array('Company.id' => $purchase['Company']['id'])));
					
					
					$this->set(compact('purchase','bankAccountsData','company'));

					if($this->request->data){
						
						$this->request->data['Payment']['user_id'] =  $this->userLogged['User']['id'];
						$this->request->data['Billing']['user_id'] = $this->userLogged['User']['id'];
						$this->request->data['Billing']['purchase_id'] = $this->request->data['Payment']['purchase_id'];

						//$this->Payment->saveAll($this->request->data);
						if($this->Payment->saveAssociated($this->request->data)){
							
							$this->redirect('/my_purchases');

						}


					}	
						
						
				}else{
				
					$this->redirect('/my_purchases');
					
				}				
		}
	}

	public function edit($id){
		//Payment Billing
		
		if($this->Auth->User()){
			
			$this->loadModel('Purchase');
			$purchase = $this->Purchase->find('first', array('conditions' => array('Purchase.id' => $id,'Purchase.user_id' => $this->userLogged['User']['id'])));
				
			//	debug($purchase);	
				
					
		if($purchase){
					
					$this->loadModel('BankAccount');
					$bankAccounts = $this->BankAccount->find('all', array('conditions' => array('BankAccount.company_id' => $purchase['Company']['id'])));
					
					# Banesco Banco Universal C.A - Nº 1222-1110-2223-2222  
					# Mercantil C.A Nº 1222-1110-2223-2222

					# http://www.php.net/manual/es/function.chunk-split.php#97158
					function mbStringToArray ($str) {
						if (empty($str)) return false;
						$len = mb_strlen($str);
						$array = array();
						for ($i = 0; $i < $len; $i++) {
							$array[] = mb_substr($str, $i, 1);
						}
						return $array;
					}

					function mb_chunk_split($str, $len, $glue) {
						if (empty($str)) return false;
						$array = mbStringToArray ($str);
						$n = -1;
						$new = '';
						foreach ($array as $char) {
							$n++;
							if ($n < $len) $new .= $char;
							elseif ($n == $len) {
								$new .= $glue . $char;
								$n = 0;
							}
						}
						return $new;
					}
					# end

					
					if($bankAccounts){
						foreach($bankAccounts as $k=>$v){							
							$banksName[$v['Bank']['id']] = $v['Bank']['name']; 
						} 
						foreach($banksName as $k => $v){
							foreach($bankAccounts as $k2=>$v2){
								if($k == $v2['Bank']['id']){									
									$bankAccountsData[$v2['BankAccount']['id']] = $v.' - Nº '.mb_chunk_split($v2['BankAccount']['number'], 4, '-');									
								}
							}
						}
					}
					
					
					
					
					$this->loadModel('Company');
					$company = $this->Company->find('first', array('conditions' => array('Company.id' => $purchase['Company']['id'])));
					
					
					$this->set(compact('purchase','bankAccountsData','company'));

					if($this->request->data){
						
						
						$this->request->data['Payment']['id'] =  $purchase['Payment']['id'];
						$this->request->data['Billing']['id'] =  $purchase['Billing']['id'];
						
						//debug($this->request->data);
						
						if($this->Payment->saveAssociated($this->request->data)){
							
							$this->redirect('/my_purchases');

						}
						
					}else{
						
						$this->request->data = $purchase;
						
					}	
						
						
				}else{
				
					$this->redirect('/my_purchases');
					
				}		
				
			
		}
		
	}
	
	
}

//$this->redirect($this->referer());

?>
