## DownloadImgButtonBuilder
```text
构建一个带有描述文字图片的模态框，支持下载功能
```

#### 实例化类
```php
// 参数说明
// string $modal_title 模态框标题
// string $img_full_url 图片路径
// string $file_name 文件名

new DownloadImgButtonBuilder("下载小程序码", "https://site_url/img_url.jpg", "xxx分享码");
```

#### setModalTitle
```text
设置模态框的标题
```
```php
// 参数说明
// string $modal_title 标题
->setModalTitle("下载小程序码")
```

#### setFileName
```text
设置文件名
```
```php
// 参数说明
// string $file_name 文件名
->setFileName("xxx分享码")
```

#### setImgFullUrl
```text
设置图片路径，为绝对地址
```
```php
// 参数说明
// string $img_full_url 图片路径
->setImgFullUrl("https://site_url/img_url.jpg")
```

#### setImgName
```text
设置图片描述文字
```
```php
// 参数说明
// string $img_name 图片描述文字
// string $style 文字样式，默认为font-weight: bold;font-size: 40px;
->setImgName("全思主页码","font-weight: bold;font-size: 40px;")
```

#### setImgScale
```text
设置下载图片比例，默认为 3.125
```
```php
// 参数说明
// string $img_scale 下载图片比例
->setImgScale("3.125")
```

#### setModalDialogWidth
```text
设置模态框的宽度，默认为auto，如果不确定每张图片的大小，建议固定宽度。
```
```php
// 参数说明
// string $width 宽度
->setModalDialogWidth("250")
```