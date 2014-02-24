<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Transactions'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Transactions'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php 
     error_reporting(0);
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		array
                (
                        'name'=>Yii::t('global','User'),
                        'type'=>'raw',
                        'value'=>$model->user->username,
                ),
        array('name'=>'amount','cssClass'=>'fix-null'),
        array('name'=>'currency','cssClass'=>'fix-null'),

        array
                (
                        'name'=>Yii::t('global','Status'),
                        'type'=>'raw',
                        'value'=>($model->paymentstatus)? Lookup::item("PaymentStatus", $model->paymentstatus):"",
                        'cssClass'=>'fix-null'
                ),
        array
                (
                        'name'=>Yii::t('global','Type'),
                        'type'=>'raw',
                        'value'=>($model->transactiontype)? Lookup::item("PaymentType", $model->transactiontype):"",
                        'cssClass'=>'fix-null'
                ),
        //array('name'=>'modified','cssClass'=>'fix-null'),
        array('name'=>'created','cssClass'=>'fix-null'),
        //array('name'=>'payment_transaction','cssClass'=>'fix-null'),
        //array('name'=>'options','cssClass'=>'fix-null'),
	),
)); ?>


</div>
</div>