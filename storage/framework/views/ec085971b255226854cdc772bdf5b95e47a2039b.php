<?php $__env->startSection('content'); ?>

<div class="messages">

    

    <div class="col-md-9  right-col ">

        <div class="panel panel-default padding-sm">

            <div class="panel-body">
                <div><a href="../messages" class="normalize-link-color"><i class="fa fa-arrow-right" aria-hidden="true"></i> الرجوع</a></div>
                <br>
               

                

                <hr>

                <ul class="list-group row">
                   <?php foreach($messages as $message): ?> 
  

                     <li class="list-group-item media " style="margin-top: 0px;"  >
                       
								
							<?php if($message->msg_from == $id): ?>
								  <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($partner->avatar_url); ?>"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos pull-right">

                          <div class="media-heading ">

                           <small class="pull-left"><i><?php echo e($message->date); ?></i></small>
                             
								  <a href="../user/<?php echo e($partner->id); ?>" class="pull-right">
								<h4><?php echo e($partner->username); ?></h4>
								</a>
								  
                           
							
                          </div>
							<br>
                          <div class="media-body markdown-reply content-body">
                                <h3 class="pull-right"> <?php echo e($message->text); ?> </h3>
                          </div>

                           
                        </div>
						
							<?php elseif($message->msg_from == $user->id): ?>
							  <div class="avatar pull-right">
                            <a href="">
                                <img class="media-object img-thumbnail avatar" alt="" src="<?php echo e($user->avatar_url); ?>"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos pull-right">

                          <div class="media-heading ">

                         
                               <small class="pull-left"><i><?php echo e($message->date); ?></i></small>
							  <a href="" class="pull-right">
								<h3>انت</h3>
								</a>
								  
                          <div >
                                
                            </div>
							<br>
                          </div>
							<br>
                          <div class="media-body markdown-reply content-body ">
                              <h3 class="pull-right"> <?php echo e($message->text); ?> </h3>
                          </div>

                            
                        </div>
								<?php endif; ?>
                                     
                                
                         
                    </li>
                   <?php endforeach; ?>
                </ul>
				<?php echo $__env->make('messages.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>