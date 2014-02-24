<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Help Topic'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Help Topic'); ?></h1>
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('lookup/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Lookup'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lookup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array('name' => 'name', 'value' => 'Yii::t("global", $data->name)'),
		//'code',
		'type',
		'position',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete} {up} {down}',
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
		),
	),
)); ?>
</div>
</div></div>

<script type="text/javascript">
    function setUp(id){
        $.get('/admin/lookup/setUp?id='+id, function(html) {
            window.location.reload();
        });
    }
    function setDown(id){
        $.get('/admin/lookup/setDown?id='+id, function(html) {
            window.location.reload();
        });
    }


</script>