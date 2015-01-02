<?php

defined('C5_EXECUTE') or die('Access Denied.');

$includeAssetLibrary = true;
$assetLibraryPassThru = array(
    'type' => 'image'
);
$al = Loader::helper('concrete/asset_library');

$altText = $controller->altText;
$thumbnailWidth = $controller->thumbnailWidth;
$thumbnailHeight = $controller->thumbnailHeight;

$hideOriginalOnZoom = $controller->hideOriginalOnZoom ? 1 : 0;
$limitMaxZoom = $controller->limitMaxZoom ? 1 : 0;

$this->inc('form.php', get_defined_vars());
