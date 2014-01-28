<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class ZoomImagePackage extends Package {

    protected $pkgHandle = 'zoom_image';
    protected $appVersionRequired = '5.2.0';
    protected $pkgVersion = '1.0.5';

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

}