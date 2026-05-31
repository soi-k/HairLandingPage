/* ========== NAVBAR SCROLL ========== */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
}, { passive: true });

/* ========== MOBILE MENU ========== */
const hamburger = document.getElementById('hamburger');
const navMenu   = document.getElementById('navMenu');

if (hamburger && navMenu) {
  hamburger.addEventListener('click', () => {
    const open = navMenu.classList.toggle('open');
    hamburger.classList.toggle('active', open);
    document.body.style.overflow = open ? 'hidden' : '';
  });

  navMenu.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      navMenu.classList.remove('open');
      hamburger.classList.remove('active');
      document.body.style.overflow = '';
    });
  });
}

/* ========== HAIR TYPE SLIDERS ========== */
document.querySelectorAll('.hair-box').forEach(box => {
  const slider = box.querySelector('[data-slider]');
  const prev   = box.querySelector('.slider-prev');
  const next   = box.querySelector('.slider-next');
  if (!slider || !prev || !next) return;

  const getScrollAmount = () => (slider.querySelector('.hair-slide')?.offsetWidth ?? 200) + 12;

  prev.addEventListener('click', () => slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' }));
  next.addEventListener('click', () => slider.scrollBy({ left:  getScrollAmount(), behavior: 'smooth' }));
});

/* ========== PRICE CALCULATOR ========== */
const basePrices = {
  wietnam: 42,
  indie:   36,
  chiny:   28,
  iran:    38,
  turcja:  44,
  birma:   34,
};

const lengthMult = {
  20: 1.00,
  30: 1.20,
  40: 1.42,
  50: 1.68,
  60: 2.00,
  70: 2.40,
};

function calculatePrice() {
  const hairType = document.getElementById('calc-type')?.value;
  const length   = document.getElementById('calc-length')?.value;
  const weight   = parseFloat(document.getElementById('calc-weight')?.value || 0);
  const result   = document.getElementById('calc-result');

  if (!hairType || !length || !weight || weight <= 0) {
    if (result) result.classList.remove('show');
    return;
  }

  const base = basePrices[hairType] || 35;
  const mult = lengthMult[length]  || 1.0;
  const loss = 0.15; // 15% processing loss
  const pricePerKg   = base * mult;
  const totalNet     = pricePerKg * weight;
  const totalGross   = totalNet * 1.23; // VAT 23%

  if (result) {
    document.getElementById('calc-price-net').textContent =
      totalNet.toFixed(2).replace('.', ',') + ' PLN';
    document.getElementById('calc-price-gross').textContent =
      '≈ ' + totalGross.toFixed(2).replace('.', ',') + ' PLN brutto';
    document.getElementById('calc-loss').textContent =
      'Uwaga: szacunkowy ubytek przy farbowaniu ~15% (ok. ' +
      (weight * loss).toFixed(2).replace('.', ',') + ' kg)';
    result.classList.add('show');
  }
}

document.getElementById('calc-type')  ?.addEventListener('change', calculatePrice);
document.getElementById('calc-length') ?.addEventListener('change', calculatePrice);
document.getElementById('calc-weight') ?.addEventListener('input',  calculatePrice);

document.getElementById('calc-btn')?.addEventListener('click', (e) => {
  e.preventDefault();
  calculatePrice();
});

/* ========== CONTACT FORM ========== */
const form = document.getElementById('contactForm');
if (form) {
  form.addEventListener('submit', e => {
    e.preventDefault();
    const btn  = form.querySelector('.form-submit');
    const orig = btn.textContent;
    btn.textContent = 'Wysyłanie...';
    btn.disabled = true;

    setTimeout(() => {
      btn.textContent = '✓ Wiadomość wysłana!';
      btn.style.background = '#22c55e';
      form.reset();
      setTimeout(() => {
        btn.textContent = orig;
        btn.style.background = '';
        btn.disabled = false;
      }, 4000);
    }, 1400);
  });
}

/* ========== SCROLL REVEAL ========== */
const revealEls = document.querySelectorAll('.reveal');
const observer  = new IntersectionObserver(entries => {
  entries.forEach(el => {
    if (el.isIntersecting) {
      el.target.classList.add('visible');
      observer.unobserve(el.target);
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

revealEls.forEach(el => observer.observe(el));

/* ========== COUNTER ANIMATION (stats bar) ========== */
let counted = false;
const statsBar = document.querySelector('.stats-bar');
if (statsBar) {
  new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting && !counted) {
      counted = true;
      document.querySelectorAll('.stat-bar-num').forEach(el => {
        const full = el.textContent;
        const num  = parseFloat(full);
        if (isNaN(num)) return;
        const suffix = full.replace(/[\d.,]/g, '');
        let cur = 0;
        const step = num / 60;
        const id = setInterval(() => {
          cur = Math.min(cur + step, num);
          el.textContent = (Number.isInteger(num) ? Math.floor(cur) : cur.toFixed(1)) + suffix;
          if (cur >= num) clearInterval(id);
        }, 20);
      });
    }
  }, { threshold: 0.5 }).observe(statsBar);
}
