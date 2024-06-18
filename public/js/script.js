// lottie-animation.js

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lottie animation
    const animationContainer = document.getElementById('lottie-animation');
    const animationData = {
        container: animationContainer,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'gif/lottie1.json' // Replace with the correct path to your JSON file
    };
    const animation = lottie.loadAnimation(animationData);

    // Resize animation to fill its container
    function resizeAnimation() {
        const lottieSection = document.getElementById('lottie-section');
        const sectionHeight = lottieSection.clientHeight;
        animationContainer.style.height = `${sectionHeight}px`;
    }

    // Call resizeAnimation initially and on window resize
    window.addEventListener('resize', resizeAnimation);
    resizeAnimation();
});
