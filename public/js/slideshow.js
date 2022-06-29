let images = document.querySelectorAll(".images-slideshow img")

let viewTime = 2500

let duration = 7500

const slideshow = () => {
    setTimeout(() => {
        images[0].style.left = '0'
        images[1].style.left = '100%'
        images[2].style.left = '200%'
    }, viewTime)

    setTimeout(() => {
        images[0].style.left = '100%'
        images[1].style.left = '0'
    }, viewTime*2)

    setTimeout(() => {
        images[1].style.left = '200%'
        images[2].style.left = '0'
    }, viewTime*3)
}

setInterval(slideshow, duration);

