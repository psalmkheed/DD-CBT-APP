<?php include("header.php") ?>

<body>
    
    <div class="container-fluid p-0 m-0" id="main">
        <div class="row h-100 d-flex align-items-center p-5">
            <form id="auth_form" action="backend/auth.php" method="post">
                <div class="col-lg-4 rounded-3 mx-auto px-0 bg-white">
                    <div class="d-flex flex-column gap-2 p-3 text-light text-center rounded-top-3 align-items-center justify-content-start" style="background: linear-gradient(to right, #13a147ff, #22c55e);">
                        <img src="assets/image/dd-logo.png" style="width:20%" alt="DED" />
                        <h4 class="fw-bold">CBT PORTAL LOGIN</h4>
                    </div>

                    <div class="container">
                        <div class="row py-2 mt-3 px-3">
                       
                            <div class="container">
                                <div class="row p-2">
                                    <div class="col-lg-12 text-danger fw-bolder" id="auth_error">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label my-2 fw-medium">Student ID / Staff ID / Admin ID</label>
                                <input class="form-control" type="text" name="username" id="username" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label my-2 fw-medium">Password</label>
                                <input class="form-control" type="password" name="password" id="password" />
                            </div>

                            <div class="form-group mt-2">
                                <button id="login" type="submit" class="btn btn-success w-100 fw-bold" name="login" value="login">Access Account </button>
                            </div>
                            <p class="text-dark fw-bolder p-2 mt-2">
                                Forgot Password? Contact the Administrator.
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
                $("#loading").show();
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
                            window.location.href = "admin/index.php";
                        } else if (res == "student") {
                            window.location.href = "student/index.php";
                        } else if (res == "staff") {
                            window.location.href = "staff/index.php";
                        } else {
                            $("#username").val(username);
                            $("#password").val("");
                            $("#auth_error").text(res);
                            window.setTimeout(function() {
                                $("#auth_error").text("");
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>