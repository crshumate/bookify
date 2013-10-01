<?php 
App::uses('CakeEmail', 'Network/Email');

class Reset extends AppModel {
  public $name = 'Reset';
  public $belongsTo = array('User');

public function removeExpired($allResets){
	$today = date('Y-m-d h:i:s a' , time());
	foreach ($allResets as $reset){
		if($today>$reset['Reset']['expires']){
			$this->delete($reset['Reset']['id']);
		}
		
	}
	
	
}


public function resetPassword($opts) {
    $email = new CakeEmail('default');
    $email->viewVars($opts);
    $email->template('reset_password', 'default')
      ->emailFormat('text')
      ->subject('Password Reset Request')
      ->from('admin@christophershumate.com')
      ->to(sprintf('%s', $opts['email']))
      ->send();
  }


}
?>