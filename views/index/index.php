<?php
// echo $this->context->id;
// $this->context->test();
// var_dump($this->context);

// use yii\jui\DatePicker;
?>
 <!-- //DatePicker::widget(['name' => 'date'])  -->
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
	<script src="//vjs.zencdn.net/5.19/video.min.js"></script>
 </head>
 <body>
 	<video
    id="my-player"
    class="video-js"
    controls
    preload="auto"
    poster="//vjs.zencdn.net/v/oceans.png"
    data-setup='{}'>
  <source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4"></source>
  <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm"></source>
  <source src="//vjs.zencdn.net/v/oceans.ogv" type="video/ogg"></source>
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="http://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>
<script type="text/javascript">
	var options = {};

var player = videojs('my-player', options, function onPlayerReady() {
  videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  this.play();

  // How about an event listener?
  this.on('ended', function() {
    videojs.log('Awww...over so soon?!');
  });
});
</script>
 </body>
 </html>
 