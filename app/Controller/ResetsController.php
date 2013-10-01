<?
class ResetsController extends AppController {
	public $theme = 'Book';
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('lost_password','reset_password'));
	}

	public function lost_password(){

		/*anytime someone visits the lost_password page clean out the resets table of un-completed password resets.*/
		$allResets = $this->Reset->find('all');
		$this->Reset->removeExpired($allResets);
		
		if($this->request->is('post')){
			$data=$this->request->data;
		    $reset['Reset']=array();
			$hash = Security::generateAuthKey();
			if($user = $this->Reset->User->findByEmail($data['User']['email'])){
				
			
		
			$tomorrow = strtotime("+1 day", time());
			$tomorrow = date('Y-m-d h:i:s a' , $tomorrow);
			$reset['Reset']['expires']=$tomorrow;
			$reset['Reset']['user_id']=$user['User']['id'];
			$reset['Reset']['hash']=$hash;
			if($saved=$this->Reset->save($reset)){
				$opts=array('name'=>$user['User']['name'], 'email'=>$user['User']['email'],'hash'=>$hash);
				$this->Reset->resetPassword($opts);
				
				$this->Session->setFlash('We have sent an email to the email address we have on file. Please follow the instructions in the email to reset your password.');
				$this->redirect(array('controller'=>'resets', 'action'=>'lost_password'));
			}
		//we didn't find a user	
		 }else{
			$this->Session->setFlash('That user email could not be found in our database. Please try again.');
			$this->redirect(array('controller'=>'resets', 'action'=>'lost_password'));
		}
		}
	}

	public function reset_password($hash=null){
		if($hash!=null){
			$hashExists = $this->Reset->find('first', array('condition'=>array(
					'Reset.hash'=>$hash
					)
				)
			);
		
			if($hashExists){
				$today = date('Y-m-d h:i:s a' , time());
				if($today<=$hashExists['Reset']['expires']){
					$user=$this->Reset->User->findById($hashExists['Reset']['user_id']);
					$this->Auth->login($user['User']);
					$this->Reset->delete($hashExists['Reset']['id']);
					$this->redirect(array('controller'=>'users', 'action'=>'edit'));
				}else{
				$this->Session->setFlash("Your password reset session has expired. Please retry your password reset.");
				$this->redirect(array('controller'=>'resets', 'action'=>'lost_password'));
				
				}
		
			}else{
				$this->Session->setFlash("Your password reset session doesn't exist. Please retry your password reset.");
				$this->redirect(array('controller'=>'resets', 'action'=>'lost_password'));
			
			}
		}else{
			$this->Session->setFlash("Your password reset session doesn't exist. Please retry your password reset.");
			$this->redirect(array('controller'=>'resets', 'action'=>'lost_password'));
		}
	}

}
?>