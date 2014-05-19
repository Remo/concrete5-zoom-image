<?php
/* @var $form FormHelper */

defined('C5_EXECUTE') or die('Access Denied.');
?>
<div class="form-group">
    <?php echo $form->label('ccm-b-image', t('Image')); ?>
    <?php echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf); ?>
</div>


<div class="form-group">
    <?php echo $form->label('altText', t('Alt Text')); ?>
    <?php echo $form->text('altText', $altText, array('style' => 'width: 250px')); ?>
    <input name="displayCaption" type="checkbox" value="1" <?php echo ($displayCaption) ? 'checked' : '' ?>/> <?php echo t('Display as sub title') ?>
</div>

<div class="form-group">
    <?php echo $form->label('thumbnailWidth', t('Max Thumbnail Width')); ?>
    <?php echo $form->text('thumbnailWidth', $thumbnailWidth, array('style' => 'width: 250px')); ?>
</div>

<div class="form-group">
    <?php echo $form->label('thumbnailHeight', t('Max Thumbnail Height')); ?>
    <?php echo $form->text('thumbnailHeight', $thumbnailHeight, array('style' => 'width: 250px')); ?>
</div>

<div class="form-group">
    <?php echo $form->label('options', t('Options')); ?>
    <div class="form-inline">
        <label>
            <?php echo $form->checkbox('hideOriginalOnZoom', 1, $hideOriginalOnZoom); ?>
            <?php echo $form->label('hideOriginalOnZoom', t('Hide original image when zoomed')); ?>
        </label>
        <br />
        <label>
            <?php echo $form->checkbox('limitMaxZoom', 1, $limitMaxZoom); ?>
            <?php echo $form->label('limitMaxZoom', t('Limit max zoom to window size')); ?>
        </label>
    </div>
</div>
