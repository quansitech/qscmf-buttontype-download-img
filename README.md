# quansitech/qscmf-buttontype-download-img
```text
qscmf 按钮类型组件--download-img

可以向列表行、表单页添加此类型按钮

展示并可以下载带有文字描述的图片，常用于下载二维码、小程序码场景。
```

#### 安装

```php
composer require quansitech/qscmf-buttontype-download-img
```

#### 添加按钮
[DownloadImgButtonBuilder使用说明](https://github.com/quansitech/qscmf-buttontype-download-img/blob/master/DownloadImgButtonBuilder.md)


+ 向列表添加一个行按钮
  ```php
  
    protected function genDownloadImage($ent){
        $img_full_url = showFileUrl($ent['cover']);
        $img_full_url = $img_full_url ? HTTP_PROTOCOL."://".SITE_URL.$img_full_url: "";
        $builder = new DownloadImgButtonBuilder("下载小程序码", $img_full_url, $ent['name']." 主页码");
        $builder->setImgName($ent['name']);
        $builder->setDialogWidth("450");
        $builder->setImgNameAttribute('style="font-weight: bold;font-size: 20px;"');

        return $builder;
    }
  
    public function index(){
      $data_list = D('User')->select();
      foreach($data_list as &$data){
        $data['download_img'] = $this->genDownloadImage($data);
      }
  
      // 每一行数据需要定义'download_img'的值，且该值为DownloadImgButtonBuilder对象 
       (new \Qscmf\Builder\ListBuilder())
      ->addRightButton('download_img',['title' => '下载小程序码'], '', '', 'download_img')
      ->setTableDataList($data_list);
  
    } 
  ```
  

+ 向表单添加一个按钮
  ```php
    public function edit($id){
    if (IS_POST) {
        // 业务逻辑
    }
    else {
        $info = D('User')->getOne($id);
        $info['download_img'] = $this->genDownloadImage($info)
        
         // 表单数据需要定义'download_img'的值，且该值为DownloadImgButtonBuilder对象 
         (new \Qscmf\Builder\FormBuilder())
        ->addButton('download_img',['title' => '下载小程序码'], '', '', 'download_img')
        ->setFormData($info)
    }
  }
  ```
  

#### 效果图
![download-img-eg](https://user-images.githubusercontent.com/35066497/165727366-a93d48c6-51f1-4cc1-ac61-34668d7e206d.png)