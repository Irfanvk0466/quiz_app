document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        setTimeout(function() {
            successMessage.classList.remove('show');
            successMessage.classList.add('fade');
        }, 5000);
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('errorMessage');
    if (successMessage) {
        setTimeout(function() {
            successMessage.classList.remove('show');
            successMessage.classList.add('fade');
        }, 5000);
    }
});
