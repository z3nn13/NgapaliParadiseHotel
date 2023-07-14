// $(document).ready(function () {
//     $("#sortSelect").on("change", function () {
//         var selectedOption = $(this).val();
//         var roomTypes = $(this).data("room-types");

//         // Send AJAX request to the API endpoint
//         $.ajax({
//             url: "/room-types/sort",
//             method: "GET",
//             data: {
//                 sort_by: selectedOption,
//                 room_types: roomTypes,
//             },
//             success: function (response) {
//                 // Handle the sorted room types data
//                 // Update the UI with the sorted data
//                 console.log(response);
//             },
//             error: function (xhr, status, error) {
//                 // Handle the error if the request fails
//                 console.log(xhr);
//                 console.log(status);
//                 console.log(error);
//             },
//         });
//     });
// });
