$(function () {

    function reset() {
        $("#star1_label").text("☆");
        $("#star2_label").text("☆");
        $("#star3_label").text("☆");
        $("#star4_label").text("☆");
        $("#star5_label").text("☆");
    }

    $("#star1_div").on("click", function () {
        reset();
        $("#star1_label").text("★");
    });

    $("#star2_div").on("click", function () {
        reset();
        $("#star1_label").text("★");
        $("#star2_label").text("★");
    });

    $("#star3_div").on("click", function () {
        reset();
        $("#star1_label").text("★");
        $("#star2_label").text("★");
        $("#star3_label").text("★");
    });

    $("#star4_div").on("click", function () {
        reset();
        $("#star1_label").text("★");
        $("#star2_label").text("★");
        $("#star3_label").text("★");
        $("#star4_label").text("★");
    });

    $("#star5_div").on("click", function () {
        reset();
        $("#star1_label").text("★");
        $("#star2_label").text("★");
        $("#star3_label").text("★");
        $("#star4_label").text("★");
        $("#star5_label").text("★");
    });

});