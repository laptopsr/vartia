$(document).ready(function () {


  if(!localStorage.getItem('sahkoposti'))
  {
	$('#odotanSoittoa').removeClass('alert-warning').addClass('alert-danger').html('Sähköpostisi on tyhjä');
  } else {
	var sahkoposti = localStorage.getItem('sahkoposti');
	$('#sahkoposti').val(sahkoposti);
  }

  $('.saveEmail').click(function(){

	var sahkoposti = $('#sahkoposti').val();
	localStorage.setItem('sahkoposti', sahkoposti);
	window.location.reload();
  });


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

        document.querySelector('img').src = canvas.toDataURL('image/jpeg');

    } 



document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {



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
	$('#odotanSoittoa').html('Joku soita..');

        var canvas = document.getElementById('canvas'); 
        var ctx = canvas.getContext('2d'); 
        ctx.drawImage(video,0,0); 

    	document.querySelector('img').src = canvas.toDataURL('image/jpeg');
	var newImage = document.querySelector('img').src;

	var path = "http://vetel.fi/vartia/index.php/api/mob/tiedosto";

	var win = function (r) {
	    console.log("Code = " + r.responseCode);
	    console.log("Response = " + r.response);
	    console.log("Sent = " + r.bytesSent);
	    if(r.responseCode){
		$('#result').html('Kuva lähetetty onnistuneesti');
	    }
	}
	
	var fail = function (error) {
	    console.log("An error has occurred: Code = " + error.code);
	    console.log("upload error source " + error.source);
	    console.log("upload error target " + error.target);
	
	    document.getElementById('result').innerHTML="An error has occurred: Code = " + error.code +
					//"upload error source " + error.source + 
					"upload error target " + error.target;
	
	}


	         var options = new FileUploadOptions();
	          options.fileKey="file";
	          options.fileName='jokokuva';
	          options.mimeType="text/plain";
	
	
	          var params = new Object();
	          params.sahkoposti = sahkoposti;
	
	          options.params = params;
	          options.chunkedMode = false;
	
	          var ft = new FileTransfer();
	          ft.upload(newImage, path, win, fail, options);
}








});


