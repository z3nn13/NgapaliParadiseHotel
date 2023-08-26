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

    /*---------------------
        Sweet Alert
    ---------------------*/
    $(window).on("swal:notification", function (event) {
        const detail = event.detail;
        Toast.fire({
            text: detail.text,
            icon: detail.type,
        });
    });

    $(window).on("swal:modal", function (event) {
        const detail = event.detail;
        Swal.fire({
            title: detail.title,
            text: detail.text,
            icon: detail.type,
            html: detail.html,
        });
    });

    $(window).on("swal:cancel", function (event) {
        const detail = event.detail;
        Swal.fire({
            title: detail.title,
            text: detail.text,
            icon: detail.type,
        });
    });

    $(window).on("swal:confirm_cancel", function (event) {
        const detail = event.detail;
        Swal.fire({
            title: detail.title,
            text: detail.text,
            icon: detail.type,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#424242",
            confirmButtonText: "Yes, I would like to cancel.",
        }).then(function (result) {
            if (result.isConfirmed) {
                Livewire.emit(`cancelBooking`);
            }
        });
    });

    $(window).on("swal:confirm_delete", function (event) {
        const detail = event.detail;
        Swal.fire({
            title: detail.title,
            text: detail.text,
            icon: detail.type,
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#424242",
            confirmButtonText: "Yes, delete it!",
            reverseButtons: true,
        }).then(function (result) {
            if (result.isConfirmed) {
                Livewire.emit(`delete${event.detail.modelName}s`, detail.ids);
            }
        });
    });
});
