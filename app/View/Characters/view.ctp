<h2>Choose a Character to Edit</h2>

<table>
<?php
foreach($characters as $character){
	echo $this->Html->tableCells(
		array(
			array(
				$character['Character']['name'],
		
				$this->Html->link('Edit', array('controller'=>'charans', 'action'=>'character_profile', 'id'=>$character['Character']['hash']), array('class'=>'btn')),
				$this->Html->link('Delete', array('controller'=>'characters', 'action'=>'delete', 'id'=>$character['Character']['hash']), array('class'=>'btn btn-danger'))
			)	
		)
	);
	
}


?>
</table>