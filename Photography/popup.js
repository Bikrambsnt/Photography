function openModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.style.display = 'flex';  // Directly set display to flex
  setTimeout(() => {
    overlay.style.opacity = '1';  // Smoothly transition opacity
  }, 10);
}

function closeModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.style.opacity = '0';  // Smoothly transition opacity
  setTimeout(() => {
    overlay.style.display = 'none';  // Set display to none after transition
  }, 300);
}

document.getElementById('uploadBtn').addEventListener('click', openModal);
