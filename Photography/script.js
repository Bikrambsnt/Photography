function flipCard() {
  const formContainer = document.getElementById('formContainer');
  formContainer.style.transform = formContainer.style.transform === 'rotateY(180deg)' ? 'rotateY(0deg)' : 'rotateY(180deg)';
}
function openModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.style.display = 'flex';  
  setTimeout(() => {
    overlay.style.opacity = '1';  
  }, 10);
}

function closeModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.style.opacity = '0'; 
  setTimeout(() => {
    overlay.style.display = 'none'; 
    overlay.style.opacity = '';  
  }, 300);
}

document.getElementById('uploadBtn').addEventListener('click', openModal);
