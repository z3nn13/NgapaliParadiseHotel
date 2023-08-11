$(function () {
    /*-------------------
        Background setter
    ---------------------*/

    $(".set-bg").each(function () {
        var bg = $(this).data("set-bg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    /*-------------------
        Customize Select2
    ---------------------*/

    $(".select2").select2({
        placeholder: "Please select a room category",
        allowClear: true,
        dropdownCssClass: "category-select__select",
    });

    /*--------------------
        Customize Lightbox2
    ---------------------*/
    lightbox.option({
        resizeDuration: 0,
        wrapAround: true,
        fitImagesInViewport: true,
        disableScrolling: true,
    });

    /*-------------------
        Scroll Adnimations
    ---------------------*/

    const animatedDivs = document.querySelectorAll(".animated-div");

    const observerOptions = {
        root: null,
        rootMargin: "0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-in");
                observer.unobserve;
                // } else if (entry.boundingClientRect.y > entry.rootBounds.y) {
                // entry.target.classList.remove("animate-in");
            }
        });
    }, observerOptions);

    animatedDivs.forEach((div) => observer.observe(div));
});
