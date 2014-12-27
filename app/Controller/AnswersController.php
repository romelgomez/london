<?php Class AnswersController extends AppController{

	public function beforeFilter(){
			
		$this->Auth->allow('respond');
		parent::beforeFilter();				
	
	}

	public function respond(){
		if($this->Auth->loggedIn()){
			
			$request = $this->request->query;
			
			$this->Answer->set($request);
			if($this->Answer->validates()){

				$data = Array(
					'Answer' => Array
						(
							'user_id'		=> $this->userLogged['User']['id'],
							'question_id'	=> $request['question_id'],
							'body'			=> $request['body']
						)
				);

				// se guarda y se envia ok
				if($this->Answer->save($data)){
					$return['id'] 		= $request['question_id'];
					$return['body'] 	= $request['body'];
					$return['result']	= 'ok';
				}
				
			}else{
				// se envia los campos faltantes.
				$errors = $this->Answer->validationErrors;
				foreach($errors as $k=>$v){
					$tmp = 'answer_'.$k;
					$return[Inflector::camelize($tmp).'_'.$request['question_id']] = $v[0];
				}
			}
			
		}
		if(!isset($return)){
			$return['login'] = true;
		}
		$this->set('return',$return);
		$this->render('ajax_view','ajax');
	}
	
}
