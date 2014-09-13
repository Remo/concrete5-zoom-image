<?php

namespace Concrete\Package\ZoomImage;

use Concrete\Core\Block\BlockType\BlockType;

class Controller extends \Concrete\Core\Package\Package {

    protected $pkgHandle = 'zoom_image';
    protected $appVersionRequired = '5.7.0';
    protected $pkgVersion = '2.0.0';

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
