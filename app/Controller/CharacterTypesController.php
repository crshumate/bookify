<?php
class CharacterTypesController extends AppController {
	public $theme = 'Book';
	
	public function beforeFilter(){
	parent::beforeFilter();
	
		
	}
	
	public function admin_create(){
		$this->set('ctypes', $ctypes = $this->CharacterType->find('all'));
		
		
		if($this->request->is('post')){
			$data=$this->request->data;
			if($saved=$this->CharacterType->save($data)){
				$this->redirect('');
			}
			
		}
		
	}
	
	public function admin_edit($id=null){
		
			/*if (!$id) {
		        throw new NotFoundException(__('Invalid Story'));
		    }*/

		    $ctype = $this->CharacterType->find('first', array('conditions'=>array('CharacterType.id'=>$id)));
		 	$id= $ctype['CharacterType']['id'];
		    /*if (!$ctype) {
		        throw new NotFoundException(__('Invalid Story'));
		    }*/

		    if ($this->request->is('post') || $this->request->is('put')) {
		        $this->CharacterType->id = $id;
		        if ($this->CharacterType->save($this->request->data)) {
		            $this->Session->setFlash('Your Character Type has been updated.');
		            $this->redirect(array('action' => 'create'));
		        } else {
		            $this->Session->setFlash('Unable to update your post.');
		        }
		    }

		    if (!$this->request->data) {
		        $this->request->data = $ctype;
		    }
		
	}
	
	public function admin_delete($id=null){
	$this->autoRender=false;
	if($deleted=$this->CharacterType->delete($id)){
		$this->Session->setFlash('Successfully Deleted');
		$this->redirect(array('action'=>'create'));
	}
	
		
	}
		
}
?>