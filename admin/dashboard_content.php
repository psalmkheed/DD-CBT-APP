<?php
if (session_status() === PHP_SESSION_NONE) {
      session_start();
}
include_once("db.php");
include_once("chart.php");

$acad_info = getAcadYear($conn);
$term = $acad_info["term"];
$sess = $acad_info["year"];
// session_start()
?>

<!-- Welcome Header -->
<div class="col-12 bg-success p-4 p-md-5 d-flex flex-column-reverse flex-lg-row align-items-center justify-content-between rounded-3 mb-4 shadow-sm">
      <div class="text-center text-lg-start mt-3 mt-lg-0 col-lg-9">
            <h3 class="text-white fw-bold">
                  Welcome Back <?= strtoupper($_SESSION["user"]["surname"]); ?> <?= strtoupper($_SESSION["user"]["other_names"]); ?>!
            </h3>
            <p class="text-white mt-2 mx-auto mx-lg-0" style="max-width: 600px;">
                  You have successfully logged into your <strong>Admin Portal</strong>.
                  Manage students, staff, and examinations efficiently using the tools below.
            </p>
      </div>
      <div class="text-center mb-3 mb-lg-0">
            <img class="img-thumbnail rounded-circle shadow"
                  src="<?= $_SESSION['user']['directory'] ?>"
                  alt="Profile"
                  style="width:120px;height:120px;object-fit:cover;">
      </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
      <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center h-100 hover-card">
                  <div class="card-body py-4">
                        <i class="bi bi-people-fill text-success fs-1 mb-2"></i>
                        <h6 class="fw-bold text-muted mb-1">Total Students</h6>
                        <h4 class="fw-bold text-success"><?= count(getAllStudents($conn)); ?></h4>
                  </div>
            </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center h-100 hover-card">
                  <div class="card-body py-4">
                        <i class="bi bi-person-badge-fill text-primary fs-1 mb-2"></i>
                        <h6 class="fw-bold text-muted mb-1">Total Staff</h6>
                        <h4 class="fw-bold text-primary"><?= count(getAllStaff($conn)); ?></h4>
                  </div>
            </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center h-100 hover-card">
                  <div class="card-body py-4">
                        <i class="bi bi-journal-check text-warning fs-1 mb-2"></i>
                        <h6 class="fw-bold text-muted mb-1">Examinations</h6>
                        <h4 class="fw-bold text-warning"><?= count(getAllExams($conn)); ?></h4>
                  </div>
            </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center h-100 hover-card">
                  <div class="card-body py-4">
                        <i class="bi bi-calendar-event-fill text-danger fs-1 mb-2"></i>
                        <h6 class="fw-bold text-muted mb-1">Active Term</h6>
                        <h4 class="fw-bold text-danger"><?= ucfirst($term); ?> Term</h4>
                  </div>
            </div>
      </div>
</div>

<!-- Charts -->
<div class="row g-4">
      <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                  <div class="card-body">
                        <h6 class="fw-bold text-muted mb-3">Performance Overview</h6>
                        <canvas id="performanceChart" height="150"></canvas>
                  </div>
            </div>
      </div>
      <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                  <div class="card-body">
                        <h6 class="fw-bold text-muted mb-3">Exam Completion</h6>
                        <canvas id="completionChart" height="200"></canvas>
                  </div>
            </div>
      </div>
      <div id="chartContainer"></div>

</div>