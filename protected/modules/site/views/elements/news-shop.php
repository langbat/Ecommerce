<?php
    $news= Blog::model()->findAllByAttributes(array('language' => Yii::app()->language), array('order' => 'id DESC', 'limit' => 3)); 
?>
<?php if(count($news)): ?>
<div class="row-fluid">
        <div class="content-block full_img">
        <?php 
            $i = 0;
            foreach ( $news as $new ){ ?>
            <div class="span4">
                <a href="/blog/view/<?php echo $new->alias?>" ><img src="/uploads/blog/<?php echo $new->image; ?>" alt="<?php echo $new->title; ?>"/></a>
                <h4><a href="/blog/view/<?php echo $new->alias?>" ><?php echo $new->title; ?></a></h4>
                <p>
                    <?php echo $new->description; ?>
                </p>
            </div>
            
        <?php
            if( $i == count($news) - 1  )
                 echo '<div class="clearfix"></div>';
            $i++;
            } 
        ?>
        </div>
  </div>
<?php endif; ?>