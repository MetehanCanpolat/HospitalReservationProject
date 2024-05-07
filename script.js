
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector(".btnLogin-popup");
const btnClose = document.querySelector(".btnClose-popup");
const iconClose = document.querySelector(".icon-close");

/*
function showPopup() {
    document.getElementById("popup").style.display = "block";
}
*/

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});
btnClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
});


iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});

document.querySelectorAll('.container img').forEach(image => {
    image.onclick = () =>{
        document.querySelector('.popup-image').style.display = 'block';
        document.querySelector('.popup-image img').src = image.getAttribute('src')
    }
});

document.querySelector('.popup-image span').onclick =  () => {
    document.querySelector('.popup-image').style.display = 'none';
}
