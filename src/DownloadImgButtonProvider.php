<?php
namespace Qs\DownloadImg;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use Qs\DownloadImg\ListRightButton\RightButtonDownloadImg;
use Qs\DownloadImg\TopButton\TopButtonDownloadImg;

class DownloadImgButtonProvider implements Provider
{
    public function register()
    {
        RegisterContainer::registerListRightButtonType('download_img',RightButtonDownloadImg::class);
        RegisterContainer::registerListTopButton('download_img', TopButtonDownloadImg::class);
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/download-img', __DIR__ . '/../asset');
    }

}