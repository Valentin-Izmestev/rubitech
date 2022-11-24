// ajax отправка формы с попап окном в случае успеха
//*
BX.ajax.submitComponentForm = function(obForm, container, bWait) {
    if (!obForm.target) {
        if (null == obForm.BXFormTarget) {
            var frame_name = 'formTarget_' + Math.random();
            obForm.BXFormTarget = document.body.appendChild(BX.create('IFRAME', {
                props: {
                    name: frame_name,
                    id: frame_name,
                    src: 'javascript:void(0)'
                },
                style: {
                    display: 'none'
                }
            }));
        }
        obForm.target = obForm.BXFormTarget.name;
    }

    if (!!bWait) var w = BX.showWait(container);

    obForm.BXFormCallback = function(d) {
        if (!!bWait)
            BX.closeWait(w);
        var callOnload = function() {
            if(!!window.bxcompajaxframeonload) {
                setTimeout(function(){window.bxcompajaxframeonload();window.bxcompajaxframeonload=null;}, 10);
            }
        };
        console.log(d)
        if(d == 'Success') {
            console.log('Work!')
            $.fancybox.open('<div class="message"><div class="flex"><h3>Спасибо!<br>Ваше сообщение успешно отправлено.</h3></div></div>');
            $(document).on('afterShow.fb', function( e, instance, slide ) {
                $('[name^="SIMPLE_FORM"]')[0].reset();
            });
            // alert('Спасибо! Ваше сообщение успешно отправлено.');
            console.log('form reset')
        } else {
            BX(container).innerHTML = d;
            console.log('not success')
            updateChkbox()
        }
        BX.onCustomEvent('onAjaxSuccess', [null,null,callOnload]);
    };
    BX.bind(obForm.BXFormTarget, 'load', BX.proxy(BX.ajax._submit_callback, obForm));
    return true;
};
// */
