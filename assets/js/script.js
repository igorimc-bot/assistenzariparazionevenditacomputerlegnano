// Basic form validation or interaction
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const phone = form.querySelector('input[name="phone"]');
            if (phone && phone.value.length < 5) {
                e.preventDefault();
                alert('Inserisci un numero di telefono valido.');
            }
        });
    });
});
