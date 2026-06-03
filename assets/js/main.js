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

/* ========== LIGHTBOX ========== */
const lb = document.createElement('div');
lb.id = 'car-lightbox';
lb.innerHTML = `
  <div class="lb-backdrop"></div>
  <button class="lb-close" aria-label="Zamknij">&#10005;</button>
  <div class="lb-content"></div>
`;
document.body.appendChild(lb);

let isLbOpen = false;
const carouselStopFns  = [];
const carouselStartFns = [];

function lbShow(html) {
  lb.querySelector('.lb-content').innerHTML = html;
  lb.classList.add('active');
  document.body.style.overflow = 'hidden';
  isLbOpen = true;
  carouselStopFns.forEach(fn => fn());
  const vid = lb.querySelector('video');
  if (vid) { vid.muted = false; vid.play(); }
}

function lbClose() {
  const vid = lb.querySelector('video');
  if (vid) vid.pause();
  lb.classList.remove('active');
  lb.querySelector('.lb-content').innerHTML = '';
  document.body.style.overflow = '';
  isLbOpen = false;
  carouselStartFns.forEach(fn => fn());
}

lb.querySelector('.lb-backdrop').addEventListener('click', lbClose);
lb.querySelector('.lb-close').addEventListener('click', lbClose);
document.addEventListener('keydown', e => { if (e.key === 'Escape' && isLbOpen) lbClose(); });

/* ========== HAIR TYPE CAROUSELS ========== */
(function () {
  const GAP     = 12;    // must match CSS gap on .car-track
  const DUR     = 520;   // transition ms
  const AUTO_MS = 10000; // autoplay interval ms

  function visCount() {
    if (window.innerWidth <= 480) return 1;
    if (window.innerWidth <= 768) return 2;
    return 5;
  }

  function playVisibleVideos(track, pos, V) {
    track.querySelectorAll('.car-slide').forEach((s, i) => {
      const vid = s.querySelector('video');
      if (!vid) return;
      const inView = i >= pos && i < pos + V;
      if (inView && vid.paused) vid.play().catch(() => {});
      if (!inView && !vid.paused) vid.pause();
    });
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

    let pos   = V;
    let busy  = false;
    let timer = null;

    // Prepend clones of last V slides
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
        void track.offsetHeight;
      } else {
        track.style.transition = `transform ${DUR}ms cubic-bezier(0.25,0.46,0.45,0.94)`;
      }
      track.style.transform = `translateX(-${pos * slideStep()}px)`;
      playVisibleVideos(track, pos, V);
    }

    function move(dir) {
      if (busy) return;
      busy = true;
      const next = pos + dir;
      pos = next;
      track.style.transition = `transform ${DUR}ms cubic-bezier(0.25,0.46,0.45,0.94)`;
      track.style.transform  = `translateX(-${next * slideStep()}px)`;
      setTimeout(() => {
        if (next < V)           setPos(N + next, false);
        else if (next >= N + V) setPos(next - N, false);
        busy = false;
      }, DUR + 40);
    }

    function autoStop()  { clearInterval(timer); timer = null; }
    function autoStart() { autoStop(); timer = setInterval(() => move(1), AUTO_MS); }

    layout();
    setPos(V, false);

    carouselStopFns.push(autoStop);
    carouselStartFns.push(autoStart);

    prevB?.addEventListener('click', () => { autoStop(); move(-1); autoStart(); });
    nextB?.addEventListener('click', () => { autoStop(); move(1);  autoStart(); });
    el.addEventListener('mouseenter', autoStop);
    el.addEventListener('mouseleave', () => { if (!isLbOpen) autoStart(); });

    autoStart();
  }

  document.querySelectorAll('[data-carousel]').forEach(initCarousel);
})();

/* ========== CAROUSEL CLICK → LIGHTBOX ========== */
document.addEventListener('click', function (e) {
  const slide = e.target.closest('.car-slide');
  if (!slide || slide.getAttribute('aria-hidden')) return;

  const videoUrl = slide.dataset.video;
  const fullUrl  = slide.dataset.full;

  if (videoUrl) {
    lbShow(`<video src="${videoUrl}" controls autoplay playsinline style="max-width:100%;max-height:85vh;border-radius:8px;"></video>`);
  } else if (fullUrl) {
    lbShow(`<img src="${fullUrl}" alt="" style="max-width:100%;max-height:85vh;border-radius:8px;object-fit:contain;">`);
  }
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
