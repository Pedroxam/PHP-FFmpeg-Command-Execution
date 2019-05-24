<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FFmpeg Command Execution</title>
<link rel='stylesheet' href='./assets/bootstrap.min.css'>
<script src="./assets/jquery.min.js"></script>
<style>
.mycheckbox{position:absolute;width:100%;left:0;height:50%;}
.log{display:none;white-space:pre-line;text-align:left;overflow-y:scroll;height:300px;}
</style>
</head>
<body class="my-3" style="background:#EEE;">
<div class="container">

<div class="row">
<div class="col-md-8 my-3 m-auto">

<h3 class="text-center mb-3">Upload Video</h3>

<div class="p-4 shadow bg-white">

	<div class="col">
		<div class="form-group">
			<input type="file" name="file" id="file" class="form-control border-0">
		</div>
		<label class="ml-3">Allowed Formats: mp4, mkv, avi, 3gp</label>
	</div>

	<div class="col mt-3 text-center">
		<div id="status_file"></div>
	</div>

</div>

<h3 class="text-center my-4">Video List</h3>

<div class="col shadow p-4 bg-white">

	<div class="row text-center my-2">
		<div class="col-md-6 pt-2 font-weight-bold">
		Video Name
		</div>

		<div class="col-md-6 pt-2 font-weight-bold">
		Select Video
		</div>
	</div>

	<?php foreach(glob(__DIR__ . '/input/*.mp4') as $file){ ?>

		<div class="row">

			<div class="col-md-6 pt-2 border">
				<?php echo basename($file); ?>
			</div>

			<div class="col-md-6 pt-2 border" id="selection">
				<input class="mycheckbox" type="radio" name="fruit" data-video="<?php echo basename($file); ?>">
			</div>
			
		</div>

	<?php } ?>

	<input type="hidden" name="video" id="video" value="">
	
	<hr/>
	
	<h5 class="text-center">Enter FFmepg Parameters<br/><small class="text-center mt-3 d-block text-muted">(use INPUT instead of input video path and use OUTPUT instead of output video path)</small></h5>
	
	
	<textarea id="code" rows="3" class="form-control">ffmpeg -i INPUT OUTPUT</textarea>

	<div class="col-md-12 text-center my-2">
		<div id="status"></div>
		<br/>
		<button id="start" class="btn btn-danger text-white">
			Start Encode Video
		</button>
	</div>

	<div class="col-md-12 text-center mt-4">
		<div class="progress" style="display:none;">
			<div class="progress-bar" id="prog" role="progressbar"
				aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
			</div>
		</div>
	</div>

	<div class="col-md-12 mt-4">
		<div id="log" class="log"></div>
	</div>

</div>

</div>
</div><!-- row -->

</div><!-- container -->
	<script src="./assets/bootstrap.min.js"></script>
	<script src="./assets/simpleUpload.js"></script>
	<script src="./assets/app.js?r=<?= rand(); ?>"></script>
</body>
</html>