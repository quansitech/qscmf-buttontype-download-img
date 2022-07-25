<?php

namespace Qs\ListRightButton;

use Qs\ModalButton\ModalButtonBuilder;

class DownloadImgButtonBuilder
{
    protected ModalButtonBuilder $modal_builder;
    protected $html;
    protected $modal_title;
    protected $file_name;

    protected $img_name;
    protected $img_full_url;
    protected $img_name_style;
    protected $img_scale = 3.125;
    protected $use_api = false;

    public function __construct($modal_title,$img_full_url,$file_name)
    {
        $this->setModalTitle($modal_title);
        $img_full_url && $this->setImgFullUrl($img_full_url);
        $file_name && $this->setFileName($file_name);
        $this->modal_builder = new ModalButtonBuilder();
        $this->setModalDialogWidth('auto');
        $this->modal_builder->setDialogHeight('auto');
    }

    public function getGid():string{
        return $this->modal_builder->getGid();
    }

    public function getModalDom():string{
        return $this->modal_builder->getModalDom();
    }

    public function setModalTitle($modal_title):self{
        $this->modal_title = $modal_title;
        return $this;
    }

    public function getModalTitle():string{
        return $this->modal_title;
    }

    public function setFileName($file_name):self{
        $this->file_name = $file_name;
        return $this;
    }

    public function getFileName():string{
        return $this->file_name;
    }

    public function setImgName($img_name, $style = 'font-weight: bold;font-size: 40px;'):self{
        $this->img_name = $img_name;
        $this->img_name_style = $style;
        return $this;
    }

    public function setImgFullUrl($img_full_url):self{
        $this->img_full_url = $img_full_url;
        return $this;
    }

    public function setModalDialogWidth($width):self{
        $this->modal_builder->setDialogWidth($width);
        return $this;
    }
    public function setImgScale($img_scale):self{
        $this->img_scale = $img_scale;
        return $this;
    }

    public function setUseApi($use_api):self{
        $this->use_api = $use_api;
        return $this;
    }

    protected function getApiUrl():string{
        return $this->use_api ? $this->img_full_url : '';
    }

    public function __toString(){
        if (!$this->html){
            $view = new \Think\View();
            $view->assign('gid', $this->getGid());
            $view->assign('modal_dom', $this->getModalDom());
            $view->assign('img_full_url', $this->img_full_url);
            $view->assign('file_name', $this->file_name);
            $view->assign('img_name', $this->img_name);
            $view->assign('img_name_style', $this->img_name_style);
            $view->assign('img_scale', $this->img_scale);
            $view->assign('api_url', $this->getApiUrl());

            $this->html = $view->fetch(__DIR__ . '/download_img.html');
        }

        $this->buildModal();

        return (string)$this->modal_builder;
    }

    protected function buildModal(){
        $this->modal_builder->setTitle($this->modal_title);
        $this->modal_builder->setBody($this->html);
        $this->modal_builder->setAjaxSubmit(false);
        $this->modal_builder->showDefBtn(false);
        $this->modal_builder->addFooterButton('关闭', ['type' => 'button', 'class' => 'btn btn-secondary closeModal', 'data-dismiss' => 'modal']);
        $this->modal_builder->addFooterButton('下载', ['type' => 'button', 'class' => 'btn btn-primary no-refresh no-forward downloadCode']);
    }
}