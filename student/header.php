<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="../assets/image/dd-logo.png" />
    <title>
        DD-CBT PORTAL
    </title>
        <link rel="icon" type="image" href="../assets/image/dd-logo.png" />
        <link href="../assets/css/output.css" rel="stylesheet"/>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <script src="../assets/js/jquery.js"></script>

    <style>
  body {
         /* font-size: 14px; */
         overflow-Y: auto;
         height: 100vh;
     }

  ::-webkit-scrollbar{
            width: 8px;
        }
        ::-webkit-scrollbar-track{
            background: #e6f4ea;
        }
        ::-webkit-scrollbar-thumb{
            background: linear-gradient(to bottom, #15803d, #22c55e);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover{
            background: linear-gradient(to bottom, #166534, #16a34a);
        }

        html{
            scrollbar-width: thin;
            scrollbar-color: #22c55e #e6f4ea;
        }

     .bg-success{
        background: #00c950 !important;
     }
     .bg-crimson{
        background: crimson !important;
     }

     .btn-success{
        background: #00c9503a !important;
     }

     .text-success{
        color: #00c950 !important;
     }


     .side-nav {
         background-color: #fff;
     }

     .greeting{
        display: flex;
        padding: 20px;
     }

      .greeting p{
            width: 85%;
            font-size: 18px;
        }

     .sidebar {
         margin: 0;
         padding: 0;
         height: 100vh;
     }

     .fetch-card{
        transition: all 0.2s;
        border-left: 2px solid crimson;
        box-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        background: #fff;
        border-radius: 5px;
     }

     .fetch-card:hover{
        transition: all 0.2s;
        transform: translateY(-3px);
        border-left: 4px solid crimson;
        box-shadow: 1px 1px 5px rgba(0,0,0,0.1)
     }

     .avail-exam{
        border-left: 5px solid #00c950;
     }

     @media only screen and (max-width: 600px){
        .sidebar{
            height: max-content;
        }

        .greeting{
            flex-direction: column-reverse;
            padding: 20px;
        }

        .greeting p{
            width: 100%;
            font-size: 14px;
        }
     }

     .side-nav .sidebar li {
         display: block;
         margin-top: 10px;
         margin-bottom: 10px;
         padding: 0.25rem 0.55rem;
         color: #333;
         cursor: pointer;
     }

     .side-nav .sidebar .active:not(:last-child) {
        background: linear-gradient(to right, #13a147ff, #22c55e);
         border-radius: 5px;
         color: #fff !important;
         font-weight: bold;
     }
     .side-nav .sidebar li:not(:last-child):hover {
        background: linear-gradient(to right, #13a147ff, #22c55e);
         border-radius: 5px;
         color: #fff !important;
         font-weight: bold;
     }

     .side-nav .sidebar .active i {
         color: #fff !important;
     }

     .sidebar li i,
     i {
         color: #000;
         font-size: 14px !important;
     }
            .btn-success{
        background: #00c950 !important;
        outline: 0;
        border: 0;
     }
            .btn-crimson{
        background: crimson !important;
        outline: 0;
        border: 0;
     }
            .btn-blue{
        background: #1447e6 !important;
        color: #fff;
        outline: 0;
        border: 0;
        transition: all .4s
     }



        </style>
</head>