<?php
$news= Blog::model()->findAllByAttributes(array('language' => Yii::app()->language), array('order' => 'postdate DESC', 'limit' => 2)); 
?>
<?php if(count($news)): ?>
    <div class="right-box">
        <div class="purple-box">
            <div class="title"><h5><?php echo Yii::t('global','News') ;?></h5></div>
                <?php $i=1;
					foreach($news as $new) { ?>
                    <div class="news-area">
                        <div class="news">
                            <p><strong><a href="/blog/view/<?php echo $new->alias?>" class="more"><?php echo $new->title; ?></a></strong></p>
                            <p class="date">am <?php echo gmdate("d.m.Y", $new->postdate); ?></p>
                            <p class="news-content"><?php echo $new->description; ?></p>
                            <a href="/blog/view/<?php echo $new->alias?>" class="more"><?php echo Yii::t('global', 'read more')?> &raquo;</a>
                        </div>
                    </div><!--#end product-area-->
                
                <?php
						$i++;
					} ?>
             <div class="news-area padding-5-0">
                <div class="news">
                    <a href="/blog" class="more"><?php echo Yii::t('global', 'more News')?> &raquo;</a>
                </div>
            </div><!--#end product-area-->
        </div>
    </div>
<?php endif; ?>

