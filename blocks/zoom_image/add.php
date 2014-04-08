<?php

defined('C5_EXECUTE') or die('Access Denied.');

$includeAssetLibrary = true;
$assetLibraryPassThru = array(
    'type' => 'image'
);
$al = Loader::helper('concrete/asset_library');
$bf = null;

$altText = '';
$thumbnailWidth = 200;
$thumbnailHeight = 200;
$hideOriginalOnZoom = 0;
$limitMaxZoom = 0;

include('form.php');
