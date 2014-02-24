 <div class="row-fluid">
     <div class="title-block"><?php echo Yii::t('global','Tags cloud'); ?></div>
     <div class="content-block"> 
         <div class="tags-cloud-style">
         <?php 
            $listTags = Tags::listTags( 200 );
            foreach( $listTags as $listTag ){
           ?>
                   <a href="/tags/detail/<?php echo $listTag['slug']; ?>"><span class="<?php if( $listTag['weight'] > 10 ) echo 'tag-style-level-one'; else if( $listTag['weight'] > 5 ) echo 'tag-style-level-two'; else echo 'tag-style';  ?>"><?php echo $listTag['name']; ?> </span></a> 
         <?php   } 
         ?>
         </div>
     </div>
     </div>
 <div class="clearfix"></div>