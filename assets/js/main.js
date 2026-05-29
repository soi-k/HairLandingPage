// Mobile menu toggle
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

if (hamburger && navMenu) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('open');
    document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
  });

  // Close menu when clicking a link
  navMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('active');
      navMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
}

// Navbar scroll effect
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  if (window.scrollY > 60) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
}, { passive: true });

// Scroll reveal animation
const revealElements = document.querySelectorAll('.reveal');

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, {
  threshold: 0.12,
  rootMargin: '0px 0px -40px 0px'
});

revealElements.forEach(el => revealObserver.observe(el));

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const offset = 80;
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  });
});

// Contact form handling
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const btn = this.querySelector('.form-submit');
    const originalText = btn.innerHTML;

    btn.innerHTML = 'Đang gửi...';
    btn.disabled = true;

    // Simulate form submission (replace with actual endpoint)
    setTimeout(() => {
      btn.innerHTML = '✓ Đã gửi thành công!';
      btn.style.background = '#22c55e';
      this.reset();

      setTimeout(() => {
        btn.innerHTML = originalText;
        btn.style.background = '';
        btn.disabled = false;
      }, 4000);
    }, 1500);
  });
}

// Counter animation for stats
const counters = document.querySelectorAll('.stat-number');
let animated = false;

const statsObserver = new IntersectionObserver((entries) => {
  if (entries[0].isIntersecting && !animated) {
    animated = true;
    counters.forEach(counter => {
      const target = counter.textContent;
      const numMatch = target.match(/\d+/);
      if (!numMatch) return;

      const num = parseInt(numMatch[0]);
      const suffix = target.replace(/[\d]/g, '');
      let start = 0;
      const duration = 1500;
      const step = num / (duration / 16);

      const timer = setInterval(() => {
        start = Math.min(start + step, num);
        counter.textContent = Math.floor(start) + suffix;
        if (start >= num) clearInterval(timer);
      }, 16);
    });
  }
}, { threshold: 0.5 });

const statsSection = document.querySelector('.stats');
if (statsSection) statsObserver.observe(statsSection);
