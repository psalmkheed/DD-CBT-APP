 <?php
    include("db.php");
    session_start();
    if (!isset($_SESSION["user"]["user_id"])) {
        header("Location:../index.php");
        exit;
    }
    $acad_info = getAcadYear($conn);
    $term = $acad_info["term"];
    $sess = $acad_info["year"];
    ?>

 <!DOCTYPE HTML>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image" href="../assets/image/dd-logo.png" />
     <title>
         DD-CBT APP
     </title>

     <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
     <link href="../assets/css/output.css" rel="stylesheet" />
     <script src="../assets/js/bootstrap.bundle.js"></script>
     <script src="../assets/js/jquery.js"></script>
     <style>
         body {
             height: 100vh;
             overflow-X: hidden;
             overflow-Y: hidden;
         }

         * {
             padding: 0;
             margin: 0;
             box-sizing: border-box;
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
             box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.25) !important;
             border: #00c950 !important;

         }

         .sidebar {
             margin: 0;
             padding: 0;
             height: 100vh;
         }

         .sidebar li {
             display: block;
             /* margin-top: 10px; */
             padding-block: 8px;
             display: flex;
             gap: 12px;
             align-items: center;
             padding-inline: <?php echo (isset($_SESSION['user']['user_role']) && $_SESSION['user']['user_role'] == 'Admin') ? '10px' : '15px'; ?>;
             color: #999;
             cursor: pointer;
         }

         .main-content {
             max-height: 100vh;
             overflow-y: auto;
         }

         .bg-success {
             background: #00c950 !important;
         }

         .text-success {
             color: #00c950 !important;
         }

         .sidebar .active {
             background-color: #00c95030;
             border-radius: 50px;
             color: #fff !important;
             font-weight: medium;
             /* #208A59 */
         }

         .sidebar li:hover {
             background-color: #00c95030;
             border-radius: 50px;
             color: #fff !important;
             font-weight: medium;
         }


         .sidebar .active i {
             color: #fff !important;
         }

         .sidebar li i,
         i {
             color: #000;
             font-size: 16px !important;
         }

         #profile-btn {
             cursor: pointer;
             position: relative;
             transition: ease-in-out 3s;
         }

         ul li {
             list-style-type: none;
         }

         #profile-dropDown {
             display: none;
             position: absolute;
             top: 40px;
             width: 100%;
             right: 0;
             z-index: 99999;
             font-size: 14px;
             transition: ease-in-out 3s;
         }

         #profile-btn:hover #profile-dropDown {
             display: block;
             transition: ease-in-out 3s;
         }

         ul.profile-list li:hover {
             background: #00c950;
             color: white;
             font-weight: 600;
         }

         .border-success {
             border-color: #00c950 !important;
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

         /* Dashboard Card */

         .dashboard-card-group {
             display: grid;
             grid-template-columns: repeat(4, 1fr);
             gap: 30px;
         }

         .dashboard-card {
             background: #fff;
             border-top: 5px solid;
             width: 100%;
             height: 150px;
             border-radius: 10px;
             box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
             transition: all 0.3s;
             cursor: pointer;
             display: flex;
             justify-content: center;
             align-items: center;
             gap: 10px;
             flex-direction: column;
             padding: 10px;
             text-align: center;
         }

         .dashboard-card:hover {
             background: #efefef54;
             transform: translateY(-5px);
         }

         .dashboard-card h3 {
             font-size: 40px;
             font-weight: bolder;
             margin: 0;
         }

         .dashboard-card h5 {
             color: #666;
             font-weight: bold;
             font-size: 20px;
             margin: 0;
             text-transform: capitalize;
         }

         .dashboard-card-icon {
             width: 45px;
             padding: 10px;
             border-radius: 10px;
         }

         .dashboard-card-icon img {
             width: 100px;
             object-fit: cover;

         }

         table {
             border-collapse: collapse;

             border-spacing: 0;
             border: none;

         }

         th,
         td {
             border: 0;
             padding: 10px;
         }


         tr:first-child th:first-child {
             border-top-left-radius: 10px;
             border: 0;
         }

         tr:first-child th:last-child {
             border-top-right-radius: 10px;
             border: 0;
         }

         tr:last-child td:first-child {
             border-bottom-left-radius: 10px;
             border: 0;
         }

         tr:last-child td:last-child {
             border-bottom-right-radius: 10px;
             border: 0;
         }

         /* Media query */
         @media screen and (max-width: 768px) {
             body {
                 overflow-y: auto;
                 overflow-x: hidden;
                 font-size: 1.5rem;
             }
             .sidebar {

                 width: 100%;
                 height: max-content;
                 font-size: 1.5rem;
             }

             .dashboard-card-group {
                 grid-template-columns: repeat(2, 1fr);
             }

         }
     </style>
 </head>