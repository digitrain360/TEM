<?php
// define variables and set to empty values
$AppIDErr = $AppNameErr = $AppTypeErr = $AppCatErr = $AppProgLangErr = "";
$Application_ID = $Application_Name = $Application_Type = $Application_Category = $Application_Prog_Language = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Application_ID"])) {
    $AppIDErr = "Application ID is required";
  } else {
      $Application_ID = test_input($_POST["Application_ID"]);
  }

  if (empty($_POST["Application_Name"])) {
    $AppNameErr = "Application Name is required";
  } else {
    $Application_Name = test_input($_POST["Application_Name"]);
  }

  if (empty($_POST["Application_Type"])) {
      $AppTypeErr = "Application Type is Required";
  } else {
      $Application_Type = test_input($_POST["Application_Type"]);
  }

  if (empty($_POST["Application_Category"])) {
    $AppCatErr = "Application Category is required";
  } else {
    $Application_Category = test_input($_POST["Application_Category"]);
  }

  if (empty($_POST["Application_Prog_Language"])) {
    $AppProgLangErr = "Application Programming Language is required";
  } else {
    $Application_Prog_Language = test_input($_POST["Application_Prog_Language"]);
  }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
