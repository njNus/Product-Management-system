// form_validation.js
const form = document.getElementById('product-form');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const productName = document.getElementById('product-name').value.trim();
    const category = document.getElementById('category').value.trim();
    const manufacturingDate = document.getElementById('manufacturing-date').value;
    const image = document.getElementById('image').files[0];

    if (!productName || !category || !manufacturingDate || !image) {
        alert('Please fill in all required fields.');
        return;
    }

    // If validation passes, submit the form
    this.submit();
});
