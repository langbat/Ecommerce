<div class="content">
    <div style="padding-left: 15px;">
        <h2><?php  echo Yii::t('global','News and current promotions!'); ?></h2>
        <p style="font-size: 15px;"><?php  echo Yii::t('global','They like to be kept up to date? Here you can register for our newsletter.'); ?></p>
            <?php
            if(isset($_GET['sms'])){
                $error =  $_GET['sms'];
                 if($error == 0){
                    echo '<p style="color: blue; font-size: 15px;">'. Yii::t('global', 'Thanks you' ). '</p>';
                }else if($error == 2){
                    echo '<p style="color: red; font-size: 15px;">'. Yii::t('global', 'That email address is already subscribed.' ). '</p>';
                }else if($error == 3){
                    echo '<p style="color: red; font-size: 15px;">'. Yii::t('global', 'Invalid email address' ). '</p>';
                }else{
                    echo '<p style="color: red; font-size: 15px;">'. Yii::t('global', 'Error. Please try again' ). '</p>';
                }
            }
            ?>
        <p style="color: red;"></p> 
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>