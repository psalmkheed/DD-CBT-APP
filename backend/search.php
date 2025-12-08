<?php
include "db.php";

if (!isset($_GET['query']) || !isset($_GET['type'])) {
      echo "<p class='text-red-500'>Invalid request.</p>";
      exit;
}

$searchQuery = trim($_GET['query']);
$type = $_GET['type'];
$like = "%{$searchQuery}%";
$sn = 1;

if ($type == "user") {

      $sql = "SELECT * FROM users 
            WHERE user_id LIKE ? 
            OR other_names LIKE ? 
            OR user_role LIKE ?
            OR surname LIKE ?
            OR class LIKE ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssss", $like, $like, $like, $like, $like);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 0) {
            echo "<p class='text-red-600'>No users found.</p>";
            exit;
      }
      echo "<p class='text-xl text-red-600 p-0 mb-2'>Search Results for <span class='font-bold'>{$searchQuery}</span></p>";
      echo "<table class='w-full border table-bordered table-striped'>
            <thead class='bg-green-700 text-white'>
                <tr>
                    <th class='p-2'>#</th>
                    <th class='p-2'>User ID</th>
                    <th class='p-2'>Surname</th>
                    <th class='p-2'>Names</th>
                    <th class='p-2'>Class</th>
                    <th class='p-2'>Role</th>
                    <th class='p-2'>Image</th>
                </tr>
            </thead>
            <tbody class='text-xs'>";

      while ($row = $result->fetch_assoc()) {
            echo "<tr class='border-b'>
        <td class='p-2'>{$sn}</td>
        <td class='p-2'>" . ucfirst($row['user_id']) . "</td>
        <td class='p-2'>" . ucfirst($row['surname']) . "</td>
        <td class='p-2'>" . ucwords($row['other_names']) . "</td>
        <td class='p-2'>" . ucwords($row['class']) . "</td>
        <td class='p-2'>" . ucfirst($row['user_role']) . "</td>
        <td class='p-2'>
            <img class='rounded-circle' src='" . $row['directory'] . "' style='width:30px; height:30px;' />
        </td>
    </tr>";
            $sn++;
      }


      echo "</tbody></table>";
}




// ----------------------
// EXAMS SEARCH
// ----------------------
if ($type == "exam") {

      $sql = "SELECT * FROM exams 
            WHERE subjects LIKE ? 
            OR class LIKE ? 
            OR author LIKE ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $like, $like, $like);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 0) {
            echo "<p class='text-red-600'>No exams found.</p>";
            exit;
      }
      echo "<p class='text-xl text-red-600'>Search Results for <span class='font-bold'>{$searchQuery}</span></p><br/><br/>";
      echo "<table class='w-full border table-bordered table-striped'>
            <thead class='bg-green-700 text-white'>
                <tr>
                    <th class='p-2'>#</th>
                    <th class='p-2'>Subject</th>
                    <th class='p-2'>Class</th>
                    <th class='p-2'>Author</th>
                </tr>
            </thead>
            <tbody class='text-xs'>";

      while ($row = $result->fetch_assoc()) {
            echo "<tr class='border-b'>
                <td class='p-2'>{$sn}</td>
                <td class='p-2'>{$row['subjects']}</td>
                <td class='p-2'>{$row['class']}</td>
                <td class='p-2'>{$row['author']}</td>
              </tr>";
            $sn++;
      }

      echo "</tbody></table>";
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
            Search Result
      </title>
      <link rel="icon" type="image" href="../assets/image/dd-logo.png" />
      <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
      <link href="../assets/css/output.css" rel="stylesheet" />
      <script src="../assets/js/jquery.js"></script>
      <script src="../assets/js/bootstrap.bundle.js"></script>