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

+ 向列表添加一个顶部按钮
  ```php
  
    protected function genDownloadImage($ent){
        $img_full_url = showFileUrl($ent['cover']);
        $img_full_url = $img_full_url ? HTTP_PROTOCOL."://".SITE_URL.$img_full_url: "";
        $builder = new DownloadImgButtonBuilder("下载小程序码", $img_full_url, "全思-亲子阅读分享码");
        $builder->setImgName("全思-亲子阅读", "font-weight: bold;font-size: 20px;");
        $builder->setModalDialogWidth("450");

        return $builder;
    }
  
    public function index(){
      $data = D('User')->getOne(I("get.user_id"));
  
      // 每一行数据需要定义'download_img'的值，且该值为DownloadImgButtonBuilder对象 
       (new \Qscmf\Builder\ListBuilder())
      ->addTopButton('download_img',['title' => '下载小程序码'], '', '', $this->genDownloadImage($data))
      ->setTableDataList($data_list);
  
    } 
  ```

+ 向列表添加一个行按钮
  ```php
  
    protected function genDownloadImage($ent){
        $img_full_url = showFileUrl($ent['cover']);
        $img_full_url = $img_full_url ? HTTP_PROTOCOL."://".SITE_URL.$img_full_url: "";
        $builder = new DownloadImgButtonBuilder("下载小程序码", $img_full_url, "全思-亲子阅读分享码");
        $builder->setImgName("全思-亲子阅读", "font-weight: bold;font-size: 20px;");
        $builder->setModalDialogWidth("450");

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

+ 使用接口返回图片地址等信息，实例化*DownloadImgButtonBuilder*类的img_full_url为api地址。
  ```php
    protected function genDownloadImage($ent){
        $builder = new DownloadImgButtonBuilder("下载小程序码", U("fetchDownloadImageInfo",['id' => $ent['id']]), "全思-亲子阅读分享码");
        $builder->setImgName("全思-亲子阅读", "font-weight: bold;font-size: 20px;");
        $builder->setModalDialogWidth("450");
        $builder->setUseApi(true);

        return $builder;
    }
  
    public function fetchDownloadImageInfo($id){
        $ent = D("TestModal")->getOne($id);
        $img_full_url = showFileUrl($ent['cover']);
        $img_full_url = $img_full_url ? HTTP_PROTOCOL."://".SITE_URL.$img_full_url: "";
  
        // 返回值说明
        // img_full_url 设置图片路径，为绝对地址，该字段不能为空
        // 其它字段按需赋值，为空则以实例化类时设置的值为准，否则替换对应字段的值
        // file_name 设置文件名
        // img_name 设置图片描述文字
        // img_name_style 设置图片描述文字样式
        // img_scale 设置下载图片比例
  
        $this->ajaxReturn(['status' => 1, 'data' => [
            'img_full_url' => $img_full_url,
            'file_name' => '全思-亲子阅读分享码',
            'img_name' => '全思-亲子阅读',
            'img_name_style' => "font-weight: bold;font-size: 30px;",
            'img_scale' => 4,
        ]]);
    }
  
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


#### v1 升级 v2

v2增加了topButton类型，同时修改了命名空间，因此原来使用了DownloadImgButtonBuilder的地方需要修改成新的命名空间 
Qs\DownloadImg\DownloadImgButtonBuilder