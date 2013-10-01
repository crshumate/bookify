<?php
class CharquestsController extends AppController {
	public $theme = 'Book';
	
	public function beforeFilter(){
	parent::beforeFilter();

	}
	
	public function admin_create(){
 		$cqt = $this->Charquest->CharquestType->find('all');
        $typeOptions = array();
		foreach($cqt as $t){
			$id=$t['CharquestType']['id'];
			$type=$t['CharquestType']['type'];
			$typeOptions[$id]=$type;
		}
		$this->set('typeOptions', $typeOptions);
		if($this->request->is('post')){
			$data=$this->request->data;
			if($saved=$this->Charquest->Save($data)){
				$this->Session->setFlash('Question saved!');
				$this->redirect('');
				
			}
			
		}
	
	
	}
	
	
}

?>