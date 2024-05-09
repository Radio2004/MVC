"use strict";

// Change title when user out the window
// const startTitle = document.title;
// document.addEventListener('visibilitychange', function() {
//     document.title = document.hidden ? 'Повернися😥' : startTitle;
// });

// Hide/Show Langauge
const translateSwitcher = document.querySelector('.translate_switcher');
const wrapperTranslate = document.querySelector('.wrapper-change-ln');

translateSwitcher.addEventListener('click', function () {
    if (wrapperTranslate.classList.contains('change-ln-off')) {
        wrapperTranslate.classList.add('change-ln-on');
        wrapperTranslate.classList.remove('change-ln-off');
        return;
    }

    wrapperTranslate.classList.add('change-ln-off');
    wrapperTranslate.classList.remove('change-ln-on');
});

// Show/Hide Setting Menu User
const userNameHTML = document.querySelector('.name-user');

if (userNameHTML) {
    userNameHTML.addEventListener('click', function () {
        const userMenu = document.querySelector('.wrapper-user-menu');
        if (userMenu.classList.contains('hide')) {
            userMenu.classList.add('show');
            userMenu.classList.remove('hide');
            return;
        }

        userMenu.classList.add('hide');
        userMenu.classList.remove('show');
    })
}

// Click on window to close some Open Menu
document.addEventListener('click', function (event) {
    const parentTranslateLangauge = document.querySelector('.translate');
    const userMenu = document.querySelector('.wrapper-user-menu');

    if (event.target != parentTranslateLangauge && !parentTranslateLangauge.contains(event.target)) {
        wrapperTranslate.classList.add('change-ln-off');
        wrapperTranslate.classList.remove('change-ln-on');
    }

    if (userNameHTML && event.target != userNameHTML && !userNameHTML.contains(event.target)) {
        userMenu.classList.add('hide');
        userMenu.classList.remove('show');
    }
});


// KeyDown F12

document.addEventListener('keydown', function (e) {
    if (e.code == "F12") {
        let wrapperCommand = document.querySelector('.d-center');
        wrapperCommand.classList.toggle('d-none');
    }
})

const testCommand = document.querySelector('.command-line');

let resultCommand = document.querySelector('.result-command');

let lastCommand = '';

testCommand.addEventListener('keydown', function (e) {
    if (e.code == "Enter") {
        e.preventDefault();
       
        const xhr = new XMLHttpRequest();

      
        xhr.open("POST", "/command", true);

       
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        lastCommand = e.target.value.split('\n').pop();
      
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (lastCommand.toLowerCase() == 'clear' && response == '') {
                    resultCommand.textContent = response;
                    return;
                }
                resultCommand.textContent += '\n' + response;
                resultCommand.scrollTop = resultCommand.scrollHeight;
            }
        };

        xhr.send(`command=${lastCommand}`);
    }
})