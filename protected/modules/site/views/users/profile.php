
<div class="table">
	<div class="custompagecontent">
		
		<div class="row-fluid">
			<div class="span3">
				<img src="<?php echo Yii::app()->homeUrl.'uploads/avatar/';
					if($model->photo !='' && file_exists(ROOT_PATH.'uploads/avatar/t_'.$model->photo) ) echo 't_'.$model->photo;
					else echo 'default.png';
				?>" style="margin-top:15px;" alt="<?php echo $model->seoname; ?>"/>
				
				<?php if(!Yii::app()->user->isGuest && Yii::app()->user->id == $model->id) : ?>
					<div class="row-fluid">
						<?php echo CHtml::link(Yii::t('global', 'Edit Profile'), array('users/index')); ?><br>
						<?php echo CHtml::link(Yii::t('global', 'Change password'), array('users/changepass')); ?><br>
						<?php //echo CHtml::link(Yii::t('global', 'New Blog Post'), array('blog/addpost')); ?><br>
					</div>
				<?php endif; ?>
				
				<?php /*
				<div class="row-fluid">
					<h3>
						<?php echo Yii::t('users', 'Latest Posts'); ?>
						<a href="<?php echo Yii::app()->createUrl('/'.$model->id . '-'.$model->seoname.'/blog', array('lang'=>false)); ?>" title="<?php echo $model->getDisplayName(); ?> Blog">View all</a>
					</h3>
					
					<ul>
					<?php $posts = Blog::model()->findAll('authorid=:uid AND status=1 ORDER BY postdate DESC LIMIT 0, 5', array( ':uid' => $model->id )); ?>
					<?php if( is_array($posts) && count($posts) ): ?>
						<?php foreach($posts as $post): ?>							
							<li><?php echo Blog::model()->getPostLink( $model, $post, array( 'title' => $post->title ) ); ?></li>
						<?php endforeach; ?>	
					<?php else: ?>
						<li><?php echo Yii::t('users', 'No post published yet.'); ?></li>
					<?php endif; ?>
					</ul>
					
				</div>
				*/ ?>
			</div>
			<div class="span9">
				<div class="row-fluid">
					<div class="span9">
						<h1><?php echo $model->getDisplayName(); ?> Profile</h1>
						<p>Joined: <?php echo date('Y-m-d', $model->joined); ?></p>
					</div>
					<div class="span3">
						<?php if(!Yii::app()->user->isGuest && Yii::app()->user->id != $model->id) : ?>
							<?php echo CHtml::form('/sendmessage', 'get', array()); ?>
								<input type="hidden" name="id" value="<?php echo $model->id; ?>"/>
								<input type="submit" value="Send Message" title="Send a message to this user"/>
							<?php echo CHtml::endForm(); ?>
						<?php endif; ?>
					</div>
				</div>
				
				
				
				<div class="row-fluid">
					
					<h3><?php echo Yii::t('users', 'Comments'); ?> (<?php echo $totalcomments; ?>)</h3>
					
					<?php if( count( $comments ) ): ?>
						<?php foreach($comments as $comment): ?>
							<div class="row-fluid" style="margin:5px 0; border-bottom:1px dashed #ccc;<?php if( $comment->visible == 0 ): ?>background-color:#FFCECE;<?php endif; ?>">
								<div class="span1" style="margin-top:15px;">
									<a name="comment<?php echo $comment->id; ?>">
										<img src="<?php 
											if($comment->author->photo != '')  echo Yii::app()->homeUrl.'uploads/avatar/t_'.$comment->author->photo;
											else echo Yii::app()->homeUrl.'uploads/avatar/default.png';
										; ?>" width="64" height="64"/>
									</a>
								</div>
								<div class="span11">
									<p>
										<?php echo $comment->author ? '<a href="' . Yii::app()->createUrl( '/' . $comment->author->id . '-' . $comment->author->seoname, array('lang'=>false)) . '"><strong>' . $comment->author->getDisplayName() . '</strong></a>' : 'Unknown'; ?>
										<small style="font-size:12px;"> &nbsp <?php echo Yii::app()->dateFormatter->formatDateTime($comment->postdate, 'long', 'short'); ?></small>
										<?php if( Yii::app()->user->checkAccess('op_users_manage_comments') ): ?>
											<?php echo CHtml::link( CHtml::image( Yii::app()->themeManager->baseUrl . '/images/'. ($comment->visible ? 'cross_circle' : 'tick_circle') . '.png' ), array('users/togglestatus', 'id' => $comment->id), array( 'style'=>'float:right', 'title' => Yii::t('users', 'Toggle comment status!') ) ); ?>
										<?php endif; ?>
									</p>
									
									<p><?php echo $markdown->safeTransform($comment->comment); ?></p>
								</div>
							</div>
						<?php endforeach; ?>	
					<?php else: ?>	
						<div class="row-fluid"><?php echo Yii::t('users', 'No comments posted yet. Be the first!'); ?></div>
					<?php endif; ?>
					
					<?php $this->widget('widgets.MyPager', array('pages'=>$pages)); ?>
					
					<div class="row-fluid">
						<?php if( $addcomments ): ?>
							<?php echo CHtml::form('', 'post', array('id'=>'frmcomment')); ?>
								
								<?php echo CHtml::label(Yii::t('extensions', 'Comment'), ''); ?>
								<?php //$this->widget('widgets.markitup.markitup', array( 'model' => $commentsModel, 'attribute' => 'comment' )); ?>
								<textarea name="UserComments[comment]" id="UserComments_comment" class="text" style="display:block; clear:both; margin-bottom:20px; width:100%; height:50px;"></textarea>
								
								<?php echo CHtml::error($commentsModel, 'comment'); ?>
								<?php echo CHtml::submitButton(Yii::t('users', 'Post Comment'), array( 'class' => 'submitcomment' )); ?>
							
							<?php echo CHtml::endForm(); ?>
						<?php else: ?>
							<?php echo Yii::t('global', 'You must be logged in to post comments.'); ?>
						<?php endif; ?>
					</div>
					
				</div>
				
			</div>
		</div>
	
	</div>
</div>