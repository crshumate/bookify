<?php 
class Charan extends AppModel {
  public $name = 'Charan';
  public $belongsTo = array('Charquest','Character');
public $virtualFields = array(
	'hash'=>'SUBSTRING(md5(Charan.id),1, 8)',
    'character_hash' => 'SUBSTRING(md5(Charan.character_id),1, 8)'
);




}
?>