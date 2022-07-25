function downloadCanvas(downloadBtnDom, captureId, posterId){
    downloadBtnDom.on('click', function () {
        const captureDom = $('#'+captureId);
        const posterDom = $('#'+posterId);

        let $this = $(this);
        let btn_text = $this.text();
        let fileName = $(this).data('file-name');
        let scale = $(this).data('scale') || 3.125;

        $this.text('下载中').attr('disabled',true);
        let w = captureDom.outerWidth();
        let h = captureDom.outerHeight();

        html2canvas(captureDom[0], { width: w, height: h, scrollX: 0, scrollY: 0, scale: scale, backgroundColor: '#fff' }).then(
            canvas => {
                posterDom.attr('src', canvas.toDataURL("image/png", 1.0));
                let content = posterDom.attr('src');
                if (!content) {
                    alert('暂无资源可下载');
                    $this.text(btn_text).removeAttr('disabled');
                } else {
                    downloadFile(content, fileName);
                    $this.text(btn_text).removeAttr('disabled');
                }
            }
        );
    });
}

function loadAndShow(imgUrl, imgDom, modalDom) {
    let img = "";
    let canvas = document.createElement('canvas'),
        ctx = canvas.getContext('2d');
    img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function(){
        canvas.height = img.height;
        canvas.width = img.width;
        ctx.drawImage(img, 0, 0);
        imgDom.attr('src', canvas.toDataURL('image/png'));
        canvas = null;
        modalDom.modal('show');
    }
    img.src = imgUrl;
}

function downloadFile(content, fileName) { //下载base64图片
    var base64ToBlob = function (code) {
        let parts = code.split(';base64,');
        let contentType = parts[0].split(':')[1];
        let raw = window.atob(parts[1]);
        let rawLength = raw.length;
        let uInt8Array = new Uint8Array(rawLength);
        for (let i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }
        return new Blob([uInt8Array], {
            type: contentType
        });
    };
    let aLink = document.createElement('a');
    let blob = base64ToBlob(content); //new Blob([content]);
    let evt = document.createEvent("HTMLEvents");
    evt.initEvent("click", true, true); //initEvent 不加后两个参数在FF下会报错  事件类型，是否冒泡，是否阻止浏览器的默认行为
    aLink.download = fileName;
    aLink.href = URL.createObjectURL(blob);
    aLink.click();
}

function getPromise(apiUrl){
    return new Promise((resolve, reject) =>{
        $.get(apiUrl, function (res) {
            if (res.status === 1) {
                resolve(res);
            }
            if (res.status === 0){
                reject(res);
            }
        });
    });
}

function injectImgName(opt,dom){
    if (opt.name){
        dom.attr('style', opt.style);
        dom.text(opt.name);
    }else{
        dom.attr('style','display:none');
    }
}

function injectDownHtml(opt,dom){
    dom.data('scale', opt.scale);
    dom.data('file-name', opt.fileName);
}