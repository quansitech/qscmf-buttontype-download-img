<?php

namespace Qs\ListRightButton;

use Qs\ModalButton\ModalButtonBuilder;

class DownloadImgButtonBuilder
{
    protected ModalButtonBuilder $modal_builder;
    protected $html;
    protected $title;
    protected $file_name;

    protected $img_name;
    protected $img_full_url;
    protected $img_name_attribute = 'style="font-weight: bold;font-size: 40px;"';
    protected $img_scale = 3.125;

    public function __construct($title, $img_full_url = '',$file_name = '')
    {
        $this->setTitle($title);
        $img_full_url && $this->setImgFullUrl($img_full_url);
        $file_name && $this->setFileName($file_name);
        $this->modal_builder = new ModalButtonBuilder();
        $this->setDialogWidth('auto');
        $this->modal_builder->setDialogHeight('auto');
    }

    public function getGid():string{
        return $this->modal_builder->getGid();
    }

    public function getModalDom():string{
        return $this->modal_builder->getModalDom();
    }

    public function setTitle($title):self{
        $this->title = $title;
        return $this;
    }

    public function getTitle():string{
        return $this->title;
    }

    public function setFileName($file_name):self{
        $this->file_name = $file_name;
        return $this;
    }

    public function getFileName():string{
        return $this->file_name;
    }

    public function setImgName($img_name):self{
        $this->img_name = $img_name;
        return $this;
    }

    public function setImgFullUrl($img_full_url):self{
        $this->img_full_url = $img_full_url;
        return $this;
    }

    public function setImgNameAttribute($img_name_attribute):self{
        $this->img_name_attribute = $img_name_attribute;
        return $this;
    }

    public function setDialogWidth($width):self{
        $this->modal_builder->setDialogWidth($width);
        return $this;
    }
    public function setImgScale($img_scale):self{
        $this->img_scale = $img_scale;
        return $this;
    }

    public function __toString(){
        if (!$this->html){
            $view = new \Think\View();
            $view->assign('gid', $this->getGid());
            $view->assign('modal_dom', $this->getModalDom());
            $view->assign('img_full_url', $this->img_full_url);
            $view->assign('file_name', $this->file_name);
            $view->assign('img_name', $this->img_name);
            $view->assign('img_name_attribute', $this->img_name_attribute);
            $view->assign('img_scale', $this->img_scale);

            $this->html = $view->fetch(__DIR__ . '/download_img.html');
        }

        $this->buildModal();

        return (string)$this->modal_builder;
    }

    protected function buildModal(){
        $this->modal_builder->setTitle($this->title);
        $this->modal_builder->setBody($this->html);
        $this->modal_builder->setAjaxSubmit(false);
        $this->modal_builder->showDefBtn(false);
        $this->modal_builder->addFooterButton('关闭', ['type' => 'button', 'class' => 'btn btn-secondary closeModal', 'data-dismiss' => 'modal']);
        $this->modal_builder->addFooterButton('下载', ['type' => 'button', 'class' => 'btn btn-primary no-refresh no-forward downloadCode']);
    }
}