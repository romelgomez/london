<?php 

	Class RatingOfPurchasesController extends AppController{
	
		public $name = 'RatingOfPurchases';
	
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
				
									
			

				$this->loadModel('Purchase');
				$purchasesDesc = $this->Purchase->find('all',array(
																	'conditions' => array('Purchase.user_id' => $this->userLogged['User']['id'],'RatingOfPurchase.purchase_id'=>NULL),
																	'order' => array('Purchase.created DESC')
																	));
				
											
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
				
					//debug($purchases);
				
				}else{
					
					$this->set('purchases',false);
				}					
			}
		}
		
		public function add(){
		
			if($this->Auth->User()){
				
				
				if($this->data){
					
					foreach($this->data as $k => $v){
						foreach($v as $k2=>$v2){
							
							//debug($v2);
							if($v2['RatingOfPurchase']['rating']){
								
								$v2['RatingOfPurchase']['user_id'] = $this->userLogged['User']['id'];
								
								$this->RatingOfPurchase->saveAll($v2);
								
								
								
							}
							
						}
					}
					
					$this->redirect('/my_purchases');
					
				}
			}
		}
		
		public function edit($id=null){
		
				if($this->Auth->User()){
					if(!$this->data){
					
						$this->loadModel('Purchase');
						$purchasesDesc = $this->Purchase->find('first',array(
																		'conditions' => array('Purchase.id' => $id,'Purchase.user_id' => $this->userLogged['User']['id'],'RatingOfPurchase.purchase_id !='=>NULL)
																		));
					
						if($purchasesDesc){
							
							$this->loadModel('RatingOfPurchasedProduct');
							################################ RatingOfPurchasedProduct ###########################################		
							foreach($purchasesDesc['PurchasedProduct'] as $k2=>$v2){
									$ratingOfPurchasedProduct = $this->RatingOfPurchasedProduct->find('first', array('conditions' => array('RatingOfPurchasedProduct.rating_of_purchase_id' => $purchasesDesc['RatingOfPurchase']['id'],'RatingOfPurchasedProduct.product_id'=>$v2['product_id'])));
									
									$purchasesDesc['PurchasedProduct'][$k2]['RatingOfPurchasedProduct']['id'] = $ratingOfPurchasedProduct['RatingOfPurchasedProduct']['id'];
									$purchasesDesc['PurchasedProduct'][$k2]['RatingOfPurchasedProduct']['well_packaged'] = $ratingOfPurchasedProduct['RatingOfPurchasedProduct']['well_packaged'];
									$purchasesDesc['PurchasedProduct'][$k2]['RatingOfPurchasedProduct']['as_described'] = $ratingOfPurchasedProduct['RatingOfPurchasedProduct']['as_described'];
							}
							################################ RatingOfPurchasedProduct ###########################################		
						
							################################ Image ###########################################		
							foreach($purchasesDesc['PurchasedProduct'] as $k2=>$v2){
									$imagen = $this->Image->find('all', array('conditions' => array('Image.product_id' => $v2['product_id'],'Image.deleted'=>0)));
									
										foreach($imagen as $imagenKey => $imagenValues){
											$infoValues['Image'][$imagenKey] = $imagenValues['Image'];
										}								
									
									$purchasesDesc['PurchasedProduct'][$k2]['Image'] = $infoValues['Image'];
							}
							################################ End Image ###########################################		
							
							$this->loadModel('Store');
							$storeData = $this->Store->find('first', array('conditions' => array('Store.id' => $purchasesDesc['Store']['id'])));
								
							$purchasesDesc['Store']['stateName'] = $storeData['State']['name'];
							$purchasesDesc['Store']['cityName'] = $storeData['City']['name'];
							
							$this->data = $purchasesDesc;
							
							//debug($this->data);
							
						}else{
							$this->redirect('/my_purchases');
						}
					}else{
						if($this->Auth->User()){
							
							if($this->request->data['RatingOfPurchase']['rating']){
								if($this->RatingOfPurchase->saveAll($this->request->data)){
								}
							}
							$this->redirect('/my_purchases');
							
						}
					}
				}
		}
		
	}

?>
