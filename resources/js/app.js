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

$(document).ready(function () {
    $(".select2").select2({
        placeholder: "Please select a room category",
        allowClear: true,
        dropdownCssClass: "category-select__select",
    });
});
