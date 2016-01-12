<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link href="js/video-js/video-js.css" rel="stylesheet">
  <script src="js/video-js/video.js"></script>
  

 <button id="btnCreateVideo" >Create Video</button>
<div id="content"></div>

  

  <script type="text/javascript">
    $(function () {
  var obj = $('<video>').attr({
      'class': 'video-js vjs-default-skin',
      'width': '640px',
      'height': '464',
      'controls': ' ',
      'poster': 'http://video-js.zencoder.com/oceans-clip.jpg',
      'preload': 'auto',
      'data-setup': '{}'
    }),
      source = $('<source>').attr({
        'type': 'video/mp4'
      });
  $('#btnCreateVideo').on('click', function () {
    var videoCloned = obj.clone().append(source.clone().attr('src', 'http://video-js.zencoder.com/oceans-clip.mp4'));
    console.dir(videoCloned);
    $('#content').append(videoCloned);            
    videojs(videoCloned[0], {}, function() {
      console.log('done');
    });
  });
});
  </script>