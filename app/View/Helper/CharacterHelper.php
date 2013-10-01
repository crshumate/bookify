<?php 
App::uses('AppHelper', 'View/Helper');

class CharacterHelper extends AppHelper {
    public $helpers = array('Html', 'Form');

    public function editCharacter($character, $cContent) {
       	if($character['Character']['gender']=='Male'){
				$img = "man_face.jpg";
			}else{
				$img="woman_face.jpg";
			}
			$output="<div class='row pull-left'>";
			$output.="<div class='span6 characterImg pull-left'>";
			$output.= $this->Html->image($img, array('height'=>'100'));
			$output.="</div>";
			$output.="<div class='span6 characterInfo pull-right'>";
			$output.= $this->Html->link($character['CharacterType']['type'], "#", array('class'=>'btn popover-trigger', 'data-toggle'=>'popover', 'data-placement'=>'bottom', 'data-content'=>"{$cContent}", 'data-original-title'=>"{$character['Character']['name']}"));
			$output .= $this->Form->create('Character', array('action'=>'character_ajax_profile'));
			$output.="<ul>";
			
			$output.="<li><strong>Name:</strong>".$this->Form->input('name', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['name']))."</li>".
					"<li><strong>Gender:</strong>". $this->Form->input('gender', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['gender']))."</li>".
					"<li><strong>Occupation:</strong>".$this->Form->input('occupation', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['occupation']))."</li>".
					"<li><strong>Age:</strong>".$this->Form->input('age', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['age']))."</li>".
					"<li><strong>Birthdate:</strong>". $this->Form->input('dob', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['dob']))."</li>".
					"<li><strong>Height:</strong>".$this->Form->input('height', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['height']))."</li>".
					"<li><strong>Weight:</strong>".$this->Form->input('weight', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['weight']))."</li>".
					"<li><strong>Hair:</strong>". $this->Form->input('hair', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['hair']))."</li>".
					"<li><strong>Eyes:</strong>".$this->Form->input('eyes', array('label'=>false, 'div'=>false, 'value'=>$character['Character']['eyes']))."</li>".
		$this->Form->input('hash', array('type'=>'hidden', 'value'=>$character['Character']['hash'])).	
				"</ul>".$this->Form->end().
				"	</div>
				</div>
				";
			
			

			return $output;
    }



	public function createCharacter($ctypes){
			$output="<div class='span10 characterInfo'>";
			
			$output .= $this->Form->create('Character');
			$output.="<ul>";
			
			$output.="<li><strong>Name:</strong>".$this->Form->input('name', array('label'=>false, 'div'=>false))."</li>".
			
					"<li><strong>Gender:</strong>". $this->Form->input('gender', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Occupation:</strong>".$this->Form->input('occupation', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Age:</strong>".$this->Form->input('age', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Birthdate:</strong>". $this->Form->input('dob', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Height:</strong>".$this->Form->input('height', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Weight:</strong>".$this->Form->input('weight', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Hair:</strong>". $this->Form->input('hair', array('label'=>false, 'div'=>false))."</li>".
					
					"<li><strong>Eyes:</strong>".$this->Form->input('eyes', array('label'=>false, 'div'=>false))."</li>".
					"<li><strong>Character Type:</strong>".$this->Form->input('character_type_id', array('label'=>false, 'div'=>false, 'type'=>'select', 'options'=>$ctypes))."</li>".
					
				"</ul>".$this->Form->submit('Save Character', array('class'=>"no-ajax")).$this->Form->end();
			
			 $output.="</div>";

			return $output;
		
		
		
		
		
		
	}


}

?>