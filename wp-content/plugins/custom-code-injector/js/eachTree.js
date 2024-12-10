const readMoreBtn = document.querySelector('.readMoreBtn')
let readMore = false
let readMoreText = document.querySelector('.identification-paragraph')
const chevronIcon = document.querySelector('.chevron-icon')

readMoreBtn.addEventListener('click', () => {
    if (readMore === false) {
        readMoreText.classList.remove('truncate');
        readMore = true;
        readMoreBtn.childNodes[0].textContent = 'Read Less ';
        chevronIcon.style.transform = 'rotate(180deg)'
    } else {
        readMoreText.classList.add('truncate');
        readMore = false;
        readMoreBtn.childNodes[0].textContent = 'Read More ';
        chevronIcon.style.transform = 'rotate(0deg)'
    }
})

const resourcesBtn = document.querySelector('.custom-maker1')
const referencesBtn = document.querySelector('.custom-maker2')

resourcesBtn.addEventListener('click', () => {
    resourcesBtn.classList.toggle('active')
})

referencesBtn.addEventListener('click', () => {
    referencesBtn.classList.toggle('active')
})