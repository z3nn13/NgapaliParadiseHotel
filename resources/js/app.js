$(function () {
    /*-------------------
        Background setter
    ---------------------*/

    $(".set-bg").each(function () {
        // Set background image using data attribute
        var bg = $(this).data("set-bg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    /*--------------------
        Customize Lightbox2
    ---------------------*/

    // Customize Lightbox2 options
    lightbox.option({
        resizeDuration: 0,
        wrapAround: true,
        fitImagesInViewport: true,
        disableScrolling: true,
    });

    /*-------------------
        Scroll Animations
    ---------------------*/

    // Get all animated divs
    const animatedDivs = document.querySelectorAll(".animated-div");

    // Intersection Observer options
    const observerOptions = {
        root: null,
        rootMargin: "0px",
    };

    // Create Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Add animate-in class when div is visible
                entry.target.classList.add("animate-in");
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe animated divs
    animatedDivs.forEach((div) => observer.observe(div));

    /*---------------------
        Create Custom Toast
    ---------------------*/

    // Function to create a custom toast
    const timerDuration = 3000;

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: timerDuration,
        timerProgressBar: true,
        hideClass: {
            popup: "animate__animated animate__fadeOutUp",
        },
        didOpen: (toast) => {
            let timerLeft;

            // Pause timer on mouse enter
            toast.addEventListener("mouseenter", () => {
                timerLeft = timerDuration - Swal.getTimerLeft();
                Swal.increaseTimer(timerLeft);
                Swal.stopTimer();
            });

            // Resume timer on mouse leave
            toast.addEventListener("mouseleave", () => {
                if (timerLeft !== undefined) {
                    Swal.resumeTimer();
                    timerLeft = undefined;
                }
            });
        },
    });

    window.Toast = Toast;
});
