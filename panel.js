const header = document.querySelector(".header")
const main = document.querySelector(".main")
const openerIcon = document.querySelector("#js-opener")
const icon = document.querySelector("#js-icon")
const closer = document.querySelector(".closer")

const leftArrow = "fa-arrow-left"
const rightArrow = "fa-arrow-right"

// Listener on header ::after element
openerIcon.addEventListener("click", () => {
    
    if(header.classList.contains("open")) {
        header.classList.add("close")

        openerIcon.classList.add("opener")
        openerIcon.classList.remove("closer")

        main.classList.add("fullWidth")
        main.classList.remove("reducedWidth")

        header.classList.remove("open")
    } else {
        header.classList.add("open")

        openerIcon.classList.add("closer")
        openerIcon.classList.remove("opener")

        main.classList.remove("fullWidth")
        main.classList.add("reducedWidth")
        
        header.classList.remove("close")
    }
    
    if(openerIcon.classList.contains("closer")) {
        icon.classList.remove(rightArrow)
        icon.classList.add(leftArrow)
    } else {
        icon.classList.remove(leftArrow)
        icon.classList.add(rightArrow)
    }
})
