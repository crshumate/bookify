$(document).ready(function(){
	
	$(".collapse").collapse();
	
	$(".ajax-edit").click(function(ev){
		ev.preventDefault();
		$("#PlotStepId").remove();
		var $this = $(this);
		var id = $this.data('id');
		var url = '../admin/plot_steps/ajax_edit/'+id;
	    $.getJSON(url, function(data){
		 	$("#PlotStepTitle").val(data.PlotStep.title);
			$("#PlotStepDescription").val(data.PlotStep.description);
			$("#PlotStepShortDescription").val(data.PlotStep.short_description)
			$("#PlotStepPlotId").val(data.PlotStep.plot_id).change();
			$("#PlotStepPosition").val(data.PlotStep.position);
			var hiddenInput = $("<input />").attr({type: 'hidden', id: 'PlotStepId', name:'data[PlotStep][id]'}).val(data.PlotStep.id);
			$("#PlotStepAdminIndexForm").prepend(hiddenInput);
		
		});
	});
	
	$(".ajax-delete").click(function(ev){
		ev.preventDefault();
		if(confirm('Are you sure you want to delete this plot step?')){
			$this=$(this);
			var id = $this.data('id');
			var url = '../admin/plot_steps/ajax_delete/'+id;
			$.getJSON(url, function(result){
				if(result=='success'){
	            $this.parent().parent().parent().fadeOut(500).remove();
				}
			})
		}
		
		
	});
	
	
	$("#PlotStepAdminIndexForm").submit(function(ev){
		if($("#PlotStepId").length > 0){
			ev.preventDefault();
			var form = $(this);
			var url = '../admin/plot_steps/ajax_save';
			// serialize to an array, then convert for posting
			       var serialized = form.serializeArray();
			       var data = {};
			       for(var i in serialized) {
			           var item = serialized[i];
			           data[item.name] = item.value;
			       }
			$.post(url, data, function(response) {
				var data = $.parseJSON(response);
					updateStep(data);

			       });

			   
		}
	})
	
function updateStep(data){
	$(".accordion-group").each(function(){
		$this = $(this);
		if($this.data('id')==data.PlotStep.id){
			$this.find('a.accordion-toggle').text(data.PlotStep.title);
			$this.find('.short-description').text(data.PlotStep.short_description);
			$this.find('.description').text(data.PlotStep.description);
		}
	})
	
}

})