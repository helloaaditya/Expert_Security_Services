// Scroll Animation Observer
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Initialize scroll animations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Observe all elements with animation classes
    const animatedElements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in');
    animatedElements.forEach(el => observer.observe(el));

    // Mobile Navigation
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navMenu = document.querySelector('nav > ul');
    const servicesItem = document.querySelector('.mega-menu-item');
    const servicesLink = servicesItem ? servicesItem.querySelector('a') : null;
    
    // Toggle mobile menu
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('show');
            mobileToggle.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('show') ? 'hidden' : '';
        });
    }

    // Toggle services submenu on mobile
    if (servicesLink && servicesItem) {
        servicesLink.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                servicesItem.classList.toggle('active');
            }
        });
    }
    
    // Close menu when clicking any link (except Services toggle)
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            const isServicesToggle = this.closest('.mega-menu-item') && this === servicesLink;
            if (!isServicesToggle && window.innerWidth <= 768) {
                navMenu.classList.remove('show');
                mobileToggle.classList.remove('active');
                document.body.style.overflow = '';
                if (servicesItem) servicesItem.classList.remove('active');
            }
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (navMenu && navMenu.classList.contains('show')) {
                        navMenu.classList.remove('show');
                        mobileToggle.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                }
            }
        });
    });
    
    // Header scroll effect
    let lastScroll = 0;
    const header = document.querySelector('header');
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
            header.style.background = 'rgba(13, 27, 42, 1)';
        } else {
            header.classList.remove('scrolled');
            header.style.background = 'rgba(13, 27, 42, 0.95)';
        }
        
        lastScroll = currentScroll;
    });
    
    // Form submission handling
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'form-success';
            successMessage.style.cssText = 'background: #4CAF50; color: white; padding: 1rem; border-radius: 8px; margin-top: 1rem; text-align: center;';
            successMessage.textContent = 'Thank you for your enquiry! We will contact you shortly.';
            
            contactForm.appendChild(successMessage);
            contactForm.reset();
            
            setTimeout(() => {
                successMessage.remove();
            }, 5000);
        });
    }
    
    // Counter animation for stats
    const statNumbers = document.querySelectorAll('.stat-number');
    const animateCounter = (element) => {
        const target = element.textContent.replace(/[^0-9]/g, '');
        const suffix = element.textContent.replace(/[0-9]/g, '');
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current) + suffix;
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + suffix;
            }
        };
        
        updateCounter();
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                animateCounter(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(stat => statsObserver.observe(stat));
});
