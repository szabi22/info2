document.querySelectorAll('.toggle-comment-form').forEach(button => {
    button.addEventListener('click', () => {
        const form = button.nextElementSibling;
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
});
