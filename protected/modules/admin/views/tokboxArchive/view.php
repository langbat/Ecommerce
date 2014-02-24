<script src="http://static.opentok.com/v1.1/js/TB.min.js" ></script>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Tokbox Archive'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Tokbox Archive'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'username',
            'value'=>$model->user->username
        ),
		'created',
		array(
            'label' => Yii::t('global', 'Vide stream'),
            'value' => '<div id="video-stream-box"><div id="video-stream"><img src="/themes/admin/default/img/loaders/loader_re.gif" /> '.Yii::t('global', 'Loading stream ...').'</div></div><br /><button class="btn" onclick="replay()" id="replace_video">'.Yii::t('global', 'Replay').'</button>',
            'type' => 'raw'
        ),
	),
)); ?>
</div>
</div>

<script type="text/javascript">
var session = TB.initSession('<?php echo $model->session_id?>'); // Add a value for SESSION_ID.
var loadedArchive;
var ARCHIVE_ID = "<?php echo $model->archive_id?>";
var TOKEN = "<?php echo Yii::app()->Tokbox->generate_token($model->session_id, 'moderator');?>";
var API_KEY    = <?php echo Yii::app()->settings->tokbox_api_key?>;

session.addEventListener("sessionConnected", sessionConnectedHandler);
session.addEventListener("streamCreated", streamCreatedHandler);
session.addEventListener("archiveLoaded", archiveLoadedHandler);

session.connect(API_KEY, TOKEN); // Add values for API_KEY and TOKEN.

function sessionConnectedHandler(event) {
    $('#video-stream').html('<img src="/themes/admin/default/img/loaders/loader_re.gif" />');
    session.loadArchive(ARCHIVE_ID);
}

function archiveLoadedHandler(event) {
    loadedArchive = event.archives[0];
    loadedArchive.startPlayback();
}

function streamCreatedHandler(event) {
    for (var i = 0; i < event.streams.length; i++) {
        if (event.streams[i].type == "archive") {
            subscribeToStream(event.streams[i]);
        }
    }
}

function subscribeToStream(stream) {
    var replacementDiv = document.createElement('div');
    document.getElementById('video-stream').appendChild(replacementDiv); 
    session.subscribe(stream, 'video-stream');
}
function replay(){
    $('#video-stream-box').html('<div id="video-stream"><img src="/themes/admin/default/img/loaders/loader_re.gif" /> <?php echo Yii::t('global', 'Loading stream ...')?></div>');
    session.loadArchive(ARCHIVE_ID);
}
</script>