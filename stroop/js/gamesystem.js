$(function () {
    const charArray = ["赤", "青", "緑", "黄"];
    const classArray1 = ["red1", "blue1", "green1", "yellow1"];
    const classArray2 = ["red2", "blue2", "green2", "yellow2"];
    let getPoint = 0;
    let answerPoint = 0;

    function resetClass() {
        $("#display").removeClass("red1");
        $("#display").removeClass("blue1");
        $("#display").removeClass("green1");
        $("#display").removeClass("yellow1");
        $("#display").removeClass("red2");
        $("#display").removeClass("blue2");
        $("#display").removeClass("green2");
        $("#display").removeClass("yellow2");
    }

    function charSet() {
        resetClass();
        const rn1 = Math.floor(Math.random() * 4);
        const rn2 = Math.floor(Math.random() * 4);
        $("#display").text(charArray[rn1]);
        $("#display").addClass(classArray1[rn1]);
        $("#display").addClass(classArray2[rn2]);
    }

    function timer() {
        const timeup = 40;
        nowTime = 0;
        setInterval(() => {
            nowTime++;
            if (nowTime == timeup) {
                clearInterval(timer);
                $(".color_btns").css("display", "none");
                $("#display").css("font-size", "24px");
                $("#display").text(getPoint + "/" + answerPoint + "問正解しました。");
                $("#return_btn").css("display", "flex");
            }
        }, 1000);
    }

    $(document).ready(function () {
        setTimeout(function () {
            $("#display").text("3");
        }, 1000);
        setTimeout(function () {
            $("#display").text("2");
        }, 2000);
        setTimeout(function () {
            $("#display").text("1");
        }, 3000);
        setTimeout(function () {
            $(".color_btns").css("display", "block");
            charSet();
            timer();
        }, 4000);
    });

    $(".color_btns").on("touchend", function () {
        const selected = $(this).attr("class");
        selectedClassArray = selected.split(" ");
        const charClass = $("#display").attr("class");
        charClassArray = charClass.split(" ");
        if (selectedClassArray[which] == charClassArray[which - 1]) {
            getPoint++;
            answerPoint++;
            console.log(getPoint, answerPoint);
            charSet();
        } else {
            answerPoint++;
            console.log(getPoint, answerPoint);
            charSet();
        }
    });

    $("#return_btn").on("touchend", function () {
        $.ajax({
            type: "POST",
            url: "data_create.php",
            data: {
                "get_point": getPoint,
                "answer_point": answerPoint,
            }
        }).done(function (result) {
            window.location.href = "home.php";
        }).fail(function () {
            // 通信失敗時の処理を記述
            console.log("error")
        });

    });


});