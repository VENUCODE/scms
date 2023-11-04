$(document).ready(() => {
  $("#login-submit").on("click", (e) => {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();
    var usermode = $("#usermode").html();
    if ($("#email")[0].checkValidity()) {
      $.ajax({
        url: "api/login_auth.php",
        type: "POST",
        data: {
          email: email,
          password: password,
          usermode: usermode,
        },
        beforeSend: function () {
          console.log("request sending");
        },
        complete: function () {
          console.log("request sent");
        },
        success: function (response) {
          var responseData = JSON.parse(response);
          if (responseData.redirect) {
            window.location.href = responseData.redirect;
          } else if (responseData.error) {
            alert(responseData.error);
          }
        },
        error: function (message) {
          console.log("Login failed: " + message); // Handle the error response
        },
      });
    }
  });

  $("#login-icons > div").click(function () {
    $("#login-icons > div").css({ color: "#4561edff" });
    $("#login-icons > div>img").css({ transform: "scale(0.8)", boxShadow: "" });
    $("#email").val("");
    $("#password").val("");
    $(this).find("img").css({
      transform: "scale(1.1)",
      boxShadow: "inset 0px 0px 30px white,inset -2px -2px 10px var(--bg-5)",
      transition: "transform 1s ease",
    });
    $(this).css({
      color: "#0f2595ff",
    });
    var img = $(this).find("img").attr("alt");
    const usermode = $("#usermode");

    switch (img) {
      case "W":
        usermode.html("WARDEN");
        break;
      case "S":
        usermode.html("STUDENT");
        break;
      case "WF":
        usermode.html("STUDENT WELFARE");
        break;
      default:
        usermode.html("select");
        break;
    }
  });
});
