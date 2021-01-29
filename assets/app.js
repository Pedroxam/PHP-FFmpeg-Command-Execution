/*
  * By Pedram
  * Email: pedroxam@gmail.com
*/

	/**
	* Global Progress var
	*/
	var doProgress;

	/**
	* Start Progress
	*/
	  function setProgres() {
		doProgress = setInterval(showProgress, 2000);
	  }

	/**
	* Show Progress Percent
	*/
	  function showProgress() {
		$.getJSON('./progress.php',
		  function (data) {
			$('#log').html(data.log);
			if (data.progress == "done")
			{
			    clearInterval(doProgress);
			    $('#prog').html('100%');
			    $('#prog').css('width', '100%' );
			    $('#start').removeClass('disabled');
			}
			else
			{
			  $('#prog').css('width', data.progress + '%' );
			  $('#prog').html(data.progress + '%');
			}
		  });
	  }
  
	$(document).ready(function(){
		/**
		* Select Video
		*/
		$('#selection input').click(function(){
			$('#video').val($(this).data('video'));
		})
		
		/**
		*  Check file extention and upload
		*/
		$('#file').change(function()
		{
			//Check File Extention
			var ext = $('#file').val().split('.').pop().toLowerCase();
			if ($.inArray(ext, [ 'mp4', 'mkv', 'avi', 'flv', '3gp' ]) == -1){
				$("#status_file").fadeIn(50,function() {
					$('#status_file').html('Only Video Files is Allowed: [mp4, mkv, avi, flv, 3gp]')
				});
			}
			else
			{
				if ($(this).val() != '')
				{		
                                        //upload.php file path, you can change
					var base_path = './upload.php'; 
					
					// Upload file using simpleUpload plugin.
					$(file).simpleUpload(base_path, {
						start: function(file){
							$('#status_file').html("Upload Started");
						},
						progress: function(progress){
							$('#status_file').html(Math.round(progress) + "%");
						},
						success: function(){
							location.reload();
						},
						error: function(error){
							$('#status_file').html("upload error: " + error.name + ": " + error.message);
						}
					});
				}
			}
		})
		
		/**
		* Start Encode Video
		*/
		$('#start').click(function(){
			
			if($('#video').val() == "") {
				return alert('Please Select Video File for Start Operation!');
			}
			
			$(this).addClass('disabled');
			
			$.ajax({
				type:'POST',
				url:'./start.php',
				data: {
					video: $('#video').val(),
					code: $('#code').val()
				}
			})
			.done(function(){
				$('.log').show()
				$('.progress').show();

                                // "beforeStart" can be good if following method not work!
				setProgres();
			})
		})
	});
