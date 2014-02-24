<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'bonus-inpayments-grid',
    'summaryText'=>'',
    'dataProvider'=>$model->search(),

    'columns'=>array(
        array(
            'header'=>Yii::t('global','Inpayment amount'),
            'headerHtmlOptions'=> array('style' => 'text-align: center'),
            'htmlOptions'=> array('style' => 'border-right: 1px solid #dddddd;'),
            'value'=>'BonusInpayments::getInpaymentAmount($data->id,$data->amount)',
            'type'=>'raw'
        ),
        array(
            'header'=>Yii::t('global','Inpayment bonus'),
            'htmlOptions'=> array('style' => 'text-align: center; border-right: 1px solid #dddddd;'),
            'headerHtmlOptions'=> array('style' => 'text-align: center'),
            'value'=>'BonusInpayments::getInpaymentBonus($data->id,$data->amount,$data->percent)',
            'type'=>'raw'
        ),
        array(
            'header'=>Yii::t('global','Creating bonus'),
            'htmlOptions'=> array('style' => 'text-align: center; border-right: 1px solid #dddddd;'),
            'headerHtmlOptions'=> array('style' => 'text-align: center'),
            'value'=>'BonusInpayments::getCreatingBonus($data->id,$data->amount)',
            'type'=>'raw'
        ),
        array(
            'header'=>Yii::t('global','Total amount'),
            'htmlOptions'=> array('style' => 'text-align: center'),
            'headerHtmlOptions'=> array('style' => 'text-align: center'),
            'value'=>'BonusInpayments::getTotalAmount($data->amount,$data->percent)',
            'type'=>'raw'
        ),
    ),
)); ?>

