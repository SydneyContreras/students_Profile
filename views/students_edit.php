<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Students Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once("../db.php"); // Include the Database class file
    include_once("../students.php"); // Include the Student class file
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch student data by ID from the database
        $db = new Database();
        $students = new Students($db);
        $studentData = $students->read($id); // Implement the read method in the Student class
    
        if ($studentData) {
            // The student data is retrieved, and you can pre-fill the edit form with this data.
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Student ID not provided.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = [
            'id' => $_POST['id'],
            'student_number' => $_POST['student_number'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'middle_name' => $_POST['middle_name'],
            'gender' => $_POST['gender'],
            'birthday' => $_POST['birthday'],
        ];

        $db = new Database();
        $students = new Students($db);

        // Call the edit method to update the student data
        if ($students->update($id, $data)) {
            echo "Record updated successfully.";
            header("Location: students_view.php");
        } else {
            echo "Failed to update the record.";
        }
    }
    ?>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include('../includes/header.php') ?>
    </header>
    <aside id="sidebar" class="sidebar">
        <?php include('../includes/sidebar.php') ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Student Table</h1>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title">Edit Student Name</h5>
                <form class="row g-3 needs-validation" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" novalidate>
                    <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="validationCustom01"
                            value="<?php echo $studentData['student_number']; ?>" name="student_number" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="validationCustom01"
                            value="<?php echo $studentData['first_name']; ?>" name="first_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="validationCustom02"
                            value="<?php echo $studentData['last_name']; ?>" name="last_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="validationCustom02"
                            value="<?php echo $studentData['middle_name']; ?>" name="middle_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Gender</label>
                        <select class="form-select" id="validationCustom04" name="gender"
                            value="<?php echo $studentData['gender']; ?>" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                            <option value="2">Others</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a gender.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="validationCustom05" name="birthday"
                            value="<?php echo $studentData['birthday']; ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid birthdate.
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
    </main>



    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>