<div class="content"> 
    <div id="products">
    <?php
    if(isset($infomembershop)){
    foreach ($infomembershop as $item){?>
          <div class="contact-detail">
            <div class="contact-img"><a href="/shop/detail/<?php echo $item['id'] ?>"><img src="/uploads/logoshop/<?php echo $item['image'] ?>" /></a></div>
            <div class="contact-name"><h2><?php echo $item['name'] ?></h2>
                <div><?php echo Yii::t('global', 'Email')?> : <a href="mailto:<?php echo $item['email'] ?>"><?php echo $item['email'] ?></a></div>
                <div><?php echo Yii::t('global', 'Phone')?>: <?php echo $item['phone'] ?></div>
                <div><?php echo Yii::t('global', 'Address')?> : <?php echo $item['address'] ?></div>
                <div><?php echo Yii::t('global', 'Slogan')?> : <?php echo $item['slogan'] ?></div>
                <div><?php echo Yii::t('global', 'Description')?> : <?php echo $item['description'] ?></div>
            </div>
          </div>
    <?php }?>
        
    <?php } ?>
    </div>
</div>