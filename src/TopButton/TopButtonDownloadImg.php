<?php

namespace Qs\DownloadImg\TopButton;

use Qs\DownloadImg\DownloadImgButtonBuilder;
use Qscmf\Builder\ButtonType\ButtonType;

class TopButtonDownloadImg extends ButtonType
{
    public function build(array &$option, $listBuilder)
    {
        $my_attribute['type'] = 'download_img';
        $my_attribute['title'] = '下载图片';
        $my_attribute['class'] = 'btn btn-success';

        $builder = $option['options'] instanceof DownloadImgButtonBuilder ?
            $option['options'] : $this->defaultBuilder();

        $gid = $builder->getGid();

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = array_merge($my_attribute, $option['attribute']);
        }
        $option['attribute']['id'] = $gid;

        \Bootstrap\RegisterContainer::registerBodyHtml((string)$builder);
        return '';
    }

    protected function defaultBuilder(){
        $builder = new DownloadImgButtonBuilder("下载图片", '', microtime(true));

        return $builder;
    }

}