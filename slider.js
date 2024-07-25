// slider.js
const slider = document.querySelector('.slider');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
let currentIndex = 0;
// Fetch product data from the database
fetch('fetch_products.php')
    .then(response => response.json())
    .then(data => {
        // Generate slider images from product data
        const sliderImages = data.map(product => `<img src="${product.image}" alt="${product.product_name}">`);
        slider.innerHTML = sliderImages.join('');

        // Show the first image
        slider.children[currentIndex].style.display = 'block';

        // Move to the next image
        function showNextImage() {
            currentIndex = (currentIndex + 1) % slider.children.length;
            updateSlider();
        }

        // Move to the previous image
        function showPrevImage() {
            currentIndex = (currentIndex - 1 + slider.children.length) % slider.children.length;
            updateSlider();
        }

        // Update the slider to display the current image
        function updateSlider() {
            for (let i = 0; i < slider.children.length; i++) {
                slider.children[i].style.display = 'none';
            }
            slider.children[currentIndex].style.display = 'block';
        }

        // Event listeners for navigation buttons
        prevBtn.addEventListener('click', showPrevImage);
        nextBtn.addEventListener('click', showNextImage);

        // Automatic image sliding
        let slideInterval = setInterval(showNextImage, 3000); // Change image every 3 seconds

        // Pause sliding when hovering over the slider
        slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
        slider.addEventListener('mouseleave', () => slideInterval = setInterval(showNextImage, 3000));
    })
    .catch(error => console.error('Error fetching product data:', error));