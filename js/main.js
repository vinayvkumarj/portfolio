document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.getElementById('contact-form');
  const formFeedback = document.getElementById('form-feedback');
  const submitBtn = contactForm ? contactForm.querySelector('.btn-submit') : null;

  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      // Reset feedback status
      if (formFeedback) {
        formFeedback.style.display = 'none';
        formFeedback.className = 'form-feedback';
        formFeedback.textContent = '';
      }

      const formData = new FormData(contactForm);

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
      }

      try {
        const response = await fetch('php/contact-handler.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (formFeedback) {
          formFeedback.textContent = result.message || result.error;
          formFeedback.className = `form-feedback ${result.success ? 'success' : 'error'}`;
          formFeedback.style.display = 'block';
        }

        if (result.success) {
          contactForm.reset();
        }
      } catch (err) {
        if (formFeedback) {
          formFeedback.textContent = 'Network error. Please try again later.';
          formFeedback.className = 'form-feedback error';
          formFeedback.style.display = 'block';
        }
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Send Message';
        }
      }
    });
  }
});