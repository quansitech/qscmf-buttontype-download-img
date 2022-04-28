## DownloadImgButtonBuilder
```text
构建一个带有描述文字图片的模态框，支持下载功能
```

#### setTitle
```text
设置模态框的标题
```
```php
// 参数说明
// string $title 标题
->setTitle("title")
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
->setImgName("img_name")
```

#### setImgScale
```text
设置下载图片比例，默认为 3.125
```
```php
// 参数说明
// string $img_scale 下载图片比例
->setImgScale("img_scale")
```

#### setImgNameAttribute
```text
设置图片描述文字属性，例如自定义样式，默认为 style="font-weight: bold;font-size: 40px;"
```
```php
// 参数说明
// string $img_name_attribute 图片描述文字属性
->setImgNameAttribute("img_name_attribute")
```

#### setDialogWidth
```text
设置模态框的宽度，默认为auto
```
```php
// 参数说明
// string $width 标题
->setDialogWidth("250")
```