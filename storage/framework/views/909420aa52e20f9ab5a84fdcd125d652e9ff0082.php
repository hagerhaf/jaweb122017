<?php $__env->startSection('content'); ?>
<div class="messages">



<div class="col-md-9  left-col ">

    <div class="panel panel-default padding-sm">

        <div class="panel-heading">
            <h1 class="pull-right">الرسائل</h1>
        </div>

      <br><br>
      <br><br>
            <div class="panel-body remove-padding-horizontal notification-index">
 <?php  $other=null;   ?>
                <ul class="list-group row">
                
<?php foreach($messages as $message): ?> 

                    <?php if($message->msg_read ==0 ): ?>
						  <li class="list-group-item media " style="margin-top: 0px;background-color: aliceblue;">
					<?php if($message->msg_from != Auth::user()->id): ?>
						 <?php foreach($users as $pic): ?>
							<?php if($pic->id == $message->msg_from): ?>
								<div class="avatar pull-right">
								<a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($pic->avatar_url); ?>"  style="width:48px;height:48px;"/>
								</a>
								</div><br>
																<b class="pull-right"><?php echo e($pic->username); ?> </b>

							
								<?php  $other=$message->msg_from;   ?>
								
							<?php endif; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<?php foreach($users as $pic): ?>
							<?php if($pic->id == $message->msg_to): ?>
								<div class="avatar pull-right">
								<a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($pic->avatar_url); ?>"  style="width:48px;height:48px;"/>
								</a>
								</div><br>
								<b class="pull-right"><?php echo e($pic->username); ?> </b>
							    <?php  $other=$message->msg_to;   ?>
								
							<?php endif; ?>
						<?php endforeach; ?>
				    <?php endif; ?>
                       

<div class="infos">

<div class="media-heading">
<span class="meta">
<span class="timeago"><i class="pull-right"><?php echo e($message->date); ?> </i></span>
</span>
</div>
<br>
<div class="media-body markdown-reply content-body"  >
<b class="pull-right" >   <?php echo e($message->text); ?> </b>
 </div>
  <div class="message-meta push-right">
<p>	
<?php if($message->msg_from !=Auth::user()->id): ?>
<a href="messages/<?php echo e($message->msg_from); ?>" class="normalize-link-color ">                                
<span style="color:#ff7b00;" class="pull-right">
<i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
</span>    </a>
<?php else: ?>

<a href="messages/<?php echo e($message->msg_to); ?>" class="normalize-link-color ">                                
<span style="color:#ff7b00;" class="pull-right">
<i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
</span>    </a>
<?php endif; ?>															

								
								
							
                                </p>
                            </div>
                        </div>
                    </li>
					
					
						  <?php else: ?>
							   <li class="list-group-item media " style="margin-top: 0px;">
						   
						   
					 <?php if($message->msg_from != Auth::user()->id): ?>
					<?php foreach($users as $user): ?>
				 <?php if($message->msg_from == $user->id): ?>
					 <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($user->avatar_url); ?>"  style="width:48px;height:48px;"/>
                            </a>
							
                        </div><br>
					 <b class="pull-right"><?php echo e($user->username); ?>  </b>
				 <?php endif; ?>
				 
				 <?php endforeach; ?>
				 
				 
				 
				 <?php else: ?>
					 
				 <?php foreach($users as $user): ?>
				 <?php if($message->msg_to == $user->id): ?>
					 <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($user->avatar_url); ?>"  style="width:48px;height:48px;"/>
                            </a>
							
                        </div><br>
					 <b class="pull-right"><?php echo e($user->username); ?>  </b>
				 <?php endif; ?>
				 
				 <?php endforeach; ?>
				 
				 
					
				 <?php endif; ?>
                        

                        <div class="infos">

                          <div class="media-heading">


                           
                            <span class="meta">
                               <span class="timeago"><i class="pull-left"><?php echo e($message->date); ?> </i></span>
                            </span>
                          </div>
                         
                          <div class="media-body markdown-reply content-body pull-right">
						  
						  
						  <br>
                           <h5 class="pull-right">    <?php echo e($message->text); ?> </h5>
                          </div>
						    <div class="message-meta">
                                <p>
								<?php if($message->msg_from !=Auth::user()->id): ?>
									 <a href="messages/<?php echo e($message->msg_from); ?>" class="normalize-link-color ">

                                 
                                    <span style="color:#ff7b00;" class="pull-right">
                                         <i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
                                       
                                    </span>

                                  

                                </a>

<?php else: ?>
 <a href="messages/<?php echo e($message->msg_to); ?>" class="normalize-link-color ">

                                 
                                    <span style="color:#ff7b00;" class="pull-right">
                                         <i class="fa fa-commenting-o" aria-hidden="true"><b class="pull-right">اقرا المحادثة </b></i>
                                       
                                    </span>

                                  

                                </a>

<?php endif; ?>
                                
                                </p>
                            </div>
                        </div>
                    </li>
						  
						  <?php endif; ?>
						  
						  
                          
                <?php endforeach; ?>
                </ul>
            </div>

            <div class="panel-footer text-right remove-padding-horizontal pager-footer">

            </div>

     

    </div>
</div>
</div>


 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>