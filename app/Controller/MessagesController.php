<?php class MessagesController extends AppController{

    public function beforeFilter() {
		$this->Auth->allow('index');
		parent::beforeFilter();
    }

	public function index(){
		
	}
	
	public function add(){
		if($this->Auth->loggedIn()){
			$return['allowed'] = true;
		
			if($this->request->is('post')){
				$request = $this->request->data;
			}else{
				$request = $this->request->query; 
			}
			
			$this->Message->set($request);
			if($this->Message->validates()){

				$data = Array(
					'Message' => Array
					(
						'parent_id'		=> null,
						'product_id'	=> $request['product_id'],
						'user_id'		=> $this->userLogged['User']['id'],
						'open'			=> 0,
						'body'			=> $request['body'],
						'deleted'		=> 0
					)
				);

				// se guarda y se envia ok
				if($this->Message->save($data)){
					$return['save'] = true;
				
					$messageData		= $this->Message->read();
					$return['body']		= $messageData['Message']['body'];
				
				}else{
					$return['save'] = false; // ++++++++++++++ ha ocurrido un error +++++++++++++++
				}
				$return['validates'] = true;	
			}else{
				$return['validates'] = false;
				
				// se envia los campos faltantes.
				$errors = $this->Message->validationErrors;
				foreach($errors as $k=>$v){
					$tmp = 'message_'.$k;
					$return['fields'][Inflector::camelize($tmp)] = $v[0];
				}
			}
		
			$this->set('return',$return);
			$this->render('ajax_view','ajax');
		}
	}
	
	
}
?>
