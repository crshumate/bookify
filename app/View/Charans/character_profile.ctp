
<?
	echo $this->Character->editCharacter($character, $cContent);
 ?>

<div class='pull-right questions'>

	
	<div class="accordion" id="accordion">
<? $t=0;?>	

<? foreach($sortedQuestions as $i=>$question) :?>

<?php if($t==0){
	$in = 'in';
}else{
	$in=null;
}?>
		<div class="accordion-group">
    			<div class="accordion-heading">
					<h2>
					<?= sprintf("<a href='#collapse%s' class='accordion-toggle' data-toggle='collapse' data-parent='#accordion'>%s</a> ", $t, $i)?>
					</h2>
		<?= sprintf("%s",$question['description'])?>
				</div>
	
				<div id="<?= 'collapse'.$t ?>" class="accordion-body collapse <?=$in?>">
					<div class="accordion-inner">
						<?php foreach($question['questions'] as $j=>$q) :?>
		
						<p><strong><?= $q['question'] ?></strong></p>
						<?= $this->Form->create('Charan', array('action'=>'ajax_create','id'=>'CharanCharacterProfileForm'.$j));?>
						<?= $this->Form->input('character_hash', array('type'=>'hidden','value'=>$character['Character']['hash'])); ?>
						<?= $this->Form->input('charquest_id', array('value'=>$q['id'],'type'=>'hidden'));?>
						<?
						$value=null;
						$aid=null;
						foreach ($answers as $answer){
							if($answer['Charan']['charquest_id']==$q['id']){
								$value = $answer['Charan']['answer'];
								$aid = $answer['Charan']['hash'];
							}
						} ?>
			
					<?= $this->Form->input('answer', array(
						'value'=>$value,
						'type'=>'textarea', 
						'class'=>'chardev', 
						'id'=>'CharanAnswer'.$j,
						'label'=>false));?>
				
					<?= $this->Form->input('hash', array(
						'value'=>$aid,
						'type'=>'hidden', 
						'id'=>'CharanAnswerId'.$j,
						'label'=>false));?>
					<?= $this->Form->submit('Save', array('class'=>'btn')) ?>
					<?= $this->Form->end();?>
					<?php endforeach?>
			</div>
		</div>
	</div>
<?$t+=1;?>
<?php endforeach;?>

</div>
