<div class="content-wrapper">
    <div class="purple-grid">
        <div class="title">
            <h5><?php echo Yii::t('global', 'Top News') ?></h5>
        </div>        
        <div class="top_text">
			
			<?php if( count($posts) ): ?>
				<ul id="listnews" style="list-style-type: none !important;">
				<?php foreach( $posts as $row ): ?>
					<li <?php if( $row->status == 0 ): ?>style=''<?php endif; ?>>
						<h3><?php echo CHtml::link( CHtml::encode($row->title), array('/blog/view/' . $row->alias , 'lang' => false) ); ?></h3>
                        <?php if($row->image) { ?>
						<div class="content_blog_new"><div class="image_blog_new"><img src="/uploads/blog/<?php echo $row->image; ?>" width="100%" height="192px" style="border: 1px solid gray; vertical-align:text-top;"/> </div> <div class="description_blog_new"> <?php echo CHtml::encode($row->description); ?> </div></div>
				        <?php } else { ?>
                        <div class="content_blog_new">
                        <p> <?php echo CHtml::encode($row->description); ?> </p></div>
                        <?php } ?>
                        
					</li>
                     <div class="clearfix divider_line3"></div>
				<?php endforeach; ?>
               
				</ul>
				<?php $this->widget('CLinkPager', array('pages'=>$pages)); ?>
			<?php else: ?>
			<div style='text-align:center;'><?php echo Yii::t('blog', 'There are no posts to display!'); ?></div>
			<?php endif; ?>
            <span style="padding: 5px 0 10px 10px;"></span>
       </div>   
       	  
    </div>
</div>