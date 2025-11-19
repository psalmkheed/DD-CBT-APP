<style>
    .form-label {
        color: #023020;
        font-weight: 500;
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
</style>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col-lg-12 p-0 m-0" id="content_box">
                <div class="px-3 py-2 text-white mb-3 rounded-3" style="background: rgba(0, 123, 255, 0.8);">
                    <h5 class="m-0">Create New Examination</h5>
                </div>
                <form method="post" action="exams.php?qs=new" id="addexam" style="font-family:sans-serif">
                    <div class="row p-2">
                        <div class="response px-2"></div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="session" class="form-label text-seconary">Choose Academic Session</label>
                                <select class="form-control" name="session">
                                    <option disabled selected>Select Academic Session</option>
                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>
                                    <option value="2027/2028">2027/2028</option>
                                    <option value="2028/2029">2028/2029</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="term" class="form-label text-seconary">Select Term</label>
                                <select class="form-control" name="term">
                                    <option disabled selected>Select Term</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="class" class="form-label text-seconary">Select Class</label>
                                <select class="form-control" name="class">
                                    <option disabled selected>Select Class</option>
                                    <option value="YEAR 5">YEAR 5</option>
                                    <option value="JSS 1">JSS 1</option>
                                    <option value="JSS 2">JSS 2</option>
                                    <option value="JSS 3">JSS 3</option>
                                    <option value="SSS 1">SSS 1</option>
                                    <option value="SSS 2">SSS 2</option>
                                    <option value="SSS 3">SSS 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="subject" class="form-label text-seconary">Select Subject</label>
                                <select class="form-control" name="subject">
                                    <option disabled selected>Select Subject</option>
                                    <option value="English Language">English Language</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Basic Science">Basic Science</option>
                                    <option value="Basic Technology">Basic Technology</option>
                                    <option value="Business Studies">Business Studies</option>
                                    <option value="CRS">C.R.S</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Geography">Geography</option>
                                    <option value="Home Economics">Home Economics</option>
                                    <option value="Agricultural Science">Agricultural Science</option>
                                    <option value="Geography">Geography</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Social Studies">Social Studies</option>
                                    <option value="French Language">French Language</option>
                                    <option value="Yoruba Language">Youruba Language</option>
                                    <option value="Further Mathematics">Further Mathematics</option>
                                    <option value="Literature">Literature</option>
                                    <option value="Civic Education">Civic Education</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Financial Accounting">Accounting</option>
                                    <option value="Government">Government</option>
                                    <option value="Creatrive Arts">Creative Arts</option>
                                    <option value="Catering Crafts">Catering Crafts Practice</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Food & Nutrition">Food & Nutrition</option>
                                    <option value="Physical & Health Education">Physical & Health Education</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="number of questions" class="form-label text-seconary">Total Number of Questions</label>
                                <select class="form-control" name="num_quest">
                                    <option disabled selected>Select Number of Question</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="70">70</option>
                                    <option value="80">80</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date" class="form-label text-seconary">Due Date</label>
                                <input type="date" name="due_date" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="duration" class="form-label text-seconary">Time Allowed (Minutes)</label>
                                <select class="form-control" name="duration">
                                    <option disabled selected>Select Exam duration</option>
                                    <option value="25">25 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="45">45 Minutes</option>
                                    <option value="60">60 Minutes</option>
                                    <option value="90">90 Minutes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="author" class="form-label text-seconary">Subject Teacher</label>
                                <select class="form-control" name="author">
                                    <option disabled selected>Select Subject Teacher</option>
                                    <?php
                                    include("../admin/db.php");
                                    $sql = "SELECT * FROM users WHERE user_role='staff'";
                                    $query = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($query);
                                    $res = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    print_r($res);
                                    foreach ($res as $d) {
                                        echo "<option value='" . $d["user_id"] . "'>" . $d["surname"] . " " . $d["other_names"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="exam type" class="form-label text-seconary">Exam Type</label>
                                <select class="form-control" name="exam_type">
                                    <option disabled selected>Select Exam type</option>
                                    <option value="Mid-Term">Mid-Term</option>
                                    <option value="Mock Examination">Mock Examination</option>
                                    <option value="Examination">Examination</option>
                                    <option value="Entrance">Entrance Test</option>
                                    <option value="Common_Entrance">Common Entrance</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-1 mt-1">
                                <label for="exam type" class="form-label text-seconary">Paper Type</label>
                                <select class="form-control" name="paper_type">
                                    <option disabled selected>Select Paper type</option>
                                    <option value="Objectives">Objectives</option>
                                    <option value="Theory">Theory</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-2 mt-3">
                            <div class="col-lg-6">
                                <input type="submit" name="submit" value="Create Exam" class="btn btn-success btn-md text-uppercase fw-bold">
                            </div>
                        </div>
                </form>
            </div>
            <!--JQuery Begins here -->
            <script>
                $(document).ready(function() {
                    $("#addexam").submit(function(event) {
                        event.preventDefault();
                        let formdata = new FormData(this);
                        $.ajax({
                            method: "post",
                            url: "../exams/exams.php?qs=add_exam",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                alert(res);
                                window.location.reload();
                            }
                        });
                    });
                })
            </script>