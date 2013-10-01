<?
echo $this->Form->create('PlotDevStep');
echo $this->Form->input(
'plot_steps', 
	array(
		'type'=>'select', 
		'options'=>$this->Book->unsetOptions($psOptions,$unsetArr),
		'empty'=>false));
echo $this->Form->end();


?>