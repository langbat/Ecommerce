<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Transactions'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Transactions'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('transactions/create') ?>" data-original-title="<?php echo
Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Transactions'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">
<?php
$PaymentStatus = Lookup::items('PaymentStatus');
$PaymentType = Lookup::items('PaymentType');
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'transactions-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        'id',
        array(
            'name' => 'username',
            'header' => Yii::t('global', 'Username'),
            'value' => 'CHtml::link($data->user->username,array("/admin/members/view","id"=>$data->user->id))',
            'type' => 'raw',
            ),
        array(
            'name' => 'created',
            'header' => Yii::t("global", "Date"),
            'headerHtmlOptions' => array('style' => 'text-align: center; width:130px;'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'created',
                'mode' => 'date',
                'options' => array("dateFormat" => Yii::app()->locale->getDateFormat('medium_js'),
                        'ampm' => true),
                'language' => Yii::app()->language == 'en' ? '' : Yii::app()->language,
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date_last',
                    'size' => '10',
                    'style' => 'text-align: center; border-right: 1px solid #dddddd;'),
                ), true)),
        array(
            'name' => 'amount',
            'value' => 'Utils::number_format($data->amount)." &euro;"',
            'type' => 'raw'),

        /* 'currency',
        array(
        'name' => 'paymentstatus',
        'filter'=>$PaymentStatus,
        'value' => '($data->paymentstatus)? Lookup::item("PaymentStatus", $data->paymentstatus):""'//
        ), */
        array(
            'name' => 'transactiontype',
            'filter' => $PaymentType,
            'value' => '($data->transactiontype)? Lookup::item("PaymentType", $data->transactiontype):""'),
        /*
        'modified',
        'created',
        'payment_transaction',
        'options',
        */
        array('class' => 'CButtonColumn', ),
        ),
    )); ?>
</div>
</div></div>