jQuery(document).ready(function($){
	$('#subscriber-form').submit(function(e){
		e.preventDefault();
		
		// Serialize form
		var subscriberData = $('#subscriber-form').serialize();

		// Submit
		$.ajax({
			type:'post',
			url:$('#subscriber-form').attr('action'),
			data:subscriberData 
		}).done(function(response){

			// Success or error classes
			$('#msg-wrap').removeClass('error');
			$('#msg-wrap').addClass('success');

			// Set message
			$('#msg-wrap').text(response);

			// Clear
			$('#name').val('');
			$('#email').val('');
		}).fail(function(data){
			// Success or error classes
			$('#msg-wrap').removeClass('success');
			$('#msg-wrap').addClass('error');

			if (data.responseText != '') {
				// Set message
				$('#msg-wrap').text(data.responseText);
			}else{
				$('#msg-wrap').text('Something went wrong! Try later');
			}
		});
	});
});