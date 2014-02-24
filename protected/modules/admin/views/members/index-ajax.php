<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'members-grid'.$id,
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'username',
        'email',

        array(
            'name'=>'joined',
            // here's a parameter that disable HTML escaping by Yii
            'value'=>'date("F j Y",strtotime($data->joined))'),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{hideMember}',
            'buttons'=>array
            (
                'hideMember' => array
                (
                    'label'=>'Hide',
                    'imageUrl'=>'/assets/images/delete.png',
                    'url'=>'$data->id',
                    'click'=>'function(){
                          hideMember($(this).attr("href"));
                          return false;
                    }',
                ),
            ),
        ),
    ),
)); ?>