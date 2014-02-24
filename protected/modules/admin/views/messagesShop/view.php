<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'MessagesShop'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'MessagesShop'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
 	     array(
                    'name' => 'sender',
                    'type' => 'raw',
                    'value'=> '<a href="/admin/members/view/id/'.$model->sender.'">'.$model->senderme->username.'</a>',
                ),
		//'sender',
          array(
                    'name' => 'receiver',
                    'type' => 'raw',
                    'value'=> '<a href="/admin/members/view/id/'.$model->receiver.'">'.$model->receiverme->username.'</a>',
                ),
		//'receiver',
		'subject',
		'message',
		'sent',
		//'status_message',
		//'is_read',
	),
)); ?>


</div>
</div>