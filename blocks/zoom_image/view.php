<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>

<a class="zoomImage" href="#zoomImage<?php echo $bID; ?>"<?php echo empty($hideOriginalOnZoom) ? '' : '  data-hide-original-on-zoom="yes"'; ?><?php echo empty($limitMaxZoom) ? '' : '  data-limit-max-zoom="yes"'; ?>>
    <img src="<?php echo $thumbnail->src; ?>" 
         alt="<?php echo $controller->altText; ?>"
         width="<?php echo $thumbnail->width; ?>" 
         height="<?php echo $thumbnail->height; ?>"/>
</a>

<div id="zoomImage<?php echo $bID; ?>" style="display:none;">
    <img src="<?php echo $fileName; ?>" alt="<?php echo $controller->altText; ?>"/>
    <?php if ($controller->displayCaption): ?>
        <p id="zoomImage<?php echo $bID; ?>_caption"><?php echo $controller->altText; ?></p>
    <?php endif; ?>
</div>
