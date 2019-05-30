Dropzone.autoDiscover = false;
$(function() {
    let app = {
        updateInfo: (info) => {
            $('.info')
                .removeClass()
                .addClass('info')
                .addClass(info.type)
                .text(info.content)
                .show();
        },
        updateFiles: (view) => {
            $('.files').replaceWith($(view));
        }
    };
    let myDropzone = new Dropzone('div#dropzone', {
        url: 'index.php?upload',
        init: function() {
            this.on('success', (file, response) => {
                app.updateInfo(response.info);
                app.updateFiles(response.files);
            })
        }
    });
});
