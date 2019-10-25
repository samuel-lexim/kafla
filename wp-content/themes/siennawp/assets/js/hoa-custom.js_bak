

var myVideo = document.getElementById('kaflaVid');

VisSense.VisMon.Builder(VisSense(myVideo, { fullyvisible: 0.75 }))
.on('fullyvisible', function(monitor) {
  myVideo.play();
})
.on('hidden', function(monitor) {
  myVideo.pause();
  
})
.build()
.start();