<?php 
class Character extends AppModel {
  public $name = 'Character';
  public $belongsTo = array('Story', 'CharacterType');
  public $virtualFields = array(
    'hash' => 'SUBSTRING(md5(Character.id),1, 8)'
);



}
?>