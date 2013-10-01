<?
echo $this->Form->create('CharacterType');
echo $this->Form->input('type');
echo $this->Form->input('description');
echo $this->Form->submit('Save');
echo $this->Form->end();



?>

<h2>Character Types</h2>
<ul>
<?
foreach($ctypes as $ct){
	$edit = $this->Html->link('Edit', array('admin'=>true, 'controller'=>'character_types','action'=>'edit', $ct['CharacterType']['id']), array('class'=>'btn'));
	$delete = $this->Html->link('Delete', array('admin'=>true,'controller'=>'character_types','action'=>'delete', $ct['CharacterType']['id']),array('class'=>'btn'));
	
echo sprintf("<li>%s %s %s", $ct['CharacterType']['type'], $edit, $delete);
echo sprintf("<ul><li>Description: %s</li></ul></li>", $ct['CharacterType']['description']);	
	
}

?>
</ul>