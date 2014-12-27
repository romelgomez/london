<?php
// $this->redirect($this->referer());

	class PurchasesController extends AppController{
				
		/*
		 * Ruta: '/select_this_delivery_address/*' 
		 * Fin: selecionar la dirección a donde sera enviada la compra. 
		 * Descricion: esta función recibe el id de la compra y de la dirección precargada, los valida, los establece y luego redirecciona a la vista de compras realizadas.  
		 * Parmetros:  
		 * 	$purchase_id	- el id de la compra	- entero
		 * 	$address_id		- el id de la dirección	- entero
		 * Retorna:
		 * 	nada
		 * 
		*/		
		public function selectThisDeliveryAddress($purchase_id=null,$address_id=null){
			$this->loadModel('Address');
			if($purchase_id && $address_id){
				$purchaseData	= $this->Purchase->find('first',array(
																'conditions' => array('Purchase.id'=>$purchase_id,'Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.deleted'=>0)
															)
				);
				$addressData	= $this->Address->find('first',array(
																	'conditions' => array('Address.id'=>$address_id,'Address.user_id' => $this->userLogged['User']['id'],'Address.deleted'=>0)
																)
				);
				if($purchaseData && $addressData){
					$data = array(
						'Purchase' => array(
										'id' 			=> $purchase_id,
										'address_id' 	=> $address_id
									)
					);
					if($this->Purchase->save($data)){
						$this->redirect('/my_purchases');
					}								
				}else{
					$this->redirect('/my_purchases'); 	
				}
			}
		}	
		
		
		/*
		 * Ruta: '/edit_the_delivery_address/*' 
		 * Fin: selecionar la dirección a donde sera enviada la compra o cargar una.
		 * Descricion: esta función debe retornar todas las direcciones activas cargadas por el cliente y el id de la compra. si el paramtro $process proveniente de la accion de enviar el formuario es verdara, se procesa. 
		 * Parmetros:  
		 * 	$purchase_id	- el id de la compra	- entero
		 * 	$process		- si se procesa			- boleano, 1 o 0 
		 * Retorna:
		 * 	$addresses		- direciones activas 	- array
		 *	$purchase_id	- el id de la compra	- entero
		 * 
		*/
		public function editTheDeliveryAddress($purchase_id=null,$process=null){
			if($this->Auth->User()){
				$this->loadModel('Address');
				
				if($process){
					if($this->request->data){
						$dataAddress=	array(	
							'Address' => array
								(
									'user_id' 					=> $this->userLogged['User']['id'],
									'country_id' 				=> $this->request->data['Address']['country_id'],
									'state_id' 					=> $this->request->data['Address']['state_id'],
									'city_id' 					=> $this->request->data['Address']['city_id'],
									'name' 						=> $this->request->data['Address']['name'],
									'address' 					=> $this->request->data['Address']['address'],
									'additional_information' 	=> $this->request->data['Address']['additional_information'],
									'phones' 					=> $this->request->data['Address']['phones']
								)
						);
						if($this->Address->save($dataAddress)){
							$dataPurchase = array(
								'Purchase' => array 
								(
									'id' 			=> $this->request->data['Purchase']['id'],
									'address_id'	=> $this->Address->id
								)
							);
							if($this->Purchase->save($dataPurchase)){
									$this->redirect('/my_purchases');
							}	
						}
					}
				}
				
				$addresses = $this->Address->find('all',array(
															'conditions' => array('Address.user_id' => $this->userLogged['User']['id'],'Address.deleted'=>0)
														)
												);
				$this->set(compact('addresses','purchase_id'));
			}
		}
		
		
		
		
		public function filed($id){
			if($this->Auth->User()){
			
				$purchases = $this->Purchase->find('first',array(
																'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.filed'=>0,'Purchase.id'=>$id)
															)
													);
				if($purchases){
					
					$data = array ('Purchase' => Array (
						'id' => $purchases['Purchase']['id'],
						'filed' => 1
					));
					
					$this->Purchase->save($data);
					$this->redirect('/my_purchases');
					
				}else{
					$this->redirect('/my_purchases');
				}
			}	
		}		
		
		public function deleted($id,$yes=null){
			if($this->Auth->User()){
				$purchases = $this->Purchase->find('first',array(
																'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.deleted'=>0,'Purchase.id'=>$id)
															)
													);
				if($purchases){
					//debug($yes);
					if($yes){
						$data = array ('Purchase' => Array (
							'id' => $purchases['Purchase']['id'],
							'deleted' => 1
						));
						$this->Purchase->save($data);
						$this->redirect('/my_purchases');
					}
					$this->set(compact('id'));
				}else{
					$this->redirect('/my_purchases');
				}
			}
		}
		
		
		public function viewFiled(){
			
				if($this->Auth->User()){
				
				############################### FUNCIONES #################################### 
				# Esta funcion identifica las fechas unicas que existen, es solo para purchase. 
				function uniqueDate($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[0];
					}
					return array_unique($arrayB);
				}
				function uniqueHour($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[1];
					}
					return array_unique($arrayB);
				}
				
				
				function shortDate($a){
					$b = explode(" ",$a);
					return $b[0];	
				}
				
				function shortHour($a){
					$b = explode(" ",$a);
					return $b[1];	
				}
				############################### FUNCIONES ####################################
				
				
				
				$purchasesDesc = $this->Purchase->find('all',array(
																'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.filed'=>1,'Purchase.deleted'=>0),
																'order' => array('Purchase.created DESC')
														)
												);
												
											
				if($purchasesDesc){
					
					//debug($purchasesDesc);
					
					
					################################ Image ###########################################	
					foreach($purchasesDesc as $k=>$v){
							foreach($v['PurchasedProduct'] as $k2=>$v2){
								
								$imagen = $this->Image->find('all', array('conditions' => array('Image.product_id' => $v2['product_id'],'Image.deleted'=>0)));
								
									foreach($imagen as $imagenKey => $imagenValues){
										$infoValues['Image'][$imagenKey] = $imagenValues['Image'];
									}								
								
							$purchasesDesc[$k]['PurchasedProduct'][$k2]['Image'] = $infoValues['Image'];
							
								
						}
					}
					################################ End Image ###########################################
					
					$this->loadModel('Store');
					foreach($purchasesDesc as $k=>$v){
						
							   $storeData = $this->Store->find('first', array('conditions' => array('Store.id' => $v['Store']['id'])));
						
							$purchasesDesc[$k]['Store']['stateName'] = $storeData['State']['name'];
							$purchasesDesc[$k]['Store']['cityName'] = $storeData['City']['name'];
							
					}
					
					//debug($purchasesDesc);
					
					
					
						$date = uniqueDate($purchasesDesc);
						$hour =	uniqueHour($purchasesDesc);			
						
						foreach($purchasesDesc as $purchasesDescValue){
							foreach($date as $dataValue){# date  ~ [0] => 2011-10-24 ~ fechas Unicas - el key no es relevante.
								if($dataValue == shortDate($purchasesDescValue['Purchase']['created'])){
									$face1[$dataValue][] = $purchasesDescValue;
								}
							}
						}	
						
						foreach($face1 as $date => $product){
							
							foreach($product as $productK => $productV){
								
								foreach($hour as $hourValue){# hour [0] => 07:36:01 ~ horas unicas -  el key no es relevante.
									if($hourValue == shortHour($productV['Purchase']['created'])){
										 $face2[$date][$hourValue][$productK] = $productV;
									}
								}						 
								
								
							} 
							
						} 
					
						foreach($face2 as $dia=>$data){
							$face3[$dia] = array_reverse($data);
						} 
						
						foreach($face3 as $date => $data){
							foreach($data  as $hour => $info){
								foreach($info as $infoKey => $infoValues){
										//debug($infoValues);
										
										
										$purchases[$date][$infoValues['Company']['name']][$infoValues['Store']['name']][$hour][$infoKey] = $infoValues;								

										
								}
							}
						}	
				
						$this->set(compact('purchases'));	
				
				}else{
					
					$this->set('purchases',false);
				}					
			}
			
		}
		
		
		public function index(){


			if($this->Auth->User()){
				
				############################### FUNCIONES #################################### 
				# Esta funcion identifica las fechas unicas que existen, es solo para purchase. 
				function uniqueDate($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[0];
					}
					return array_unique($arrayB);
				}
				function uniqueHour($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[1];
					}
					return array_unique($arrayB);
				}
				
				
				function shortDate($a){
					$b = explode(" ",$a);
					return $b[0];	
				}
				
				function shortHour($a){
					$b = explode(" ",$a);
					return $b[1];	
				}
				############################### FUNCIONES ####################################
								
			
				$purchasesDesc = $this->Purchase->find('all',array(
																'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.filed'=>0,'Purchase.deleted'=>0),
																'order' => array('Purchase.created DESC')
														)
												);
				
												
				$filed = $this->Purchase->find('count',array(
																'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'Purchase.filed'=>1,'Purchase.deleted'=>0)
														)
												);
												
				$this->set(compact('filed'));								
												
											
				if($purchasesDesc){
					
					//debug($purchasesDesc);
					
					
					################################ Image ###########################################	
					foreach($purchasesDesc as $k=>$v){
							foreach($v['PurchasedProduct'] as $k2=>$v2){
								
								$imagen = $this->Image->find('all', array('conditions' => array('Image.product_id' => $v2['product_id'],'Image.deleted'=>0)));
								
									foreach($imagen as $imagenKey => $imagenValues){
										$infoValues['Image'][$imagenKey] = $imagenValues['Image'];
									}								
								
							$purchasesDesc[$k]['PurchasedProduct'][$k2]['Image'] = $infoValues['Image'];
							
								
						}
					}
					################################ End Image ###########################################
					
					$this->loadModel('Store');
					foreach($purchasesDesc as $k=>$v){
						
							   $storeData = $this->Store->find('first', array('conditions' => array('Store.id' => $v['Store']['id'])));
						
							$purchasesDesc[$k]['Store']['stateName'] = $storeData['State']['name'];
							$purchasesDesc[$k]['Store']['cityName'] = $storeData['City']['name'];
							
					}
					
					
					$this->loadModel('Address');
					foreach($purchasesDesc as $k=>$v){
					
						if($v['Address']['id']){		
							   $addressData = $this->Address->find('first', array('conditions' => array('Address.id' => $v['Address']['id'])));
						
							$purchasesDesc[$k]['Address']['stateName'] = $addressData['State']['name'];
							$purchasesDesc[$k]['Address']['cityName'] = $addressData['City']['name'];
							
						}	
					}
					
					
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
					
					
					
					$this->loadModel('Payment');
					foreach($purchasesDesc as $k=>$v){
					
						if($v['Payment']['id']){		
							   $paymentData = $this->Payment->find('first', array('conditions' => array('Payment.id' => $v['Payment']['id'])));
						
							if($paymentData['BankAccount']['number']){
						
								$purchasesDesc[$k]['Payment']['bankAccountIdName'] = ' Nº '.mb_chunk_split($paymentData['BankAccount']['number'], 4, '-');
							
							}else{
								
								$purchasesDesc[$k]['Payment']['bankAccountIdName'] = 'Sin definir ahun';
								
							}
							
							switch($paymentData['Payment']['transaction_type']){
								case 1:
									$purchasesDesc[$k]['Payment']['transactionTypeName'] = 'Deposito';
									break;
								case 2:
									$purchasesDesc[$k]['Payment']['transactionTypeName'] = 'Tranferencia';
									break;
								case null:
									$purchasesDesc[$k]['Payment']['transactionTypeName'] = 'Sin definir ahun';
									break;
							}
							
						}	
					}
					
								
					function myTruncate($string, $limit, $break='.', $pad='…'){
						if(strlen($string) <= $limit)
						return $string;
						if(false !== ($breakpoint = strpos($string, $break, $limit))){
							if($breakpoint < strlen($string) - 1) {
								$string = substr($string, 0, $breakpoint).$pad;
							}
						}
						return $string;
					}
								
					
					
					//debug($purchasesDesc);
					
					
					
						$date = uniqueDate($purchasesDesc);
						$hour =	uniqueHour($purchasesDesc);			
						
						foreach($purchasesDesc as $purchasesDescValue){
							foreach($date as $dataValue){# date  ~ [0] => 2011-10-24 ~ fechas Unicas - el key no es relevante.
								if($dataValue == shortDate($purchasesDescValue['Purchase']['created'])){
									$face1[$dataValue][] = $purchasesDescValue;
								}
							}
						}	
						
						foreach($face1 as $date => $product){
							
							foreach($product as $productK => $productV){
								
								foreach($hour as $hourValue){# hour [0] => 07:36:01 ~ horas unicas -  el key no es relevante.
									if($hourValue == shortHour($productV['Purchase']['created'])){
										 $face2[$date][$hourValue][$productK] = $productV;
									}
								}						 
								
								
							} 
							
						} 
					
						foreach($face2 as $dia=>$data){
							$face3[$dia] = array_reverse($data);
						} 
						
						foreach($face3 as $date => $data){
							foreach($data  as $hour => $info){
								foreach($info as $infoKey => $infoValues){
										//debug($infoValues);
										
										
										$purchases[$date][$infoValues['Company']['id']][$infoValues['Store']['id']][$hour][$infoKey] = $infoValues;								
									//	$purchases[$date][$infoValues['Company']['name']][$infoValues['Store']['name']][$hour][$infoKey] = $infoValues;								

										
								}
							}
						}	
				
				
				//debug($purchases);
				
						$this->set(compact('purchases'));	
				
				}else{
					
					$this->set('purchases',false);
				}					
			}

		}
		




		public $created = null; // PARCHE
		public $modified = null; // PARCHE
		
		
		public function add(){
			if($this->Auth->User()){
				
				
				$cart = $this->Cart->find('all', array('conditions' => array('Cart.user_id' => $this->userLogged['User']['id'])));
			
				function uniqueIdCompany($array){ foreach($array as $value){ $allProductCompanies[] = $value['Product']['company_id']; } return array_unique($allProductCompanies); }
				$companies = uniqueIdCompany($cart);

				
				foreach($companies as $companyId){
					foreach($cart as $key=> $value ){
						
						if($companyId == $value['Product']['company_id']){
							
							$dataPurchase[$companyId]['Purchase']['user_id'] =  $this->userLogged['User']['id'];
							$dataPurchase[$companyId]['Purchase']['company_id'] =  $value['Product']['company_id'];
							$dataPurchase[$companyId]['Purchase']['store_id'] =  $value['Product']['store_id'];
							
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['product_id'] = $value['Product']['id'];
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['store_id'] = $value['Product']['store_id'];
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['title'] = $value['Product']['title'];
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['body'] = $value['Product']['body'];
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['price'] = $value['Product']['price'];
							$dataPurchase[$companyId]['PurchasedProduct'][$key]['quantity'] = $value['Cart']['quantity'];
													
							$remainder = $value['Product']['quantity'] - $value['Cart']['quantity'];
							
							$productUpdate[$companyId]['Product'][$key]['id'] = $value['Product']['id'];
							$productUpdate[$companyId]['Product'][$key]['quantity'] = $remainder;
							
						}
					}
				}
				
				//debug($productUpdate);
				
				$this->loadModel('Product');
				
				//debug($dataPurchase);
				
				foreach($dataPurchase as $companyId=>$purchasedProduct){			
					
					if($this->created){ $purchasedProduct['Purchase']['created'] = $this->created; $purchasedProduct['Purchase']['modified'] = $this->modified; }	// PARCHE
					
					if($this->Purchase->saveAll($purchasedProduct)){	
						
						$data = $this->Purchase->read();
						if(!$this->created){ $this->created = $data['Purchase']['created'];  $this->modified = $data['Purchase']['modified']; } // PARCHE
						
						$this->Product->saveAll($productUpdate[$companyId]['Product']);
					
						// Cart Delete
						foreach($cart  as $cartKey => $cartValues){
							foreach($productUpdate[$companyId]['Product'] as $k=>$v){
								if($cartValues['Cart']['product_id'] == $v['id']){ 
									$this->Cart->id = $cartValues['Cart']['id'];
									$this->Cart->delete();
								}
							}
						}
						
						// email send
						
					}
				}
	
	
				// 2.0 -- saveAll cambia de nombre
				/*
				$this->loadModel('Product');
				if($this->Purchase->saveAll($dataPurchase)){	
						$this->Product->saveAll($productUpdate);
						foreach($cart  as $cartKey => $cartValues){
							$this->Cart->id = $cartValues['Cart']['id'];
							$this->Cart->delete();
						}
				}	
				*/
				
				$this->redirect('/your_account');	

				
			}
		}// end add
		
		
		function soldProducts(){
		
			if($this->Auth->User()){
				
				
				$this->loadModel('Company');
				$company = $this->Company->findById($this->userLogged['User']['company_id']); // seler
				
				//debug($company);
				
				############################### FUNCIONES #################################### 
				# Esta funcion identifica las fechas unicas que existen, es solo para purchase. 
				function uniqueDate($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[0];
					}
					return array_unique($arrayB);
				}
				function uniqueHour($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Purchase']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[1];
					}
					return array_unique($arrayB);
				}
				
				
				function shortDate($a){
					$b = explode(" ",$a);
					return $b[0];	
				}
				
				function shortHour($a){
					$b = explode(" ",$a);
					return $b[1];	
				}
				############################### FUNCIONES ####################################
				
				########################################## DESC ######################################################################
				$purchasesDesc = $this->Purchase->find('all',array(
																'conditions' => array('Purchase.company_id' => $company['Company']['id']),
																'order' => array('Purchase.created DESC')
														)
												);
	
					################################ Image ###########################################	
					foreach($purchasesDesc as $k=>$v){
							foreach($v['PurchasedProduct'] as $k2=>$v2){
								
								$imagen = $this->Image->find('all', array('conditions' => array('Image.product_id' => $v2['product_id'],'Image.deleted'=>0)));
								
									foreach($imagen as $imagenKey => $imagenValues){
										$infoValues['Image'][$imagenKey] = $imagenValues['Image'];
									}								
								
							$purchasesDesc[$k]['PurchasedProduct'][$k2]['Image'] = $infoValues['Image'];
							
								
						}
					}
					################################ End Image ###########################################
								
				//debug($purchasesDesc);								

				if($purchasesDesc){		
					/*	$purchasesDesc
						Array
						(
							[0] => Array
								(
									[Purchase] => Array
										(
											[id] => 15
											[user_id] => 4
											[product_id] => 28
											[quantity] => 7
											[created] => 2011-10-24 07:36:01
											[modified] => 2011-10-24 07:36:01
										)
									... 
						el key no es relevante.
						foreach($purchasesDesc as $purchasesDescValue){
						} 
					*/				
								
						$date = uniqueDate($purchasesDesc);
						$hour =	uniqueHour($purchasesDesc);			
						
						foreach($purchasesDesc as $purchasesDescValue){
							foreach($date as $dataValue){# date  ~ [0] => 2011-10-24 ~ fechas Unicas - el key no es relevante.
								if($dataValue == shortDate($purchasesDescValue['Purchase']['created'])){
									$face1[$dataValue][] = $purchasesDescValue;
								}
							}
						}

					/*				
						Array
						(
							[2011-10-24] => Array
								(
									[0] => Array
										(
											[Purchase] => Array
												(
													[id] => 15
													[user_id] => 4
													[product_id] => 28
													[quantity] => 7
													[created] => 2011-10-24 07:36:01
													[modified] => 2011-10-24 07:36:01
												)
					*/
						
						foreach($face1 as $date => $product){
							
							foreach($product as $productK => $productV){
								
								foreach($hour as $hourValue){# hour [0] => 07:36:01 ~ horas unicas -  el key no es relevante.
									if($hourValue == shortHour($productV['Purchase']['created'])){
										 $face2[$date][$hourValue][$productK] = $productV;
									}
								}						 
								
								
							} 
							
						} 

						/*	
						[2011-10-24] => Array
							(
								[07:36:01] => Array
									(
										[0] => Array
											(
												[Purchase] => Array
													(
														[id] => 15
														[user_id] => 4
														[product_id] => 28
														[quantity] => 7
														[created] => 2011-10-24 07:36:01
														[modified] => 2011-10-24 07:36:01
													)
						*/
						
						foreach($face2 as $dia=>$data){
							$face3[$dia] = array_reverse($data);
						} 
						
						/* face 3 - la hora queda en orden acendente. 7,8,9 ... 
						Array
						(
							[2011-10-24] => Array
								(
									[07:34:09] => Array
										(
											[1] => Array
												(
													[Purchase] => Array
														(
															[id] => 14
															[user_id] => 4
															[product_id] => 37
															[quantity] => 7
															[created] => 2011-10-24 07:34:09
															[modified] => 2011-10-24 07:34:09
														)
													[User]
													[Product]
													[UserSeler] -> falta
													[Image] -> falta
												)		
										)
									[07:36:01]
						*/				
						
						
						foreach($face3 as $date => $data){
							foreach($data  as $hour => $info){
								foreach($info as $infoKey => $infoValues){

										$soldProducts[$date][$infoValues['User']['name']][$hour][$infoKey] = $infoValues;								
								}
							}
						}
						
						//debug($soldProducts);
						
						$this->set(compact('soldProducts'));
				}else{
					$this->set('soldProducts',false);
				}
				
											
			}
			
		
		}	
		
	}
	

?>
