<?php
class CharactersController extends AppController {
		public $theme = 'Book';
	
	public function beforeFilter(){
	
	
		
	}
	
	public function create(){
		$allCtypes = $this->Character->CharacterType->find('all', array(
			'fields'=>array('CharacterType.id', 'CharacterType.type')));
		
		$ctypes=array();	
			
			foreach($allCtypes as $type){
			$ctypes[$type['CharacterType']['id']]=$type['CharacterType']['type'];	
			}
	
			$this->set('ctypes', $ctypes);
		
		if($this->request->is('post')){
			$data=$this->request->data;			
			$data['Character']['story_id']=CakeSession::read('storyId');
			if($saved=$this->Character->save($data)){
				$hash = substr(md5($saved['Character']['id']),0,8);
				$this->Session->setFlash('Character Saved');
				$this->redirect(array('controller'=>'charans','action'=>'character_profile', 'id'=>$hash));
			}
		}
	}
	
	
	public function view(){
	$storyId=CakeSession::read('storyId');
	$characters = $this->Character->find('all', array(
		'conditions'=>array(
			'Character.story_id'=>$storyId)
		)
	);
	$this->set('characters', $characters);
	 	
		
	}
	public function profile(){
		
	}
	
	public function character_ajax_profile(){
		$this->autoRender=false;
		
		if($this->request->is('post')){

			$data=$this->request->data;
			$character = $this->Character->find('first', array('conditions'=>array('Character.hash'=>$data['Character']['hash'])));
			$data['Character']['id']=$character['Character']['id'];
			
			if($saved=$this->Character->save($data)){
               echo 'success';

			}else {
				echo'fail';
			}

		}	
		
	}
	
	public function delete($id=null){
		$this->autoRender=false;
		$character = $this->Character->findByHash($id);
		if($deleted=$this->Character->delete($character['Character']['id'])){
				$this->Session->setFlash('Character Succesfully Deleted');
				$this->redirect(array('action'=>'view'));
		}
	
		
		
	}
	
	
}

?>