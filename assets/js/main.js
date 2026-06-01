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

/* ========== HAIR TYPE CAROUSELS ========== */
(function () {
  const GAP     = 12;   // must match CSS gap on .car-track
  const DUR     = 520;  // transition ms
  const AUTO_MS = 3500; // autoplay interval ms

  function visCount() {
    if (window.innerWidth <= 480) return 2;
    if (window.innerWidth <= 768) return 3;
    return 5;
  }

  function initCarousel(el) {
    const track = el.querySelector('.car-track');
    const win   = el.querySelector('.car-window');
    const prevB = el.querySelector('.car-prev');
    const nextB = el.querySelector('.car-next');
    if (!track || !win) return;

    const real = Array.from(track.querySelectorAll('.car-slide'));
    const N    = real.length;
    const V    = visCount();
    if (!N) return;

    let pos  = V;
    let busy = false;
    let timer = null;

    // Prepend clones of last V slides (reversed so order stays correct)
    real.slice(-V).reverse().forEach(s => {
      const c = s.cloneNode(true);
      c.setAttribute('aria-hidden', 'true');
      track.prepend(c);
    });
    // Append clones of first V slides
    real.slice(0, V).forEach(s => {
      const c = s.cloneNode(true);
      c.setAttribute('aria-hidden', 'true');
      track.appendChild(c);
    });

    function slideStep() {
      const s = track.querySelector('.car-slide');
      return s ? s.offsetWidth + GAP : 200;
    }

    function layout() {
      const w  = win.offsetWidth;
      const sw = (w - GAP * (V - 1)) / V;
      track.querySelectorAll('.car-slide').forEach(s => { s.style.width = sw + 'px'; });
    }

    function setPos(p, animate) {
      pos = p;
      if (!animate) {
        track.style.transition = 'none';
        void track.offsetHeight; // flush transition before transform
      } else {
        track.style.transition = `transform ${DUR}ms cubic-bezier(0.25,0.46,0.45,0.94)`;
      }
      track.style.transform = `translateX(-${pos * slideStep()}px)`;
    }

    function move(dir) {
      if (busy) return;
      busy = true;
      const next = pos + dir;
      pos = next;
      track.style.transition = `transform ${DUR}ms cubic-bezier(0.25,0.46,0.45,0.94)`;
      track.style.transform  = `translateX(-${next * slideStep()}px)`;
      setTimeout(() => {
        if (next < V)          setPos(N + next,  false); // wrap forward
        else if (next >= N + V) setPos(next - N,  false); // wrap back
        busy = false;
      }, DUR + 40);
    }

    function autoStart() { timer = setInterval(() => move(1), AUTO_MS); }
    function autoStop()  { clearInterval(timer); }

    layout();
    setPos(V, false);

    prevB?.addEventListener('click', () => { autoStop(); move(-1); autoStart(); });
    nextB?.addEventListener('click', () => { autoStop(); move(1);  autoStart(); });
    el.addEventListener('mouseenter', autoStop);
    el.addEventListener('mouseleave', autoStart);

    autoStart();
  }

  document.querySelectorAll('[data-carousel]').forEach(initCarousel);
})();

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

/* ========== VIDEO SLIDES (play / pause on click) ========== */
document.addEventListener('click', function (e) {
  const slide = e.target.closest('.car-slide-video');
  if (!slide) return;
  const video = slide.querySelector('video');
  if (!video) return;
  if (video.paused) {
    video.play();
    slide.classList.add('playing');
  } else {
    video.pause();
    slide.classList.remove('playing');
  }
});

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
