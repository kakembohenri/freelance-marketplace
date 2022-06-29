// Toggle side

let side = document.querySelectorAll('.toggle-btn')

let forms = document.querySelectorAll('form')

let formSlider = document.querySelector('.slider')

let formContainer = document.querySelector('.form-container')
// Slide to freelancer
side[0].addEventListener('click', function(){
    formSlider.style.left = '0'
    forms[0].style.left = '0'
    forms[1].style.left = '100%'
    formContainer.style.height= '80rem'
})

// Slide to client

side[1].addEventListener('click', function(){
    formSlider.style.left = '50%'
    forms[0].style.left = '-100%'
    forms[1].style.left = '0'
    formContainer.style.height= '72rem'
})

let notification = document.querySelector('#notification')

if(notification)
{
    setTimeout(() => {
        notification.style.display = 'none'
    }, 5000)
}
