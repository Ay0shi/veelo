// script.js

document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.bike-card');

  // Fade-in animation on load
  cards.forEach((card, index) => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(40px)';
    setTimeout(() => {
      card.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
      card.style.opacity = 1;
      card.style.transform = 'translateY(0)';
    }, index * 150);
  });

  // Check unit availability and apply styles
  const unitDisplays = document.querySelectorAll('.unit-left');
  unitDisplays.forEach((el) => {
    const text = el.textContent.match(/\d+/);
    const unitCount = text ? parseInt(text[0]) : 0;
    if (unitCount === 0) {
      el.textContent = 'Tidak tersedia';
      el.closest('.bike-card').style.opacity = 0.5;
    } else if (unitCount <= 2) {
      el.style.color = 'red';
    }
  });

  // Create and inject modal
  const modal = document.createElement('div');
  modal.classList.add('modal');
  modal.id = 'infoModal';
  modal.innerHTML = `
    <div class="modal-content">
      <h3>Maklumat Basikal</h3>
      <p>Maklumat lanjut tentang penyewaan akan datang kemudian.</p>
      <button id="closeModal">Tutup</button>
    </div>
  `;
  document.body.appendChild(modal);

  const popupModal = document.getElementById('infoModal');
  const closeModal = document.getElementById('closeModal');

  // Add button listeners
  const buttons = document.querySelectorAll('.button-info');
  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      popupModal.style.display = 'flex';
      popupModal.style.animation = 'fadeIn 0.3s ease';
    });
  });

  // Close modal
  closeModal.addEventListener('click', () => {
    popupModal.style.display = 'none';
  });

  // Close modal on outside click
  popupModal.addEventListener('click', (e) => {
    if (e.target === popupModal) {
      popupModal.style.display = 'none';
    }
  });

  // Floating sparkles (just for fun & aesthetic)
  const sparkles = document.createElement('div');
  sparkles.style.position = 'fixed';
  sparkles.style.top = 0;
  sparkles.style.left = 0;
  sparkles.style.width = '100%';
  sparkles.style.height = '100%';
  sparkles.style.pointerEvents = 'none';
  sparkles.style.zIndex = 1;
  document.body.appendChild(sparkles);

  for (let i = 0; i < 20; i++) {
    const dot = document.createElement('div');
    dot.style.position = 'absolute';
    dot.style.width = '6px';
    dot.style.height = '6px';
    dot.style.borderRadius = '50%';
    dot.style.background = 'rgba(180, 200, 180, 0.6)';
    dot.style.left = Math.random() * window.innerWidth + 'px';
    dot.style.top = Math.random() * window.innerHeight + 'px';
    dot.style.animation = `floatY ${5 + Math.random() * 5}s ease-in-out infinite`;
    sparkles.appendChild(dot);
  }
});

// Keyframes via JS (optional fallback if not in CSS)
const styleSheet = document.createElement("style");
styleSheet.type = "text/css";
styleSheet.innerText = `
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

@keyframes floatY {
  0% { transform: translateY(0); opacity: 0.5; }
  50% { transform: translateY(-40px); opacity: 1; }
  100% { transform: translateY(0); opacity: 0.5; }
}`;
document.head.appendChild(styleSheet);

 function revealOnScroll() {
    const reveals = document.querySelectorAll('.scroll-reveal');

    reveals.forEach(el => {
      const windowHeight = window.innerHeight;
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 100;

      if (elementTop < windowHeight - elementVisible) {
        el.classList.add('visible');
      }
    });
  }

  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll);
