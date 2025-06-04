document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.message a');
  const forms = document.querySelectorAll('form');

  links.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      forms.forEach(form => {
        const style = window.getComputedStyle(form);
        const isHidden = style.display === 'none' || parseFloat(style.opacity) === 0;

        if (isHidden) {
          // Mostrar el formulario con animación de altura y opacidad
          form.style.display = 'block';
          form.style.opacity = '0';
          form.style.height = '0px';
          const fullHeight = form.scrollHeight + 'px';

          // Forzar cálculo de estilos antes de arrancar la transición
          requestAnimationFrame(() => {
            form.style.transition = 'height 600ms, opacity 600ms';
            form.style.height = fullHeight;
            form.style.opacity = '1';
          });

          // Al terminar la animación, limpia la altura inline
          form.addEventListener('transitionend', function handler(evt) {
            if (evt.propertyName === 'height') {
              form.style.height = '';
              form.removeEventListener('transitionend', handler);
            }
          });
        } else {
          // Ocultar el formulario con animación de altura y opacidad
          form.style.height = form.scrollHeight + 'px';
          form.style.opacity = '1';

          requestAnimationFrame(() => {
            form.style.transition = 'height 600ms, opacity 600ms';
            form.style.height = '0px';
            form.style.opacity = '0';
          });

          form.addEventListener('transitionend', function handler(evt) {
            if (evt.propertyName === 'height') {
              form.style.display = 'none';
              form.style.height = '';
              form.removeEventListener('transitionend', handler);
            }
          });
        }
      });
    });
  });
});
