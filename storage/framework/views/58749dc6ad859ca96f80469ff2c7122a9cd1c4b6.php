<?php $__env->startSection('title'); ?>
<?php echo e(trans('hifone.users.edit_profile')); ?>@parent
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>





<form action="/createmsg" method="post">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<table>
<tr>
<td>Name</td>
<td><div class="field"><input type='text' name='msg_body' id="input-default" class="emojiable-option" /><div class="emojiPickerIcon black" style="height: 40px; width: 40px; background-color: rgb(238, 238, 238);"></div></div></td>
</tr>
<tr>
<td colspan='2'><input type='submit' value="Add student" /></td>
</tr>
</table>
</form>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>