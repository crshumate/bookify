<?php
class CharansController extends AppController {
	public $theme='Book';
	
	public function beforeFilter(){
			
		
	}
	
	
	
	public function character_profile($id=null){
		$questionType = $this->Charan->Charquest->CharquestType->find('all');
		$questions=$this->Charan->Charquest->find('all');
		
		$answers = $this->Charan->find('all', array('recursive'=>-1,'conditions'=>array('Charan.character_hash'=>$id)));
		$this->set('answers', $answers);
		$character = $this->Charan->Character->find('first', array('conditions'=>array('Character.hash'=>$id)));
		$this->set('cContent', $character['CharacterType']['description']);
		$this->set('character', $character);
			
		
		$sortedQuestions=array();
	
	
		foreach($questionType as $type){
			$i=0;
			$typeId = $type['CharquestType']['id'];
			$typeTitle = $type['CharquestType']['type'];
			$typeDescription = $type['CharquestType']['description'];
			$sortedQuestions[$typeTitle]['description']=$typeDescription;
			$sortedQuestions[$typeTitle]['questions']=array();
		
			
			foreach($questions as $question){
				if($question['Charquest']['charquest_type_id']==$typeId){
					$sortedQuestions[$typeTitle]['questions'][$i]=$question['Charquest'];	
					$i+=1;
					
				}
				
			}
			
			
		}
		$this->set('sortedQuestions', $sortedQuestions);
			
	}
	
	public function ajax_create(){
		$this->autoRender=false;
		if($this->request->is('post')){
			$data=$this->request->data;
			$answer = $this->Charan->find('first', array(
				'conditions'=>array(
				'Charan.charquest_id'=>$data['Charan']['charquest_id'], 
				'Charan.character_hash'=>$data['Charan']['character_hash'])));
				$character=$this->Charan->Character->find('first', array('conditions'=>array('Character.hash'=>$data['Charan']['character_hash'])));		
			$data['Charan']['character_id']=$character['Character']['id'];
			
			if(!empty($answer)){
				$data['Charan']['id']=$answer['Charan']['id'];	
			}
			
			
			if($saved=$this->Charan->save($data)){
               echo $saved['Charan']['id'];

			}else {
				echo'fail';
			}

		}
		
	}
	
}

?>