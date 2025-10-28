<style>
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
                    <h5 class="m-0">Create New Student Account</h5>
                </div>
                <form method="post" action="create_student__account.php" enctype="multipart/form-data" id="myform2">
                    <div class="row p-2">
                        <div class="col-lg-6">
                            <div class="form-floating mb-1 mt-1">
                                <input type="text" class="form-control rounded-3" id="f_name" placeholder="Firstname" name="sname" required>
                                <label class="form-label" for="email">Surname</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mt-1">
                                <input type="text" class="form-control rounded-3" id="o_name" placeholder="" name="other" required>
                                <label class="form-label" for="o_name">Other Names <span class="ms-3 text-danger">Separate Name with space</span> e.g James Maxwell</label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-lg-6">
                            <div class="form-floating mb-1 mt-1">
                                <input type="text" class="form-control rounded-3" id="adm_num" placeholder="" name="adm_num" required>
                                <label class="form-label" for="admission number">Admission Number <span class="ms-3 text-danger">DIS/J/23/XXXX</span></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-1 mt-1">
                                <select class="form-control rounded-3" id="class" name="class" required>
                                    <option value="" disabled selected>Select Class</option>
                                    <option value="JSS 1">JSS 1</option>
                                    <option value="JSS 2">JSS 2</option>
                                    <option value="JSS 3">JSS 3</option>
                                    <option value="SSS 1">SSS 1</option>
                                    <option value="SSS 2">SSS 2</option>
                                    <option value="SSS 3">SSS 3</option>
                                </select>
                                <label class="form-label" for="class">Class </label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-lg-6">
                            <div class="form-floating mb-1 mt-1">
                                <input type="password" class="form-control rounded-3" id="auth_code" placeholder="" name="auth_code" required>
                                <label class="form-label" for="auth_code">Password <span class="ms-3 text-danger">Enter a strong password</span></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label"> Upload a <span class="text-danger">(.PNG, .JPG, .JPEG)</span> picture not > 1MB </label>
                            <div class="form-group mb-1 mt-1 p-1">
                                <input type="file" class="form-control rounded-3 p-2" id="pix" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div id="result"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="submit" name="submit" value="Create Student" class="btn btn-success btn-md fw-bold text-uppercase">
                        </div>
                    </div>
            </div>
            </form>
        </div>