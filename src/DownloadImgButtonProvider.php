<?php
namespace Qs\ListRightButton;

use Qs\ListRightButton\DownloadImg\DownloadImg;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class DownloadImgButtonProvider implements Provider
{

    public function register()
    {
        RegisterContainer::registerListRightButtonType('download_img', DownloadImg::class);
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/download-img', __DIR__ . '/../asset');
    }

}