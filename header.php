<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        DD CBT PORTAL - LOGIN
    </title>
    <link rel="icon" type="image" href="assets/image/dd-logo.png" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/output.css" rel="stylesheet" />
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <style>
        body {

            background: url(assets/image/cbt-bg.jpg);
            background-size: cover;
            background-repeat: repeat-y;
            background-attachment: fixed;
            padding: 0;
            overflow-x: hidden;
        }


        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e6f4ea;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #15803d, #22c55e);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #166534, #16a34a);
        }

        html {
            scrollbar-width: thin;
            scrollbar-color: #22c55e #e6f4ea;
        }

        .form-control:focus {
            box-shadow: 0 0 0 .05rem rgba(41, 253, 13, 0.75) !important;
            border: #00c950 !important;

        }

        .btn-success {
            background: #00c950 !important;
            outline: 0;
            border: 0;
            transition: ease-in-out 0.2s;
        }

        .btn-success:hover {
            background: #00973cff !important;
        }

        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear inifnite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #main {
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.9);
            margin-top: 0;
            width: 100vw;
        }
    </style>
</head>