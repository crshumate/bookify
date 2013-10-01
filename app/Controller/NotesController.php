<?php
class NotesController extends AppController {
	public $theme='Book';
	
	public function beforeFilter(){
	parent::beforeFilter();	
		
	}
	
	
	public function create(){
		$uid = $this->Auth->user('id');
		$stories = $this->Note->Story->find('all', array(
			'condition'=>array(
				'Story.user_id'=>$uid
				),
				'fields'=>array(
				 'Story.id',
				'Story.title'	
				),
				'recursive'=>-1
			)
		);
		$storyOptions = array();
		foreach($stories as $i=>$story){
			$storyOptions[$story['Story']['id']]=$story['Story']['title'];
		}
		$this->set('storyOptions', $storyOptions);
		
		if($this->request->is('post')){
			$data=$this->request->data;
			$data['Note']['user_id']=$uid;
			if($saved=$this->Note->save($data)){
				$this->Session->setFlash('Note Saved!');
				$this->redirect('');
				
			}
		}
		
	}
}


?>