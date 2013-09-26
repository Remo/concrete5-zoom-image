<?php
defined('C5_EXECUTE') or die('Access Denied.');

$version_arr = explode('.', APP_VERSION);

if ($version_arr[1] < 2)
    die("This block doesn't support concrete" . APP_VERSION);
if ($version_arr[1] == 2) {
    $fo = $controller->getAssetFileObject();

    $fileName = $fo->getFileRelativePath();
    $thumbnail = $fo->getThumbnail(intval($controller->thumbnailWidth), intval($controller->thumbnailHeight));
} else {
    $ih = Loader::helper('image');
    $fo = $controller->getFileObject();

    $fileName = $fo->getRelativePath();
    $thumbnail = $ih->getThumbnail($fo, intval($controller->thumbnailWidth), intval($controller->thumbnailHeight));
}
?>

<a class="zoomImage" href="#zoomImage<?php echo $bID;?>">
    <img src="<?php echo $thumbnail->src;?>" 
         alt="<?php echo $controller->altText;?>"
         width="<?php echo $thumbnail->width;?>" 
         height="<?php echo $thumbnail->height;?>"/>
</a>

<div id="zoomImage<?php echo $bID;?>" style="display:none;">
    <img src="<?php echo $fileName;?>" alt="<?php echo $controller->altText;?>"/>
    <?php if ($controller->displayCaption):?>
        <p id="zoomImage<?php echo $bID;?>_caption"><?php echo $controller->altText;?></p>
    <?php endif;?>
</div>
