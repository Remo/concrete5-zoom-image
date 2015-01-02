<?php

namespace Concrete\Package\ZoomImage\Block\ZoomImage;

use \Concrete\Core\Block\BlockType\BlockType,
    \Concrete\Core\Block\BlockController,
    \Concrete\Core\File\File,
    Loader;

class Controller extends BlockController {

    protected $btInterfaceWidth = 450;
    protected $btInterfaceHeight = 500;
    protected $btTable = 'btZoomImage';

    /**
     * Used for localization. If we want to localize the name/description we have to include this
     */
    public function getBlockTypeDescription() {
        return t("Adds images and onstates from the library to pages.");
    }

    public function getBlockTypeName() {
        return t("Zoom Image");
    }

    public function getJavaScriptStrings() {
        return array(
            'image-required' => t('You must select an image.')
        );
    }

    protected function getFileObject() {
        if ($this->fID > 0) {
            return File::getByID($this->fID);
        }
        return null;
    }

    public function save($args) {
        $args['fID'] = ($args['fID'] != '') ? $args['fID'] : 0;
        $args['displayCaption'] = ($args['displayCaption'] != '') ? $args['displayCaption'] : 0;
        $args['hideOriginalOnZoom'] = empty($args['hideOriginalOnZoom']) ? 0 : 1;
        $args['limitMaxZoom'] = empty($args['limitMaxZoom']) ? 0 : 1;
        parent::save($args);
    }

    public function add() {
        $this->set('bl', null);
    }

    public function edit() {
        $bf = $this->getFileObject();
        $this->set('bf', $bf);
    }

    public function view() {
        $ih = Loader::helper('image');

        $fileObject = $this->getFileObject();

        $fileName = $fileObject->getRelativePath();
        $thumbnail = $ih->getThumbnail($fileObject, intval($this->thumbnailWidth), intval($this->thumbnailHeight));

        $this->set('fileName', $fileName);
        $this->set('thumbnail', $thumbnail);

        // add JavaScripts to footer
        $b = $this->getBlockObject();
        $btID = $b->getBlockTypeID();
        $bt = BlockType::getByID($btID);

        $uh = Loader::helper('concrete/urls');

        $this->addFooterItem('<script type="text/javascript" src="' . $uh->getBlockTypeAssetsURL($bt) . '/fancyzoom.min.js"></script>');
        $this->addFooterItem('<script type="text/javascript">$(document).ready(function() { $("a.zoomImage").fancyZoom({scaleImg: true, closeOnClick: true, directory:"' . $uh->getBlockTypeAssetsURL($bt) . '/images"}); });</script>');
    }

}
