<?php 
class Story extends AppModel {
  public $name = 'Story';
  public $hasMany=array('Characters');
  public $belongsTo = array('User', 'Plot');




}
?>