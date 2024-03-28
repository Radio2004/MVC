"use strict";

// Change title when user out the window
// const startTitle = document.title;
// document.addEventListener('visibilitychange', function() {
//     document.title = document.hidden ? 'Повернися😥' : startTitle;
// });

// Hide/Show Langauge
const translateSwitcher = document.querySelector('.translate_switcher');
const wrapperTranslate = document.querySelector('.wrapper-change-ln');

translateSwitcher.addEventListener('click', function() {
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
    userNameHTML.addEventListener('click', function() {
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
document.addEventListener('click', function(event) {
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