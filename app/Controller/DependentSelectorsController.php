<?php class DependentSelectorsController extends AppController{

	// Controlador para ejecutar la solicitud ajax

	public $uses = array();		
		
	public function selectAjaxRequest(){
	
		$currentModel = $this->request->query['currentModel'];
		
		foreach($this->request->query as $k => $v){
			if($k !='currentModel'){
				$newThisrRequestQuery[$k] = $v; 
			}
		}	
		
		$this->request->query = null;
		$this->request->query = $newThisrRequestQuery;
		
		$this->selectoresDependientes($currentModel);
			
	}

	
	
}?>
