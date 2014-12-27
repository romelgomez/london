<?php 
	Class QuestionsController extends AppController{
		

//el vendedor puede ser comprador 
//el comprador puede ser vendedor

//ambos acceden a un metodo index, para saber si.

/*
#como comprador 
ver las preguntas que realizo. y si han sido respondida. 
#como vendedor
tienen preguntas por responder. de tenerlas las responde. 

---------------------------------------------------------
Ambas estan relacionadas con un producto.

el comprador debe buscar las preguntas en funcion a:
el id sea igual al suyo
* 
el vendedor debe buscar las preguntas en funcion a:
Product.user_id es igual al id con que el usuario, en este caso vendedor se logeo. como los modelos estan realcionados, cakephp permite este 
tipo de busquedas.

en este punto son dos consultas, obligatorias.

		//User.id es id del comprador.
		//Product.user_id es el id del vendedor.

---------------------------------------------------------
como sabe el usuario. 

como vendedor tiene preguntas por responder. 
estos resultados se analizan en la vista y si el modelo [respuesta] esta vacio. es por que esa pregunta no ha sido respondida por el.

como comprador tiene preguntas que no han sido respondidas.
estos resultados se analizan en la vista. y si el modelo [respuesta] esta vacio. es por que su pregunta no ha sido respondida por el vendedor.

en este momento tenemos dos analizis.

*/

	public function beforeFilter(){
			
		$this->Auth->allow('add');
			
		parent::beforeFilter();				
	
	}

	public function index(){
		if($this->Auth->User()){
				
				
				############################### FUNCIONES #################################### 
				# Esta funcion identifica las fechas unicas que existen. 
				#nota: estas funciones cambian segun el array. es solo una cosa. 
				function uniqueDate($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Question']['created']);
					}
					foreach($arrayA as $arrayAValue){
						$arrayB[] = $arrayAValue[0];
					}
					return array_unique($arrayB);
				}
				function uniqueHour($array){
					foreach($array as $arrayValue){
						$arrayA[] = explode(" ", $arrayValue['Question']['created']);
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
				
	
				#como comprador
				########################################################## COMO COMPRADOR #######################################################################

				#1) ver las preguntas que realizo.
				//el id sea igual al suyo
					
					$clientConditions2 = array(
						'conditions' => array('Question.user_id' => $this->userLogged['User']['id']),
						'contain' => array(
							'User'=>array(
								'fields' => array('id','name','family_name'),
							),
							'Product'=>array(
								'fields' => array('id','company_id','user_id','title','price','created','modified'),
								'Company'=>array(
									'fields' => array('id','name','type'),
								),
								'Image' => array(
									'conditions' => array('Image.deleted' => 0),
									'limit' => 1
								)
							),
							'Answer'							
						)
					);
					
					$client2	= $this->Question->find('all',$clientConditions2);
					//debug($client2);
					
					if($client2){
						$date = uniqueDate($client2);
						$hour =	uniqueHour($client2);		
						# Organisa por fecha.	
						foreach($client2 as $selerValue){
							foreach($date as $dataValue){# date  ~ [0] => 2011-10-24 ~ fechas Unicas - el key no es relevante.
								if($dataValue == shortDate($selerValue['Question']['created'])){
									$face1[$dataValue][] = $selerValue;
								}
							}
						}
						# Organisa por hora
						foreach($face1 as $date => $product){
							foreach($product as $productK => $productV){
								foreach($hour as $hourValue){# hour [0] => 07:36:01 ~ horas unicas -  el key no es relevante.
									if($hourValue == shortHour($productV['Question']['created'])){
										 $face2[$date][$hourValue][$productK] = $productV;
									}
								}						 
							} 
						}
						# La hora queda en orden acendente. 7,8,9 ...
						foreach($face2 as $dia=>$data){
							$face3[$dia] = array_reverse($data);
						}
						# Organiso por compañia vendedora.
						foreach($face3 as $date => $data){
							foreach($data  as $hour => $info){
								foreach($info as $infoKey => $infoValues){
									$questionsThatMake[$infoValues['Product']['Company']['name']][$date][$hour][$infoKey] = $infoValues;
								}
							}
						}
						//debug($questionsThatMake);
					}
					
				########################################################### COMO VENDEDOR #######################################################################
				
				#1) ver si tiene preguntas por responder.
					$buyerConditions2 = array(
						'conditions' => array('Product.company_id' => $this->userLogged['User']['company_id'],'Answer.body'=>null),
						'limit' => 2,
						'contain' => array(
							'User'=>array(
								'fields' => array('id','name','family_name'),
							),
							'Product'=>array(
								'fields' => array('id','company_id','user_id','title','price','created','modified'),
								'Company'=>array(
									'fields' => array('id','name','type'),
								),
								'Image' => array(
									'conditions' => array('Image.deleted' => 0),
									'limit' => 1
								)
							),
							'Answer'
						)	
					);
					
					$buyer2 = $this->Question->find('all',$buyerConditions2);
				
					if($buyer2){
						$date = uniqueDate($buyer2);
						$hour =	uniqueHour($buyer2);		
						
						# Organisa por fecha.	
						foreach($buyer2 as $selerValue){
							foreach($date as $dataValue){# date  ~ [0] => 2011-10-24 ~ fechas Unicas - el key no es relevante.
								if($dataValue == shortDate($selerValue['Question']['created'])){
									$face1Seler[$dataValue][] = $selerValue;
								}
							}
						}
						# Organisa por hora
						foreach($face1Seler as $date => $product){
							foreach($product as $productK => $productV){
								foreach($hour as $hourValue){# hour [0] => 07:36:01 ~ horas unicas -  el key no es relevante.
									if($hourValue == shortHour($productV['Question']['created'])){
										 $face2Seler[$date][$hourValue][$productK] = $productV;
									}
								}						 
							} 
						}
						# La hora queda en orden acendente. 7,8,9 ...
						foreach($face2Seler as $dia=>$data){
							$face3Seler[$dia] = array_reverse($data);
						}
						# organiso por comprador
						foreach($face3Seler as $date => $data){
							foreach($data  as $hour => $info){
								foreach($info as $infoKey => $infoValuesBuyer){
										$questionsToAnswer[$infoValuesBuyer['User']['name']][$date][$hour][$infoKey] = $infoValuesBuyer;
								}
							}
						}						
					}
					
			$this->set(compact('questionsThatMake','questionsToAnswer'));
		
		}
	}
		
	public function add(){
		if($this->Auth->loggedIn()){
			$request = $this->request->query;
			$this->Question->set($request);
			if($this->Question->validates()){

				$data = Array(
					'Question' => Array
						(
							'user_id'		=> $this->userLogged['User']['id'],
							'product_id'	=> $request['product_id'],
							'body'			=> $request['body']
						)
				);

				// se guarda y se envia ok
				if($this->Question->save($data)){
					$questionData		= $this->Question->read();
					$return['body']		= $questionData['Question']['body'];
					$return['result']	= 'ok';
				}
				
			}else{
				// se envia los campos faltantes.
				$errors = $this->Question->validationErrors;
				foreach($errors as $k=>$v){
					$tmp = 'question_'.$k;
					$return[Inflector::camelize($tmp)] = $v[0];
				}
			}
		}
		
		if(!isset($return)){
			$return['login'] = true;
		}
		$this->set('return',$return);
		$this->render('add','ajax');
	}
}
?>
