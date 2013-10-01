<?php 
class Note extends AppModel {
  public $name = 'Notes';
  public $belongsTo = array('User', 'Story');




}
?>