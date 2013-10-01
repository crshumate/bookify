<?php 
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {
  public $name = 'User';
  public $belongsTo=array('Role');
  public $hasMany=array('Story');




public function sendAccountCreated($opts) {
    $email = new CakeEmail('default');
    $email->viewVars($opts);
    $email->template('new_account', 'default')
      ->emailFormat('text')
      ->subject('Account Created')
      ->from('tomslist@christophershumate.com')
      ->to(sprintf('%s', $opts['email']))
      ->send();
  }


public function sendAccountConfirmed($opts) {
    $email = new CakeEmail('default');
    $email->viewVars($opts);
    $email->template('account_confirmed', 'default')
      ->emailFormat('text')
      ->subject('Account Confirmed')
      ->from('tomslist@christophershumate.com')
      ->to(sprintf('%s', $opts['email']))
      ->send();
  }


}
?>