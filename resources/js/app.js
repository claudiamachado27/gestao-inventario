import './bootstrap'; // Importação padrão do Laravel (Axios)
import 'bootstrap';    // JavaScript do Bootstrap


// window.validatePassword = function () {
//     const password = document.getElementById('password').value;
//     const confirm = document.getElementById('confirm_password').value;
//     const submitBtn = document.getElementById('submit-btn');

//     const lengthReq = password.length >= 8;
//     const numberReq = /\d/.test(password);
//     const specialReq = /[!@#$%^&*(),.?":{}|<>]/.test(password);

//     updateReq('req-length', lengthReq);
//     updateReq('req-number', numberReq);
//     updateReq('req-special', specialReq);

//     let strength = 0;
//     if (lengthReq) strength++;
//     if (numberReq) strength++;
//     if (specialReq) strength++;

//     const bar = document.getElementById('strength-bar');
//     const txt = document.getElementById('strength-text');

//     if (password.length === 0) {
//         bar.style.width = '0%';
//         txt.textContent = '';
//     } else {
//         const colors = ['#ef4444', '#f59e0b', '#13ec5b'];
//         const texts = ['Fraca', 'Média', 'Forte'];
//         bar.style.width = (strength * 33.3) + '%';
//         bar.style.backgroundColor = colors[strength - 1];
//         txt.textContent = texts[strength - 1];
//         txt.style.color = colors[strength - 1];
//     }

//     const matchMsg = document.getElementById('match-msg');
//     const confirmInput = document.getElementById('confirm_password');

//     if (confirm.length > 0) {
//         if (password === confirm) {
//             matchMsg.innerHTML = '<i class="bi bi-check-circle"></i> Coincidem';
//             matchMsg.className = 'small text-success mt-1';
//             confirmInput.style.borderColor = '#13ec5b';
//         } else {
//             matchMsg.innerHTML = '<i class="bi bi-x-circle"></i> A senha não coincide';
//             matchMsg.className = 'small text-danger mt-1';
//             confirmInput.style.borderColor = '#ef4444';
//         }
//     } else {
//         matchMsg.textContent = '';
//         confirmInput.style.borderColor = '';
//     }

//     const isValid = strength === 3 && password === confirm;
//     submitBtn.disabled = !isValid;
//     submitBtn.classList.toggle('opacity-50', !isValid);
// }

// function updateReq(id, isValid) {
//     const el = document.getElementById(id);
//     const icon = el.querySelector('i');
//     if (isValid) {
//         el.classList.replace('text-muted-custom', 'text-primary');
//         icon.classList.replace('bi-circle', 'bi-check-circle-fill');
//     } else {
//         el.classList.add('text-muted-custom');
//         el.classList.remove('text-primary');
//         icon.classList.replace('bi-check-circle-fill', 'bi-circle');
//     }
// }
