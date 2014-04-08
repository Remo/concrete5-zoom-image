<?php /*@var $form FormHelper */ ?><div class="ccm-block-field-group">
    <h2><?php echo t('Image')?></h2>
    <?php echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf);?>
</div>

<div class="ccm-block-field-group">
    <h2><?php echo t('Alt Text')?></h2>
    <?php echo $form->text('altText', $altText, array('style' => 'width: 250px'));?>
    <br/>
    <input name="displayCaption" type="checkbox" value="1" <?php echo ($displayCaption) ? 'checked' : ''?>/> <?php echo t('Display as sub title')?>
</div>


<div class="ccm-block-field-group">
    <h2><?php echo t('Max Thumbnail Width')?></h2>
    <?php echo $form->text('thumbnailWidth', $thumbnailWidth, array('style' => 'width: 250px'));?>
</div>

<div class="ccm-block-field-group">
    <h2><?php echo t('Max Thumbnail Height')?></h2>
    <?php echo $form->text('thumbnailHeight', $thumbnailHeight, array('style' => 'width: 250px'));?>
</div>

<div class="ccm-block-field-group">
	<h2><?php echo t('Options')?></h2>
	<label>
		<?php echo $form->checkbox('hideOriginalOnZoom', 1, $hideOriginalOnZoom); ?>
		<?php echo t('Hide original image when zoomed'); ?>
	</label><br />
	<label>
		<?php echo $form->checkbox('limitMaxZoom', 1, $limitMaxZoom); ?>
		<?php echo t('Limit max zoom to window size'); ?>
	</label>
</div>
