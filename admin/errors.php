<?php if(count($errors)>0): ?>
<div class="errors">
<?php foreach((array)$errors as $errors): ?>
<p><?php echo $errors; ?></p>
<?php endforeach ?>
</div>
<?php endif ?>