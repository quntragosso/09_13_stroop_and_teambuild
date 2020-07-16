$(function () {

    $(document).ready(function () {
        $("#first_div").css("display", "flex");
    });

    $("#register_btn").on("touchend", function () {
        $(".divs").css("display", "none");
        $("#register_div").css("display", "flex");
    });

    $("#login_btn").on("touchend", function () {
        $(".divs").css("display", "none");
        $("#login_div").css("display", "flex");
    });

    $("#how_btn").on("touchend", function () {
        $(".divs").css("display", "none");
        $("#how_div").css("display", "flex");
        $("#close_btn").css("display", "flex");
    });

    $("#close_btn").on("touchend", function () {
        $(".divs").css("display", "none");
        $("#first_div").css("display", "flex");
        $("#close_btn").css("display", "none");
    });
});