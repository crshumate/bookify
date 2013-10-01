<?php
class UsersController extends AppController {
	public $theme="Book";
	public function beforeFilter(){
		$this->Auth->allow('create','login','confirm', 'lost_password', 'reset_password');
	    //$this->Auth->fields = array('username'=>'email', 'password'=>'password');
	}
	


	public function create(){
	
		if($this->request->is('post')){
			$data=$this->request->data;
			$data['User']['password'] = AuthComponent::password($data['User']['password']);
			$data['User']['username'] = $data['User']['email'];
			$this->User->create();
			if($saved=$this->User->save($data)){
		    $opts = array('name'=>$saved['User']['name'], 'email'=>$saved['User']['email'], 'site'=>null);
			// send the user confirmation email
			            $id = $saved['User']['id'];
			            $email = $saved['User']['email'];
			            $name = $saved['User']['name'];
			            $hash = md5(sprintf('%s%s%s', $id, $email, $name));
			            $opts['hash'] = $hash;
			$this->Session->setFlash('User Saved!'); 
			$this->User->sendAccountCreated($opts);
			$this->redirect('');	
			}
		
		}
	
	}
	
	
	
	public function edit(){
		
	}
	
	public function admin_login(){
	$this->autoRender=false;
	$this->Session->setFlash('You are not authorized to access this page');
	$this->redirect(array('controller'=>'users','action'=>'login', 'admin'=>false));
	}
	
	public function admin_logout(){
	$this->autoRender=false;
	$this->redirect($this->Auth->logout());
	}
	
	
	
	public function login() {
	    $this->layout = 'default';
	    if($this->request->is('post')) {
	      // try and hash the password
	      if($this->Auth->login()) {
	        $id = $this->Auth->user('id');
	        $user = $this->User->findById($id);
	        $confirmed = $user['User']['confirmed'];
	        if($confirmed == 1) {
	         $this->redirect($this->Auth->redirect());
	        } else {
	          // user is not confirmed
	          $this->Session->setFlash('Your account is not yet confirmed. Please ' .
	                                   'check your email for the confirmation link.');
	        }
	      } else {
	        $this->Session->setFlash('Username or password is incorrect.');
	      }
	    }
	  }
	
	
	public function logout() {
	    $this->redirect($this->Auth->logout());
	  }
	
	public function confirm($hash = null) {
		$this->autoRender = false;
		//$this->autoLayout=false;
	    // grab the user account info with the hash
	    $conditions = array('md5(concat(User.id, User.email, User.name))'=>$hash);
	    $user = $this->User->find('first', array('conditions'=>$conditions));

	    if($user == null || sizeof($user) == 0) {
	      $this->Session->setFlash('Error: invalid confirmation link.');
	    } else {


	      // Unset validation and confirm the user in the database
	     /*unset($this->User->validate['email']);
	      unset($this->User->validate['password']);
	      unset($this->User->validate['email2']);
	      unset($this->User->validate['password2']);*/

	      $user['User']['confirmed'] = 1;
	      $user = $this->User->save($user);

	      // send the "you're confirmed" email
	      $opts = array('name'=>$user['User']['name'], 'email'=>$user['User']['email']);
	      $this->User->sendAccountConfirmed($opts);

	      
			$this->Session->setFlash('User Confirmed!');
		  // log the user in and redirect them
		  $this->Auth->login($user['User']);
	      $this->redirect(array('controller'=>'stories', 'action' => 'index'));
	    }
	  }
	
	public function logged_in(){
	echo "You are logged in!";
	$user=$this->User->findById($this->Auth->user());
	pr($user);
	}



}