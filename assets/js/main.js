$(document).ready(function () {
  // Módulo adicional para aceitar apenas letras
  $.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Letters only please");

  // Form validation
  $("#contact-us").validate({
    rules: {
      nome: {
        required: true,
        rangelength: [3, 15],
        lettersonly: true
      },
      sobrenome: {
        required: true,
        lettersonly: true,
        rangelength: [3, 25]
      },
      email: {
        required: true,
        email: true
      },
      description: {
        rangelength: [15, 60]
      }
    }
  });

  $("#register").validate({
    rules: {
      usuario: {
        required: true,
        rangelength: [3, 15],
        lettersonly: true
      },
      senha: {
        required: true,
        rangelength: [4, 8]
      }
    }
  });

  // Background slider
  $("#bg-slider").vegas({
    slides: [{
        src: "assets/img/intro-bg.jpg"
      },
      {
        src: "assets/img/intro-bg2.jpg"
      },
      {
        src: "assets/img/intro-bg3.jpg"
      },
      {
        src: "assets/img/intro-bg4.jpg"
      }
    ],
    delay: 7000,
    timer: false,
    cover: true,
    transition: 'slideLeft2',
    slide: 2
  });

  // Scroll suave
  function initScrollSuave() {
    const linksInternos = document.querySelectorAll('.to-scroll a[href^="#"]');

    function scrollToSection(event) {
      event.preventDefault();
      const href = event.currentTarget.getAttribute('href');
      const section = document.querySelector(href);
      section.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
      });
    }
    linksInternos.forEach((link) => {
      link.addEventListener('click', scrollToSection);
    });
  }
  initScrollSuave();
});