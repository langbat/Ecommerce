<style>
#messagesShop_message,#messagesShop_subject{width: 100%!important;}
</style>
<div class="block-fluid">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'messages-shop-form',
    'enableAjaxValidation' => false,
    )); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Sender') . ':'); ?>
        </div>
		<div class="span9">
            <?php echo MessagesShop::model()->getUserFrom(Yii::app()->user->id); ?>
            <?php echo $form->error($model, 'from'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Receiver') . ':'); ?>
        </div>
		<div class="span9">
            <?php echo $this->membershop->name; ?>
            <?php echo $form->error($model, 'to'); ?>
        </div>
	</div>
    	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Subject') .':<span style="color: red;">*</span>'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model, 'subject'); ?>
           <span style="color: red;"> <?php echo $form->error($model, 'subject'); ?></span>
        </div>
	</div>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Message') .':<span style="color: red;">*</span>'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model, 'message', array('rows' => 6,'cols' => 50)); ?>
            <span style="color: red;"><?php echo $form->error($model, 'message'); ?></span>
        </div>
	</div>
    <div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, Yii::t('global', 'Date created') .':'); ?>
        </div>
		<div class="span9">
            <?php echo date('d-m-Y'); ?>
            
        </div>
	</div>
   

	

	<div class="footer tar pull-right button-top" >
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Send') :
        Yii::t('global', 'Save'), array('class' => 'btn pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$(document).ready(function() {
            $('.btn').click(function(){
               if($("#messagesShop_subject").val().trim()!='' && $("#messagesShop_message").val().trim()!=''){
                 $('#myModalSentMS').modal('show');
                }
             });});
                
               // 
           
</script>
  