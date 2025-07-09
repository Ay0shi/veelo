document.addEventListener('DOMContentLoaded', function () {
  const sparkles = document.createElement('div');
  sparkles.style.position = 'fixed';
  sparkles.style.top = 0;
  sparkles.style.left = 0;
  sparkles.style.width = '100%';
  sparkles.style.height = '100%';
  sparkles.style.pointerEvents = 'none';
  sparkles.style.zIndex = 0;
  document.body.appendChild(sparkles);

  for (let i = 0; i < 30; i++) {
    const dot = document.createElement('div');
    dot.style.position = 'absolute';
    dot.style.width = '10px';
    dot.style.height = '10px';
    dot.style.borderRadius = '50%';
    dot.style.background = 'rgba(190, 220, 190, 0.7)';
    dot.style.left = Math.random() * window.innerWidth + 'px';
    dot.style.top = Math.random() * window.innerHeight + 'px';
    dot.style.animation = `floatY ${4 + Math.random() * 3}s ease-in-out infinite, sparkleMove ${3 + Math.random() * 2}s linear infinite alternate`;
    sparkles.appendChild(dot);
  }
});
