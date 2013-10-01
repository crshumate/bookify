<?php
class StoriesController extends AppController {
	public $theme = 'Book';
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('');	
	
	$plotOptions = $this->Story->Plot->find('all');
		//set options for select
		$options=array(); 
		foreach($plotOptions as $plot){
			$text=str_replace("_", " ", $plot['Plot']['type']);
			$options[$plot['Plot']['id']]=$text;
		    }
		   $this->set('plotOptions', $options);
		$uid=$this->Auth->user('id');
		$stories = $this->Story->find('all', array('conditions'=>array('Story.user_id'=>$uid)));
		$this->set('stories', $stories);

		//Story options for drop down...
		$storyOptions = array();
		$storyOptions[0]='- Select a Story -';
		foreach($stories as $story){
		$storyOptions[$story['Story']['id']]=$story['Story']['title'];	
		}
		$this->set('storyOptions', $storyOptions);
		
		$this->set('storyId',CakeSession::read('storyId'));
	}
	
	public function storySelecter(){
		$this->autoRender=false;
		if($_GET['storyId']){
			$uid = $this->Auth->user('id');
			$storyId = $_GET['storyId'];
			$validStory = $this->Story->find('first', 
			array(
				'conditions'=>array(
					'Story.user_id'=>$uid, 
					'Story.id'=>$storyId
					)
				)
			);
			if($validStory){
				CakeSession::write('storyId', $storyId);
				return 'session';
			}else{
				return 'are you trying to fool me?';
			}
			
			
			}
	}

	public function index(){
		

	}

	
	public function create(){
		$id = $this->Auth->user('id');
		if($this->request->is('post')){
				$data=$this->request->data;
				if($saved=$this->Story->save($data)){
					CakeSession::write('storyId', $saved['Story']['id']);
					$this->Session->setFlash('Story Saved');
					$this->redirect(array('controller'=>'stories', 'action'=>'index'));
				}
			
	
			}
	
	}
	
	
	public function edit() {
	   $id = CakeSession::read('storyId');
		if (!$id) {
	        throw new NotFoundException(__('Invalid Story'));
	    }

	    $story = $this->Story->find('first', array('conditions'=>array('Story.id'=>$id)));
	 	$id= $story['Story']['id'];
	    if (!$story) {
	        throw new NotFoundException(__('Invalid Story'));
	    }

	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->Story->id = $id;
	        if ($this->Story->save($this->request->data)) {
	            $this->Session->setFlash('Your post has been updated.');
	            $this->redirect(array('action' => 'index'));
	        } else {
	            $this->Session->setFlash('Unable to update your post.');
	        }
	    }

	    if (!$this->request->data) {
	        $this->request->data = $story;
	    }
	}
	
	


}
	
	
	


