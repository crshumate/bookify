$(document).ready(function(){
	
//if user hits return save text
 /*$('input, textarea').live('keypress',function(event){
        if (event.which ==13) {
            event.preventDefault();
         var input = $(this);

			if(input.hasClass('chardev')){
			var form = $(this).parent().parent();	
			}else{
				form = $(this).parent().parent().parent();
			}
		ajaxUpdate(input,form);
        }
  });*/

    
   

	//if user blurs off of input save text.
	$('input, textarea').live('change', function(e) {
   		var input = $(this);
   		if(input.hasClass('chardev')){
		var form = $(this).parent().parent();	
		}else{
			form = $(this).parent().parent().parent();
		}
      ajaxUpdate(input,form);
  });
 
	//if user clicks submit save text
	$("input[type='submit']").click(function(ev){
		ev.preventDefault();
		var form = $(this).parent().parent();		
		ajaxUpdate($(this), form)	
	});
	
	
	function ajaxUpdate(input, form){
	// serialize to an array, then convert for posting
	       var serialized = form.serializeArray();
	       var data = {};
	       var url = form.attr('action');
	       for(var i in serialized) {
	           var item = serialized[i];
	           data[item.name] = item.value;
	       }
	$.post(url, data, function(response) {
		if(response!='fail'){
			var success = $("<span />").text("Character Profile updated successfully!").addClass('help-inline success');          
			if(response!='success'){
					var hiddenInput = $("<input />").val(response).attr({type: 'hidden', name: 'data[Charan][id]'});
					form.append(hiddenInput);
					
			}
			form.prepend(success);	
			success.fadeOut(2500);	
		}

	       });

	   }	
	
	
	$('.popover-trigger').popover({animation: true, trigger: 'click', html:true});	
	
	
	
})