<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Help Topic'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Help Topic'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('helps/CreateTopic') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'New Topic'); ?>"></a></li>
        </ul>
    </div>
    <div class="block-fluid table-sorting">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'topic-grid',
        'dataProvider'=>$topic->search(),
        'filter'=>$topic,
        'columns'=>array(
            array(
                'name' => 'name',
                'value' => 'Yii::t("global", $data->name)'
            ),
            //'code',
            'position',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view_topic}{update_topic}{delete2} {up} {down}',
                'buttons'=>array
                (
                    'view_topic' => array
                    (
                        'label'=> Yii::t('global', 'View'),
                        'imageUrl'=>'/assets/images/view.png',
                        'url'=>'Yii::app()->createUrl("/admin/helps/viewTopic", array("id"=>$data->id))',

                    ),
                    'update_topic' => array
                    (
                        'label'=> Yii::t('global', 'Update'),
                        'imageUrl'=>'/assets/images/update.png',
                        'url'=>'Yii::app()->createUrl("/admin/helps/updateTopic", array("id"=>$data->id))',
                    ),
                    'delete2' => array
                    (
                        'label'=> Yii::t('global', 'Delete'),
                        'imageUrl'=>'/assets/images/delete.png',
                        'url'=>'$data->id',
                        'click'=>'function(){
                            deleteTopic($(this).attr("href"));
                            return false;
                        }',
                    ),

                    'up' => array
                    (
                        'label'=> Yii::t('global', 'Up'),
                        'imageUrl'=>'/assets/images/up.png',
                        'url'=>'$data->id',
                        'click'=>'function(){
                            setUpTopic($(this).attr("href"));
                            return false;
                        }',
                    ),
                    'down' => array
                    (
                        'label'=> Yii::t('global', 'Down'),
                        'imageUrl'=>'/assets/images/down.png',
                        'url'=>'$data->id',
                        'click'=>'function(){
                            setDownTopic($(this).attr("href"));
                            return false;
                        }',
                    ),
                ),
            ),
        ),
    )); ?>
    </div>
</div></div>

<script type="text/javascript">
    function setUpTopic(id){
        $.get('/admin/lookup/setUp?id='+id, function(html) {
            window.location.reload();
        });
    }
    function setDownTopic(id){
        $.get('/admin/lookup/setDown?id='+id, function(html) {
            window.location.reload();
        });
    }
    function deleteTopic(id){
        <?php $mess = Yii::t('global','Are you sure you want to delete this item?'); ?>
        if(confirm('<?php echo $mess; ?>')){
            $.get('/admin/helps/deleteTopic?id='+id, function(html) {
                window.location.reload();
            });
        } else {
            return false;
        }
    }

</script>
<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Helps'); ?></small></h1>

</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Questions'); ?></h1>
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('helps/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'New Question'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting help_page">

<?php
    $topic_name = Lookup::items('HelpTopic');
$columns = array( 'question',
    array(
        'name'=>'topic',
        'header' => Yii::t('global', 'Topic'),
        'value' => 'Lookup::item("HelpTopic", $data->topic)',
        'filter'=>$topic_name,
    )
);
foreach( Yii::app()->params['languages'] as $key => $value ){
    $columns[]  = array(
        'header' => '<div align="center"><img src="/assets/images/languages/'.$key.'.png" /></div>',
        'value' => '$data->languageButton("'.$key.'")' ,
        'type' => 'raw',
        'htmlOptions'=>array( 'style'=>'text-align: center' )
    );
}
$columns[] = array(
 'class'=>'CButtonColumn',
 'template'=>'{delete} {up} {down}',
    'buttons'=>array
    (
        'up' => array
        (
            'label'=> Yii::t('global', 'Up'),
            'imageUrl'=>'/assets/images/up.png',
            'url'=>'$data->id',
            'click'=>'function(){
                setUp($(this).attr("href"));
                return false;
            }',
        ),
        'down' => array
        (
            'label'=> Yii::t('global', 'Down'),
            'imageUrl'=>'/assets/images/down.png',
            'url'=>'$data->id',
            'click'=>'function(){
                setDown($(this).attr("href"));
                return false;
            }',
        ),
    ),
);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'helps-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>$columns
)); ?>
</div>
</div></div>
<script type="text/javascript">
    function setUp(id){
        $.get('/admin/helps/setUp?id='+id, function(html) {
          window.location.reload();
        });
    }
    function setDown(id){
        $.get('/admin/helps/setDown?id='+id, function(html) {
           window.location.reload();
        });
    }


</script>