<div class="workplace">

                <div class="page-header">
                    <h1>User info <small><?php echo $model->username; ?></small></h1>
                </div>                  
                
                <div class="row-fluid">

                    <div class="span6">                    
                        <div class="row-fluid">
                            <div class="span3">
                                <div class="ucard clearfix">                                    
                                    <div class="right">
                                        <h4><?php echo $model->username; ?></h4>
                                        <div class="image">
                                            <a href="#"><img src="img/users/user_profile.jpg" class="img-polaroid"></a>                            
                                        </div>
                                        <ul class="control">                
                                            <li><span class="icon-pencil"></span> <a href="<?php echo $this->createUrl('members/edituser', array( 'id' => $model->id )); ?>" title="<?php echo Yii::t('adminmembers', 'Edit this member'); ?>" class="tipb">Edit</a></li>
                                            <li><span class="icon-user"></span> <a href="ui.html">Status</a></li>
                                            <li><span class="icon-info-sign"></span> <a href="users.html">Information</a></li>
                                            <li><span class="icon-envelope"></span> <a href="messages.html">Send message</a></li>
                                        </ul>                                                                                     
                                    </div>
                                </div>                                 
                            </div>                                                                                
                            <div class="span9">
                                <div class="block-fluid ucard">

                                        <div class="info">                                                                
                                            <ul class="rows">
                                                <li class="heading">User info</li>
                                                <li>
                                                    <div class="title">Name:</div>
                                                    <div class="text">Dmitry</div>
                                                </li>
                                                <li>
                                                    <div class="title">Surname:</div>
                                                    <div class="text">Ivaniuk</div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><?php echo $model->email; ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">Male</div>
                                                </li>
                                                <li>
                                                    <div class="title">Age:</div>
                                                    <div class="text">23</div>
                                                </li>
                                                <li>
                                                    <div class="title">Signature:</div>
                                                    <div class="text">Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis.</div>
                                                </li>                                     
                                            </ul>                                                      
                                        </div>                        
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="span6">        
                        <div class="head clearfix">
                            <div class="isw-favorite"></div>
                            <h1>Recent activity</h1>
                        </div>                
                        <div class="block-fluid scrollBox withList">
                            <div class="scroll" style="height: 200px;">

                                <ul class="list">
                                    <li><span class="date"><b>Nov 7</b> 12:45</span> Aqvatarius commented on <a href="#">Some news name</a></li>
                                    <li><span class="date"><b>Nov 7</b> 12:32</span> Aqvatarius uploaded <a href="#">.zip file</a></li>
                                    <li><span class="date"><b>Nov 7</b> 12:25</span> Aqvatarius logged in</li>
                                    <li><span class="date"><b>Nov 6</b> 20:21</span> Aqvatarius commented on <a href="#">Class aptent taciti</a></li>
                                    <li><span class="date"><b>Nov 6</b> 20:15</span> Aqvatarius commented on <a href="#">Integer dignissim consequat</a></li>
                                    <li><span class="date"><b>Nov 6</b> 19:33</span> Aqvatarius logged in</li>
                                    <li><span class="date"><b>Nov 5</b> 18:27</span> Aqvatarius added <a href="#">image</a></li>
                                    <li><span class="date"><b>Nov 5</b> 12:45</span> Aqvatarius commented on <a href="#">Some news name</a></li>
                                    <li><span class="date"><b>Nov 5</b> 12:32</span> Aqvatarius uploaded <a href="#">.zip file</a></li>                                
                                    <li><span class="date"><b>Nov 5</b> 20:21</span> Aqvatarius commented on <a href="#">Class aptent taciti</a></li>
                                    <li><span class="date"><b>Nov 5</b> 12:25</span> Aqvatarius logged in</li>
                                    <li><span class="date"><b>Nov 3</b> 20:15</span> Aqvatarius commented on <a href="#">Integer dignissim consequat</a></li>                                
                                    <li><span class="date"><b>Nov 3</b> 18:27</span> Aqvatarius added <a href="#">image</a></li>                                
                                    <li><span class="date"><b>Nov 3</b> 19:33</span> Aqvatarius logged in</li>
                                    <li><span class="date"><b>Nov 2</b> 12:45</span> Aqvatarius commented on <a href="#">Some news name</a></li>
                                    <li><span class="date"><b>Nov 2</b> 12:32</span> Aqvatarius uploaded <a href="#">.zip file</a></li>
                                    <li><span class="date"><b>Nov 2</b> 12:25</span> Aqvatarius logged in</li>
                                    <li><span class="date"><b>Nov 1</b> 20:21</span> Aqvatarius commented on <a href="#">Class aptent taciti</a></li>
                                    <li><span class="date"><b>Nov 1</b> 20:15</span> Aqvatarius commented on <a href="#">Integer dignissim consequat</a></li>                                
                                </ul>    

                            </div>                                                                                                                                
                        </div>

                    </div>                 

                </div>            

                <div class="row-fluid">

                    <div class="span6">
                        <div class="head clearfix">
                            <div class="isw-picture"></div>
                            <h1>User images</h1>                       
                        </div>
                        <div class="block gallery clearfix">

                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                            <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>                        

                        </div>
                    </div>

                    <div class="span6">
                        <div class="head clearfix">
                            <div class="isw-users"></div>
                            <h1>Friends</h1>
                        </div>

                        <div class="block-fluid users">                                                

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/olga_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Olga</a>                                
                                        <span>online</span>
                                        <div class="controls">                    
                                            <a href="#" class="icon-pencil"></a> 
                                            <a href="#" class="icon-envelope"></a>                                         
                                            <a href="#" class="icon-remove"></a>
                                        </div>                                      
                                    </div>                                
                                </div>                        

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexey</a>  
                                        <span>online</span>
                                        <div class="controls">                    
                                            <a href="#" class="icon-pencil"></a> 
                                            <a href="#" class="icon-envelope"></a>                                         
                                            <a href="#" class="icon-remove"></a>
                                        </div>                                                                
                                    </div>
                                </div>                              

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/dmitry_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Dmitry</a>                                    
                                        <span>online</span>
                                        <div class="controls">                    
                                            <a href="#" class="icon-pencil"></a> 
                                            <a href="#" class="icon-envelope"></a>                                         
                                            <a href="#" class="icon-remove"></a>
                                        </div>                                                                
                                    </div>
                                </div>                         

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/helen_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Helen</a>                                                                        
                                        <div class="controls">                    
                                            <a href="#" class="icon-pencil"></a> 
                                            <a href="#" class="icon-envelope"></a>                                         
                                            <a href="#" class="icon-remove"></a>
                                        </div>                                                                
                                    </div>
                                </div>                                  

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexander_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexander</a>                                                                        
                                        <div class="controls">                    
                                            <a href="#" class="icon-pencil"></a> 
                                            <a href="#" class="icon-envelope"></a>                                         
                                            <a href="#" class="icon-remove"></a>
                                        </div>                                                                
                                    </div>
                                </div>                                                          

                        </div>                

                    </div>                

                </div>            

                <div class="dr"><span></span></div>           


            </div>






