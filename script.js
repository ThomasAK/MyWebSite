'use strict';

const sections = document.querySelectorAll('.section')
const nav = document.querySelector('.navbar-nav')
const content = document.querySelector('.content')
const navItems = document.querySelectorAll('.nav-item')
const navToggler = document.querySelector('.navbar-toggler')

const changeContent = function (element){
    // Guard clause
    if (!element) return;

    // Remove active classes
    sections.forEach(t => t.classList.remove('content-toDisplay--active'));
    console.log('burritos')

    // Activate content area
    document
        .getElementById(element.text)
        .classList.add('content-toDisplay--active');
}

nav.addEventListener('click', function (e){
    changeContent(e.target.closest('.nav-item'))
})

navItems.forEach(item => {
    item.addEventListener('click', function (e){
        if ($(window).width() < 992){
            navToggler.click()
        }
    })
})



