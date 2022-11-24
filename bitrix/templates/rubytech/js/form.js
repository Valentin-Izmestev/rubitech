// маска, чекбокс
$(".tel").mask("+7(999)999-9999");
function toggleChkbox() {
    var chkbox = this.nextElementSibling.querySelector('.chkbox')
    if (chkbox.classList.contains('active')) chkbox.classList.remove('active')
    else chkbox.classList.add('active')
}
// placeholder on file input field
function showFilename(input) {
    if (input) {
        var fileName = (input.files[0] ? input.files[0].name : ''),
            label = input.parentNode.querySelector('label')
        if (label) {
            label.textContent = (fileName.length ? fileName : "Прикрепить резюме (doc, pdf не более 20Мб)")
        }
    }
}

function updateChkbox() {
    var checkbox = document.querySelectorAll('.hhagree input')
    if (checkbox.length > 0) {
        for (let i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked && !checkbox[i].classList.contains('active'))
                checkbox[i].nextElementSibling.querySelector('.chkbox').classList.add('active')
            checkbox[i].addEventListener('change', toggleChkbox)
            // console.log('чекбокс работает')
        }
    }
}

window.addEventListener('load', () => {
    updateChkbox();
    showFilename(document.getElementById('att'))
})

// Заголовок и адрес страницы в форму
var h1 = document.querySelector('h1').innerHTML,
    url = document.location
u = document.querySelector('[name="form_hidden_45"]')
h = document.querySelector('[name="form_hidden_46"]')
if (u) u.value = url
if (h) h.value = h1