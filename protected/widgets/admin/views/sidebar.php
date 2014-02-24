<?php
// Side bar menu
$this->widget('widgets.NBADMenu', array(
	'activateParents' => true,
	'htmlOptions' => array( 'class' => 'navigation' ) ,
    'items' => array(
					// dashboard
        			 array( 
							'label' => Yii::t('global', 'Dashboard'), 
							'url' => array('index/index'),
							'icon' => 'isw-grid'
						  ),
					 // System
					 array( 
							'label' => Yii::t('global', 'System'), 
							'url' => array('settings/index'),
							'icon' => 'isw-settings',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
									array( 
											'label' => Yii::t('global', 'Manage Settings'), 
											'url' => array('settings/index'),
											'icon' => 'icon-wrench'
										 ),
									array( 
											'label' => Yii::t('global', 'Manage Languages'), 
											'url' => array('languages/index'),
											'icon' => 'icon-globe'
										 ),
                                    array( 
											'label' => Yii::t('global', 'Payment methods'), 
											'url' => array('paymentMethods/index'),
                                            'icon' => 'icon-shopping-cart'
										 ),
									array( 
											'label' => Yii::t('global', 'Email templates'), 
											'url' => array('emailTemplates/index'),
                                            'icon' => 'icon-comment'
										 ),
                                
                                array(
                                    'label' => Yii::t('global', 'Manage Countries'),
                                    'url' => array('countries/index'),
                                    'icon' => ' icon-book'
                                ),
							     ),	
                                    	
                                    
					 	 ),
					  // Auctions
					 array( 
							'label' => Yii::t('global', 'Product'), 
							'url' => array('auctions/index'),
							'icon' => 'isw-documents',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
                                    array( 
											'label' => Yii::t('global', 'Manage Products'),
											'url' => array('products/index'),
											'icon' => 'icon-barcode'
										 ),
                                    array( 
											'label' => Yii::t('global', 'Manage Categories'),
											'url' => array('categories/index'),
											'icon' => 'icon-list'
										 ),
                                    array(
											'label' => Yii::t('global', 'Manage Producer'),
											'url' => array('producers/index'),
											'icon' => 'icon-certificate'
										 ),
                                    array(
											'label' => Yii::t('global', 'Manage Label'),
											'url' => array('productLabels/index'),
											'icon' => 'icon-cog'
										 ),
                                    array(
											'label' => Yii::t('global', 'Manage Tag Cloud'),
											'url' => array('tags/index'),
											'icon' => 'icon-tags'
										 ),
                                    array(
                                        'label' => Yii::t('global', 'Manage Schedule'),
                                        'url' => array('scheduleShows/index'),
                                        'icon' => ' icon-calendar'
                                    ),
                                    array(
                                        'label' => Yii::t('global', 'Manage Comment'),
                                        'url' => array('productComments/index'),
                                        'icon' => ' icon-tasks'
                                    )
           
                            )
					 	 ),
                         
                         array( 
							'label' => Yii::t('global', 'Sales'), 
							'url' => array('auctions/index'),
							'icon' => 'isw-calc',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
                                    array( 
											'label' => Yii::t('global', 'Manage Orders'),
											'url' => array('orders/index'),
											'icon' => 'icon-shopping-cart'
										 ),
                                    array(
											'label' => Yii::t('global', 'Manage Orders Shop'),
											'url' => array('orders/orderShop'),
											'icon' => 'icon-certificate'
										 ),

                                    /*array(
            							'label' => Yii::t('global', 'Manage Transactions'),
            							'url' => array('transactions/index'),
            							'icon' => 'icon-signal'
            						  ),*/


                            )
					 	 ),
                         
                      // Members
					 array( 
							'label' => Yii::t('global', 'Members'), 
							'url' => array('members'),
							'icon' => 'isw-users',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
								array( 
										'label' => Yii::t('global', 'Manage Members'), 
										'url' => array('members/index'),
                                        'icon' => 'icon-user'
								 ),
                                 array( 
										'label' => Yii::t('global', 'Admin Accounts'), 
										'url' => array('members/admin'),
                                        'icon' => 'icon-user'
								 ),
								array( 
										'label' => Yii::t('global', 'Video live stream'),
										'url' => array('tokboxArchive/index'),
                                        'icon' => ' icon-facetime-video'
									),
								),
						  ),
    				 // Shop Member
					 array( 
							'label' => Yii::t('global', 'Shop Members'), 
							'url' => array('membershop'),
							'icon' => 'isw-cloud',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
                                array( 
										'label' => Yii::t('global', 'Manage Shop Members '), 
										'url' => array('memberShop/index'),
                                        'icon' => 'icon-shopping-cart'
								 ),
								array( 
										'label' => Yii::t('global', 'Manage Product Shop'), 
										'url' => array('productsShop/index'),
                                        'icon' => 'icon-screenshot'
								 ),
                                 array( 
										'label' => Yii::t('global', 'Manage Category'), 
										'url' => array('categoriesShop/index'),
                                        'icon' => 'icon-list-alt'
								 ),
                                 array( 
										'label' => Yii::t('global', 'Manage Comment Product'), 
										'url' => array('productComments/pro_shop'),
                                        'icon' => 'icon-list-alt'
								 ),
                                /*array( 
										'label' => Yii::t('global', 'Manage Order'), 
										'url' => array('productsShop/index'),
                                        'icon' => 'icon-tint'
								 ), */
                                 array( 
										'label' => Yii::t('global', 'Manage Message'), 
										'url' => array('messagesShop/index'),
                                        'icon' => 'icon-leaf'
								 ),
                                array( 
										'label' => Yii::t('global', 'Manage Blog Shop'), 
										'url' => array('Blogshop/index'),
                                        'icon' => 'icon-share-alt'
								 ),
                                array( 
										'label' => Yii::t('global', 'Manage Live Sale Shop'), 
										'url' => array('LiveSale/index'),
                                        'icon' => 'icon-asterisk'
								 ),
                                 array(
        							'label' => Yii::t('global', 'Manage Customer Shop'), 
        							'url' => array('orders/customerShop'),
        							'icon' => 'icon-align-justify'
        						  ),
                                 
						  ),
                    ),
                    array( 
						'label' => Yii::t('global', 'CMS'), 
						'url' => array('contactus'), 
                        'icon' => 'isw-text_document',
						'itemOptions' => array( 'class' => 'openable' ),
						'items' => array(
							array( 
									'label' => Yii::t('global', 'Pages'), 
									'url' => array('custompages/index'),
                                    'icon' => 'icon-align-justify'
								 ),
                                 array( 
									'label' => Yii::t('global', 'Support Pages'), 
									'url' => array('customsupportpages/index'),
                                    'icon' => 'icon-align-justify'
								 ),
								 array(
									'label' =>  'Blog',
									'url' => array('blog/index'),
                                    'icon' => 'icon-info-sign'
								 ),
                                array(
									'label' => Yii::t('global', 'Support'), 
									'url' => array('support/index'),
                                    'icon' => 'icon-headphones'
								 ),
                                 array( 
            						'label' => Yii::t('global', 'Widgets'), 
            						'url' => array('widgets/index'),
                                    'icon' => 'icon-th-large'
            					 ),
                                 array(
        							'label' => Yii::t('global', 'Banners'), 
        							'url' => array('banners/index'),
        							'icon' => 'icon-picture'
        						  ),
                                     array( 
										'label' => Yii::t('global', 'Questions'), 
										'url' => array('questions/index'),
                                        'icon' => 'icon-question-sign'
								 ), 
                                
                                
							),
			 	       ),
					// Contact Us		
				    array( 
									'label' => Yii::t('global', 'Newsletter'), 
									'url' => array('contactus'), 
                                    'icon' => 'isw-mail',
									'itemOptions' => array( 'class' => 'openable' ),
									'items' => array(
										//array( 
//												'label' => Yii::t('global', 'Contact Us'), 
//												'url' => array('contactus/index'),
//                                                'icon' => 'icon-comment'
//											 ),
											 array( 
												'label' => Yii::t('global', 'Manage Newsletters'), 
												'url' => array('newsletter/index'),
                                                'icon' => 'icon-envelope'
											 ),
										),
					 	  ),
                    
				)
));
?>