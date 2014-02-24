 
 
 <ul id="top-menu-poss">
    <li><a href="<?php echo Yii::app()->homeUrl?>" <?php echo Yii::app()->request->requestUri=='/'?'class="active"':''?>><?php echo Yii::t('global','Tosello.TV <br/> Home'); ?></a></li>
    <li><a href="/shop" <?php echo Yii::app()->request->requestUri=='/shop'?'class="active"':''?> ><?php echo Yii::t('global','Shops');  ?></a></li>
     <li><a href="/support"><?php echo Yii::t('global','Support'); ?></a></li>
</ul>

<ul id="top-menu">
    <li><a href="/"><span><?php echo Yii::t('global', 'Home')?></span></a></li>
    <?php
    $tree = array();
    Categories::getTree($tree);

    echo Categories::printTree($tree, 1);
    ?>
</ul>

<script type="text/javascript">
<?php if (Yii::app()->controller->id == 'index'){?>
    $('#top-menu li:first').addClass('active');
<?php } ?>

$('#top-menu li.active').each(function(){
    var current = $(this);
    do{
        var parent = current.parent().parent();
        if (parent.prop("tagName").toLowerCase() == 'li'){
            parent.addClass('active');
            current = parent;
        }
        else{break;}
    }while (1);
    
})

</script>