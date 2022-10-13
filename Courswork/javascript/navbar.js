const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')


if (navToggle) {
    navToggle.addEventListener('click' , () => {
        navMenu.classList.add('show-menu')
    })
}

if (navClose) {
    navClose.addEventListener('click' , () => {
        navMenu.classList.remove('show-menu')
    })
}

const navLink = document.querySelectorAll('.nav_link')

function linkAction() {
    const navMenu = document.getElementById('nav-menu')
    navMenu.classList.remove('show-menu')
}

navLink.forEach(n => n.addEventListener('click' ,linkAction))

const user = document.getElementById('user_info'),
      userInfo = document.getElementById('user-icon'),
      userClose = document.getElementById('user_close')

if(userInfo) {
    userInfo.addEventListener('click', () => {
        user.classList.add('active')
    })
}

if(userClose) {
    userClose.addEventListener('click', () => {
        user.classList.remove('active')
    })
}

const find = document.getElementById('search_info'),
      searchInfo = document.getElementById('search'),
      searchClose = document.getElementById('search_close')

if(searchInfo) {
    searchInfo.addEventListener('click' , () => {
        find.classList.add('inactive')
    })
}

if(searchClose) {
    searchClose.addEventListener('click' , () => {
        find.classList.remove('inactive')
    })
}

function scrollHeader() {
    const header = document.getElementById('header')

    if (this.scrollY >= 50) header.classList.add('scroll-header'); else header.classList.remove('scroll-header')
}

window.addEventListener('scroll' , scrollHeader)