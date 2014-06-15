<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 */
?>
<?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
<div class="row">
    <div class="alert alert-<?php echo $key; ?>"><?php echo $message; ?></div>
</div>
<?php endforeach; ?>