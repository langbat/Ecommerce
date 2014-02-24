<?php
$genres = VideoGenres::model()->findAll(array('order'=>'name asc'));

$genreitems = array();
foreach($genres as $genre)
{
	$genreitems[] = array(
		'label' => $genre->name,
		'url' => array('videos/genres','alias'=>$genre->alias),
		'count' => $genre->count,
	);
}

$this->widget('widgets.NBMenu', array(
	'id' => 'main_menu',
	'activateParents' => true,
	'htmlOptions' => array( 'class' => 'nav' ),
    'items' => array(
					// Home
        			 array( 
							'label' => Yii::t('global', 'Home'), 
							'url' => array('index/index')
						  ),
					 // Genre
					 array( 
							'label' => Yii::t('global', 'Genre'),
							'url' => array('videos/genres'),
							'itemOptions' => array('class'=>'dropdown'),
							'items' => $genreitems,
						  ),
					 // FAQ
					 array( 
							'label' => Yii::t('global', 'FAQ'),
							'url' => array('custompages/index','alias'=>'faq'),
					 	 ),
					 // Contact
        			 array( 
							'label' => Yii::t('global', 'Kontakt'), 
							'url' => array('contactus/index')
						  ),
					)
	)
); ?>