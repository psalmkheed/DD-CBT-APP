<div class="container-fluid mb-5 p-0">
    <div class="row m-0 p-0">
        <div class="col-lg-12 p-0 m-0" id="content_box">
            <div class="px-3 py-2 text-white mb-3 rounded-3" style="background: rgba(0, 123, 255, 0.8);">
                <h5 class="m-0">Student Records</h5>
            </div>
            <table class="table table-striped table-hover table-responsive">
                <thead class="align-middle">
                    <tr>
                        <th class="bg-success text-white">Names</th>
                        <th class="bg-success text-white">Admission Number</th>
                        <th class="bg-success text-white">Password</th>
                        <th class="bg-success text-white">Class</th>
                        <th class="bg-success text-white">Photo</th>
                </thead>
                <tbody class="align-middle">
                    <?php
                    include_once("db.php");
                    $data = getAllStudents($conn);
                    foreach ($data as $d) {
                        echo '<tr><td>' . $d["surname"] . ' ' . $d["other_names"] . '</td><td>' . $d["user_id"] . '</td><td>' . $d["auth_code"] . '</td><td>' . $d["class"] . '</td><td><img style="height:40px; width:40px;" src="' . $d["directory"] . '"</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>