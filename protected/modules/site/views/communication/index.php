<div class="pull-left col-left">
    <div class="purple-grid fix-boder">
        <div class="title">
            <h5>Communication</h5>
        </div>
        <div class="top_text">
            
            <div id="tokbox">
                <div class="video-box" id="tokbox-publish"></div>
            </div>
            <div id="tokbox_share">
                <h3><?php echo Yii::t('global', 'Share this URL!')?></h3>
                <p><?php echo Yii::t('global', 'Copy and paste the URL below and send it to a co-worker. As soon as they open the URL you can begin your chat!')?></p>
                <p><input value="<?php echo Yii::app()->createAbsoluteUrl('/communication/index', compact('sessionId', 'token'))?>" /></p>
            </div>            
            <script src="http://static.opentok.com/webrtc/v2.0/js/TB.min.js" ></script>
            <script type="text/javascript" charset="utf-8">
                var apiKey    = <?php echo Yii::app()->settings->tokbox_api_key?>;
                var sessionId = "<?php echo $sessionId?>";
                var token     = '<?php echo $token?>';
              
                TB.addEventListener("exception", exceptionHandler);
                var session = TB.initSession(sessionId);
                var publisher = TB.initPublisher(apiKey, 'tokbox-publish', {encodedWidth: 1280, encodedHeight: 720, width: '100%', height: 320});
                
                session.addEventListener("sessionConnected", sessionConnectedHandler);
                session.addEventListener("streamCreated", streamCreatedHandler);
                session.connect(apiKey, token); 
    
                function sessionConnectedHandler(event) {
                     console.log("connected");
                     subscribeToStreams(event.streams);
                     session.publish(publisher);
                }
    
                function streamCreatedHandler(event) {
                    console.log("created");
                    subscribeToStreams(event.streams);
                }
    
                function subscribeToStreams(streams) {
                    for (var i = 0; i < streams.length; i++) {
                        var stream = streams[i];
                        if (stream.connection.connectionId != session.connection.connectionId) {
                            var stream_id = 'stream' + stream.streamId;
                            $('#tokbox').append('<div class="video-box" id="' + stream_id + '"></>');
                            session.subscribe(stream, stream_id, {encodedWidth: 1280, encodedHeight: 720, width: '100%', height: 320});
                        }
                    }
                }    
                function exceptionHandler(event) {
                    alert(event.message);
                }
            </script>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#tokbox_share input').toggle(function() {
        $(this).select();
    }, function() {
        $(this).unselect();
    });
})
</script>