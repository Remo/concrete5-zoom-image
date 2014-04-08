<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class ZoomImagePackage extends Package {

    protected $pkgHandle = 'zoom_image';
    protected $appVersionRequired = '5.2.0';
    protected $pkgVersion = '1.0.7';

    public function getPackageDescription() {
        return t("Adds images and onstates from the library to pages.");
    }

    public function getPackageName() {
        return t("Zoom Image");
    }

    public function install() {
        $pkg = parent::install();

        // install block		
        BlockType::installBlockTypeFromPackage('zoom_image', $pkg);
    }
    
    public function upgrade() {
        parent::upgrade();
        $bt = BlockType::getByHandle('zoom_image');
        if(is_object($bt)) {
            $bt->refresh();
        }
    }

}