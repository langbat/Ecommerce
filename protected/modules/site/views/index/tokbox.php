<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="<?php echo Yii::app()->language; ?>" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="<?php echo Yii::app()->language; ?>"> <!--<![endif]-->
<head>
    <meta charset="<?php echo Yii::app()->charset; ?>" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <title><?php echo ( count( $this->pageTitle ) ) ? implode( ' - ', array_reverse( $this->pageTitle ) ) : $this->pageTitle; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="http://static.opentok.com/v1.1/js/TB.min.js" ></script>
    <script src="/themes/default/js/jquery.js" ></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />

    <script type="text/javascript">
    <?php $tokbox = Yii::app()->counter->getTokboxData();?>
    var apiKey    = <?php echo Yii::app()->settings->tokbox_api_key?>;
    var sessionId = "<?php echo $tokbox['tokbox_session']?>";
    var token = "<?php echo $tokbox['tokbox_token']?>";
    var mod_archive;
    var stopped_record = false;
    
    
    var publisher = TB.initPublisher(apiKey, 'tokbox-mod-publish', {width: 300, height:300});
    var session   = TB.initSession(sessionId); 
       
    session.connect(apiKey, token);
    session.addEventListener("sessionConnected", sessionConnectedHandler);         
    session.addEventListener("streamCreated", streamCreatedHandler);
    session.addEventListener("archiveCreated", archiveCreatedHandler);
    session.addEventListener("archiveLoaded", archiveLoadedHandler);
    session.addEventListener("sessionRecordingStarted", sessionRecordingStartedHandler);
    
    
    function sessionConnectedHandler (event) {
        session.publish( publisher );
        subscribeToStreams(event.streams);            
    }
    function subscribeToStreams(streams) {
        for (var i = 0; i < streams.length; i++) {
            var stream = streams[i];
            if (stream.connection.connectionId != session.connection.connectionId) {
                session.subscribe(stream);
            }
        }
    }
    
    //fire after click Allow
    function streamCreatedHandler(event) {
        session.createArchive(apiKey, 'perSession', '<?php echo Yii::app()->user->name?> - <?php echo date('d.m.Y H:i') ?>');
        
        subscribeToStreams(event.streams);
    }
    
    function sessionRecordingStartedHandler(){
        $('#stop-record').show();
    }
    
    //to record
    function archiveCreatedHandler(archive_event){
        $.get('/index/saveTokboxArchive?archive_id=' + archive_event.archives[0].archiveId + '&session_id=' + archive_event.archives[0].sessionId);
        session.startRecording(archive_event.archives[0]);
        mod_archive = archive_event.archives[0];
    }
    
    function stopRecording(){
        $.get('/index/stopTokboxArchive?archive_id=' + mod_archive.archiveId);
        session.stopRecording(mod_archive); 
        window.close();
    }
    session.addEventListener("sessionRecordingStopped", recordingStoppedHandler);
    function recordingStoppedHandler(event) {
        session.closeArchive(mod_archive); 
    }
    
    function archiveLoadedHandler(archive_event){
        mod_archive = archive_event.archives[0];
    }   
    
    window.onunload = function (e) {
        if (!stopped_record && $('#stop-record').is(':visible')){
            stopRecording();
        }
    };
    
    </script> 
</head>
<body>
    <div id="tokbox-mod">
        <div id="tokbox-mod-publish"></div>
        <div align="center"><button onclick="stopRecording()" style="display: none; width: 100%" id="stop-record" class="btn-danger"><?php echo Yii::t('global', 'Stop record')?></button></div>   
        
    </div>
</body>
</html>
