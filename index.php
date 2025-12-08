<?php include("header.php") ?>

<body>
    <div class="container-fluid px-5 m-0 d-flex align-items-center" id="main">
        <video autoplay muted loop id="background-video" style="position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%; z-index: -1; object-fit: cover;">
            <source src="assets/edu_video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- left column -->
        <div class="col-lg-6">
            <div class="d-flex flex-column gap-3 p-5 text-white justify-content-center h-100 text-center">
                <h1 class="fw-bold">Welcome to Do-Estdot CBT Portal</h1>
                <p class="fs-6">Please login with your credentials to access your account and take your computer-based tests seamlessly.</p>
                <p class="fs-6">Any Issue? Contact the <a href="tel: +2348078097874" class="text-white fst-italic">ICT Administrator</a><i class='fas fa-laptop'></i>.</p>

                <div class="d-flex align-items-center bg-yellow-50  p-2 border-start border-5 border-warning border-bottom-0 border-top-0 border-end-0 text-yellow-600 text-start"><b class="pe-5">Note:</b>
                    <marquee class="text-yellow-600" behaviour="alternate" direction="">Malpractice is a crime. Defaulters are criminals.</marquee>
                </div>

            </div>
        </div>

        <!-- right column -->
        <div class="col-lg-6 d-flex align-items-center justify-content-end">
            <form id="auth_form" action="backend/auth.php" method="post" autocomplete="off" class="shadow-lg rounded-3 px-0 bg-white" style="max-width: 400px;">
                <div>
                    <div class="d-flex flex-column gap-1 p-2 text-gray-50 text-center rounded-top-3 align-items-center justify-content-start bg-green-700">
                        <img src="./assets/image/dd-logo.png" style="width:15%" alt="DED" />
                        <h4 class="fw-bold">CBT Portal Login</h4>
                    </div>

                    <div class="container">
                        <div class="row py-2 mt-3 px-3">
                            <div class="form-group mb-3">
                                <!-- <label for="username" class="form-label fw-medium">Username</label> -->
                                <input class="form-control" type="text" name="username" id="username" placeholder="Username" />
                                <p class="m-0 text-xs" id="user_id_auth_error"></p>
                            </div>

                            <div class="form-group mb-3">
                                <!-- <label for="password" class="form-label fw-medium">Password</label> -->
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                                <p class="m-0 text-xs" id="password_auth_error"></p>

                            </div>
                            <div class="form-group mt-2 mb-4 text-center">
                                <button id="login" type="submit" class="btn btn-success w-100 fw-bold p-2" name="login" value="login">Log In </button>
                                <p class="mt-2 text-xs" id="user_not_found_auth_error"></p>
                            </div>
                            <hr class="m-0">
                            <p class="text-dark fw-light text-center m-0">
                                Developed by <span class="fw-bolder text-success">Do-Estdot ICT</span> Team
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <script src="assets/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $("#auth_form").on("submit", function(e) {
                e.preventDefault();
                let username = $("#username").val();
                var password = $("#password").val();
                var login = $("#login").val();
                let data = {
                    "username": username,
                    "password": password,
                    "login": login
                };
                $.ajax({
                    url: "backend/auth.php",
                    method: "post",
                    data: data,
                    success: function(res) {
                        if (res == "admin") {
                            window.location.href = "admin";
                        } else if (res == "student") {
                            window.location.href = "student";
                        } else if (res == "staff") {
                            window.location.href = "staff";
                        } else if (res == "Incorrect login credentials") {
                            $("#username").addClass("border-danger");
                            $("#password").addClass("border-danger");
                            $("#user_not_found_auth_error").text(res).addClass("text-danger").removeClass("d-none");
                            window.setTimeout(function() {
                                $("#username").removeClass("border-danger");
                                $("#password").removeClass("border-danger");
                                $("#user_not_found_auth_error").text("").toggleClass("d-none", false).removeClass("text-danger");
                            }, 3000);
                        } else {
                            $("#username").val(username);
                            $("#password").val("");

                            if (!username) {
                                $("#username").addClass("border-danger");
                                $("#user_id_auth_error").text(res).addClass("text-danger").removeClass("d-none");
                                window.setTimeout(function() {
                                    $("#username").removeClass("border-danger");
                                    $("#user_id_auth_error").text("").toggleClass("d-none", false).removeClass("text-danger");
                                }, 3000);
                                return;
                            }

                            if (!password) {
                                $("#password").addClass("border-danger");
                                $("#password_auth_error").text(res).addClass("text-danger").removeClass("d-none");
                                window.setTimeout(function() {
                                    $("#password").removeClass("border-danger");
                                    $("#password_auth_error").text("").toggleClass("d-none", false).removeClass("text-danger");
                                }, 3000);
                                return;
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>