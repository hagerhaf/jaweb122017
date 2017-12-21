<?php foreach($messages as $message): ?> 
  <li><?php echo e($message->text); ?></li>
<?php endforeach; ?>