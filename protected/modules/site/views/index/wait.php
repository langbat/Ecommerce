<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/county.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerScriptFile( Yii::app()->themeManager->baseUrl . '/js/county.js' ); ?>

<div class="wrapper_wait">
    <div class="time_countdown">
        <div class="text_waiting"><?php echo Yii::t('global','Waiting end soon.') ?></div>
        <div id="no-reflection"></div>
        <div class="email_box">
            <input name="email" title="<?php echo Yii::t('global','Enter your email here...') ?>" class="email defaultText"/>
            <div class="btn btn-warning"><?php echo Yii::t('global','Send')?></div>
        </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        //set width of wrapper;

        $('#no-reflection').county({ endDateTime: new Date('2013/12/12 12:12:00'), reflection: false, animation: 'scroll', theme: 'blue' });
            jQuery(".defaultText").focus(function(srcc){
                if(jQuery(this).val()==jQuery(this)[0].title)
                {
                    jQuery(this).removeClass("defaultTextActive");
                    jQuery(this).val("");
                }

                if(jQuery(this).attr('id')=='LoginForm_username'||jQuery(this).attr('id')=='LoginForm_password')
                {
                    jQuery(this).removeClass("defaultTextActive");
                    jQuery(this).val("");
                }
                if(jQuery(this).attr('id')=='LoginUser_email')
                {
                    jQuery('#lostpassword_label').hide();
                }
            });
            jQuery(".defaultText").blur(function() {
                if (jQuery(this).val() == "") {
                    jQuery(this).addClass("defaultTextActive");
                    jQuery(this).val(jQuery(this)[0].title);
                }
            });
            jQuery(".defaultText").blur();
        });
</script>