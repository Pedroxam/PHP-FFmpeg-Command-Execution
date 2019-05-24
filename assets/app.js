/*
  * By Pedram
  * Telegram: @Pedroxam
  * Email: pedroxam@gmail.com
*/

	/**
	* Global Progress var
	*/
	var doProgress;

	/**
	* Set Start Progress Encode Video
	*/
	  function SetProgressStart() {
		doProgress = setInterval(
		  showProgress, 2000);
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
			    $('#prog').html('100%');
			    $('#prog').css('width', '100%' );
				$('#start').removeClass('disabled');
			    clearInterval(doProgress);
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
		* File check then upload using simpleUpload plugin.
		*/
		$('#file').change(function(){
			var ext = $('#file').val().split('.').pop().toLowerCase();
			if ($.inArray(ext, [ 'mp4', 'mkv', 'avi', '3gp', ]) == -1){
				$("#status").fadeIn(50,function() {
					$('#status').html('Only Video Files is Allowed.')
				});
			}
			else
			{
				if ($(this).val() != '') {
					var base_path = './upload.php';
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
				data: { video: $('#video').val(),
						code: $('#code').val()
				}
			})
			.done(function(){
				$('.log').show()
				$('.progress').show()
				SetProgressStart();
			})
		})
	});