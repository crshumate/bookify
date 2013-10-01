<div class="row">
	<div class="span3">
	<?

	echo $this->Form->create('PlotStep');
	echo $this->Form->input('title', array('type'=>'text'));
	echo $this->Form->input('short_description', array('type'=>'textarea'));
	echo $this->Form->input('description', array('type'=>'textarea'));
	echo $this->Form->input('plot_id', array('type'=>'select', 'options'=>$plotOptions));
	echo $this->Form->input('position');
	echo $this->Form->submit("Save");
	echo $this->Form->end();

	?>
	</div>
	<div class="span9">
	<?
	$str="<div class='accordion' id='plots'>";
    $marker=0;
	foreach($plots as $i=>$plot){
		$accId = preg_replace("![^a-z0-9]+!i", "-", $i);
		$accId = strtolower($accId);
		if($marker==$openAcc) $status="out";
		else $status="in";
			
		
	$str.=<<<EOT
	<div class="accordion-group">
		    <div class="accordion-heading">
		      <a class="accordion-toggle" data-toggle="collapse" data-parent="#plots" href="#collapse$marker">
		        $i
		      </a>
		    </div>
EOT;
	 $str.=<<<EOT
		<div id="collapse$marker" class="accordion-body collapse $status">
		      <div class="accordion-inner">
		        <div class='accordion' id='plotStep'>
		     
EOT;

	  foreach($plot as $j=>$plotStep){
		$title=$plotStep['PlotStep']['title'];
		$description = $plotStep['PlotStep']['description'];
		$shortDescription = $plotStep['PlotStep']['short_description'];
		$id=$plotStep['PlotStep']['id'];
		$edit=$this->Html->link("Edit", array('controller'=>'plot_steps', 'action'=>'admin_index', $id ), array('class'=>'ajax-edit btn btn-mini', 'data-id'=>$id));
		$delete=$this->Html->link("Delete", array('controller'=>'plot_steps', 'action'=>'delete', $id ), array('class'=>'btn btn-mini ajax-delete', 'data-id'=>$id));
		$str.=<<<EOT
			<div class="accordion-group" data-id="$id">
			 
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#plots" href="#$accId-$j">
				        $title
				      </a>
				    </div>
					<div id="$accId-$j" class="accordion-body collapse in">
					      <div class="accordion-inner">
					        <span class="short-description">$shortDescription</span>
					      <hr />
							<span class="description">$description</span>
							$edit
							$delete
					
						</div>
					</div>
				</div>
EOT;
	
	
	}
	$str.=" 
		</div><!--end of #plotStep accordion-->
	</div><!--end of accordion-inner-->
    </div><!--end of accordion-body-->
  </div><!--end of accordion-group-->";
$marker+=1;	
	}
$str.="</div><!--end to #plots-->";
	echo $str;
	?>
	
	</div>
	
</div>