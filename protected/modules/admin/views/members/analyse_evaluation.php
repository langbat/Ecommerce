<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <small><?php echo Yii::t('global', 'Evaluation Member'); ?></small></h1>
</div>
<div class="row-fluid"><div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Evaluation Member'); ?></h1>          
        </div>
          <div class="block-fluid table-sorting">
            <form action="" method="get"><br />
                <table style="width: 70%; padding: 10px;" align="center">
                    <td><?php echo Yii::t('global', 'Bidder username')?></td>
                    <td><input type="text" name="username" value="<?php echo isset($_GET['username'])?$_GET['username']:''?>" /></td>
                    
                    <td><?php echo Yii::t('global', 'Bidder name')?></td>
                    <td><input type="text" name="name" value="<?php echo isset($_GET['name'])?$_GET['name']:''?>" /></td>
                    
                    
                    <td align="right"><input type="submit" class="btn" value="<?php echo Yii::t('global', 'Filter')?>" /></td>
                </table>
            </form>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'myBids-grid',
                'dataProvider'=>$model->evaluationMember( ),
                //'filter'=>$model->searchEvaluation(),
                'columns'=>array(
                    array(
                        'header'=>Yii::t('global', 'Online'),
                        'value'=>'Members::checkStatusUserOnline($data["id"])',
                    ),
                    array(
                        'header'=>Yii::t('global', 'Bidder username'),
                        'name'=>'username',
                        'type' => 'html',
                        'value'=>'$data["username"]',
                    ),
                    array(
                        'header'=>Yii::t('global', 'Bid account balance'),
                        'name'=> 'balance',
                        'type' => 'html',
                        'value' => '($data["balance"])?$data["balance"]:0'
                    ),
                    array(
                        'header'=>Yii::t('global', 'Total Bid'),
                        'name'=> 'totalbid',
                        'type' => 'html',
                        'value' => '$data["totalbid"]'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Free Bid'),
                        'name'=> 'freebid',
                        'type' => 'html',
                        'value' => 'intval($data["freebid"])'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Revenue'),
                        'name'=> 'Revenue',
                        'type' => 'html',
                        'value' => 'intval($data["Revenue"])'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Win'),
                        'name'=> 'win',
                        'type' => 'html',
                        'value' => 'intval($data["win"])'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Payment'),
                        'name'=> 'payment',
                        'type' => 'html',
                        'value' => 'Utils::number_format_compare(intval($data["payment"])). " €"'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Last active'),
                        'name'=> 'last_logged',
                        'type' => 'html',
                        'value' => 'date("d.m.Y H:i:s", strtotime($data["last_logged"]))'
                    ),
                    array(
                        'header'=>Yii::t('global', 'Registered date'),
                        'name'=> 'joined',
                        'type' => 'html',
                        'value' => 'date("d.m.Y H:i:s",$data["joined"])'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'First Name'),
                        'name'=> 'fname',
                        'type' => 'html',
                        'value' => '$data["fname"]'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Last Name'),
                        'name'=> 'lname',
                        'type' => 'html',
                        'value' => '$data["lname"]'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Old'),
                        'name'=> 'yearbirth',
                        'type' => 'html',
                        'value' => 'intval(date("Y")-$data["yearbirth"])'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Place'),
                        'name'=> 'address',
                        'type' => 'html',
                        'value' => '$data["address"]'
                    ), 
                    array(
                        'header'=>Yii::t('global', 'Country'),
                        'name'=> 'short_name',
                        'type' => 'html',
                        'value' => '$data["short_name"]'
                    ), 
                ),
            ));?>
          
        </div>   
       
</div>
