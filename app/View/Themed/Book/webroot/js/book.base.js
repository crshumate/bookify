$(document).ready(function(){

	$('#story-select').change(function(){
	
		var val = $(this).val();
		if(val!=0){
			$.get('stories/storySelecter',{storyId: val}, function(data){
				if(data=='session')window.location='';
				else window.console.log(data);
				
			})
		}

	});
	
	
	
});