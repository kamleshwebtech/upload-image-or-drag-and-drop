<html>
<head>
<title>Upload Image or Drag And Drop</title>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jasny-bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.fileupload.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>

<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="css/custom.css" media="screen" rel="stylesheet" type="text/css">
</head>

<body>
<div class="form-group FileArea Overflow">
    <div class="hide">
    	<input type="file" name="user_photos[]" class="form-control " id="user_photos" multiple="multiple" spellcheck="true" accept="image/jpeg, image/png" >
    </div>

    <div class="col-lg-4 col-sm-5 FileBtn p0 Cursor" onclick="$('#user_photos').trigger('click')"><i class="fa icon-plus"></i>&nbsp; Click or drag and drop any image file</div>

    <div class="col-lg-8 col-sm-7">
    	<label class="portfoLabelFile" style="opacity:0;">Click or drag and drop any image file</label>
    </div>

    <p class="Clear hidden-xs">&nbsp;</p>

    <div id="uploadedInfo">
    	<!-- <div class="img_box"><img src="images/FelicityProfile.jpg"></div> -->
   	</div>

    <div id="pic-progress1" class="progress progress-sm" style="display:none;">
    	<div id="pic-bar1" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div id="mediaErrorDiv" class="help-block p0"></div>
</div>


<script>
var baseUrl = 'http://localhost/sites/test/drag-file-upload';
$('#user_photos').fileupload({      
	url:baseUrl+'/upload-portfolio.php',
	add:function(e, data) {  
		var uploadErrors=[];
		var selectedFileData = data.originalFiles;
		var isValidFiles = true;
		var extension_array = ['jpg','jpeg','png','JPG','JPEG','PNG'];
		for(var x = 0; x < selectedFileData.length; x++){
			var file_name = selectedFileData[x]['name'];
			var Extension = file_name.substr((file_name.lastIndexOf('.') + 1));			
			if($.inArray(Extension, extension_array) < 0) { 
				isValidFiles = false;
			}	
		}
		if(isValidFiles == false) { 
			$('#mediaErrorDiv').html('Invalid file extension');
			alert("Valid Extentions for media is jpg,jpeg,png,PNG,JPG,JPEG"); 

		} else {
			data.submit();
		}
	},
	done: function(e,data){
		$('#pic-progress1').hide();
		$('#mediaErrorDiv').html('');
		var data_result = JSON.parse(data.result);
		if(data_result.status==200){
			var fileInfoText = '<div class="img_box"><img src="images/'+ data_result.filename +'"></div>';
			$('#uploadedInfo').append(fileInfoText);

		} else {
			alert(data_result.message);
		}
	},
	progress: function(e, data){
		$('#pic-progress1').show();
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$("#pic-bar1").width(progress+'%');
		$('#pic-progress1').css('width', progress+'%');
	}
	});	
</script>
</body>
</html>