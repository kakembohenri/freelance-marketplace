let navbar = document.querySelector('nav')
let items = document.querySelector('.items-center').children


let scroll = window.addEventListener("scroll", function(){
navbar.style.background = 'white'
items[1].style.background = 'white'
items[1].style.borderBottomLeftRadius = '0.5rem'
items[1].style.borderBottomRightRadius = '0.5rem'
})

// Rating

let starsOuter = document.querySelectorAll('.stars-outer')
let starsTotal = 5

if(starsOuter)
{
    if(starsOuter.length > 0)
    {
        Array.from(starsOuter).forEach(starOuter => {
            // Get percentage
            const starPercentage = (starOuter.children[1].innerHTML / starsTotal) * 100
            
            // Round to nearest 5
            const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`

            
            // Set width of stars-inner to percentage
            starOuter.firstElementChild.style.width = starPercentageRounded
            
        })
    }

    if(starsOuter.length == 1)
    {
        // Get percentage
        const starPercentage = (starsOuter.children[1].innerHTML / starsTotal) * 100
            
        // Round to nearest 5
        const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`
        
        // Set width of stars-inner to percentage
        starsOuter.firstElementChild.style.width = starPercentageRounded
    }
}

let notification = document.querySelector('#notification')

if(notification)
{
    setTimeout(() => {
        notification.style.display = 'none'
    }, 5000)
}
