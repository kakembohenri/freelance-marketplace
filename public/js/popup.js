let complete = document.querySelectorAll('#complete')

let backdrop = document.querySelector('.backdrop')

let popup = document.querySelector('.popup')


// console.log(complete)

Array.from(complete).forEach(item => {
    item.addEventListener('click', function(){
        backdrop.style.top = '0'
        popup.style.top = '-30%'
    })
})

backdrop.addEventListener('click', function(){
    backdrop.style.top = '-500%'
    popup.style.top = '-500%'
})

// Mobile money

let airtel = document.querySelector('input[value="airtel"]')

let mtn = document.querySelector('input[value="mtn"]')

let fund_btn = document.querySelectorAll('#fund')

Array.from(fund_btn).forEach(item => {
    item.addEventListener('click', function(){
        backdrop.style.top = '0'
        popup.style.top = '-50%'
    })
    })
