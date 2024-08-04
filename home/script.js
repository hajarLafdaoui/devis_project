document.addEventListener('DOMContentLoaded', function() {
    // Animer la Navbar
    gsap.to('.navbar', {
      y: 0,
      opacity: 1,
      duration: 1,
      ease: 'power2.out'
    });
  
    // Animer le Contenu
    gsap.to('.content', {
      x: 0,
      opacity: 1,
      duration: 1,
      delay: 0.5,
      ease: 'power2.out'
    });
  
    // Animer l'Image
    gsap.to('.img', {
      x: 0,
      opacity: 1,
      duration: 1,
      delay: 1,
      ease: 'power2.out'
    });
  });
  