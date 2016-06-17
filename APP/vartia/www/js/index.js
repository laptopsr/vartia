$(document).ready(function () {


    var onFailSoHard = function(e)
    {
            console.log('failed',e);
    }

    window.URL = window.URL || window.webkitURL ;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;

    var video = document.querySelector('video');

    if(navigator.getUserMedia)
    {
        navigator.getUserMedia({video: true},function(stream) {
        video.src = window.URL.createObjectURL(stream);
        },onFailSoHard);
    }

    document.getElementById('snapshot').onclick = function() { 
        var canvas = document.getElementById('canvas'); 
        var ctx = canvas.getContext('2d'); 
        ctx.drawImage(video,0,0); 
    } 








    var pictureSource;   // picture source
    var destinationType; // sets the format of returned value
    var newImage;

    function onPhotoDataSuccess(imageURI) {
  	jQuery("#smallImage").attr("src", imageURI).show();
	newImage = imageURI;


	var path = "http://vetel.fi/tiedostot/index.php";

	var win = function (r) {
	    console.log("Code = " + r.responseCode);
	    console.log("Response = " + r.response);
	    console.log("Sent = " + r.bytesSent);
	    if(r.responseCode){
		$('#result').html('Kiitos!<br>Kuva lähetetty onnistuneesti');
	    }
	}
	
	var fail = function (error) {
	    alert("An error has occurred: Code = " + error.code);
	    console.log("upload error source " + error.source);
	    console.log("upload error target " + error.target);
	
	    document.getElementById('result2').innerHTML="An error has occurred: Code = " + error.code +
					"upload error source " + error.source + 
					"upload error target " + error.target;
	
	}

	         var options = new FileUploadOptions();
	          options.fileKey="file";
	          options.fileName=newImage.substr(newImage.lastIndexOf('/')+1);
	          options.mimeType="image/jpeg";
	
	
	          var params = new Object();
	          //params.email = email;
	
	          options.params = params;
	          options.chunkedMode = false;
	
	          var ft = new FileTransfer();
	          ft.upload(newImage, path, win, fail, options);
    }


    function onPhotoURISuccess(imageURI) {
      var largeImage = document.getElementById('largeImage');
      largeImage.style.display = 'block';
      largeImage.src = imageURI;
    }

    function capturePhoto() {
        navigator.camera.getPicture(onPhotoDataSuccess, onFail, {
            quality : 100,
	    encodingType: Camera.EncodingType.JPEG,
      	    targetHeight: 1024,
    	    targetWidth: 1024,
            destinationType : destinationType.FILE_URI,
	    correctOrientation: true
        });
    }

    function onFail(message) {
      alert('Failed because: ' + message);
    }








document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {

        //pictureSource=navigator.camera.PictureSourceType;
        //destinationType=navigator.camera.DestinationType;




PhoneCallTrap.onCall(function(state) {
    console.log("CHANGE STATE: " + state);

    switch (state) {
        case "RINGING":
            console.log("Phone is ringing");
	    soitto();
            break;
        case "OFFHOOK":
            console.log("Phone is off-hook");
            break;

        case "IDLE":
            console.log("Phone is idle");
            break;
    }
});
}

function errorCallback(error) {
  alert(error);
}

function soitto(){
	$('#result').append('joku soita<br>');

	//capturePhoto();

}





});


