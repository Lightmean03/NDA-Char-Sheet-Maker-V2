<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];

    header("Location: At.php");
    exit();
}
?>


<!DOCTYPE HTML>
<html>
	<head>
    <style>
        body {
            background-color: white;
            color: black;
        }
        label {
            display: inline-block;
            margin-right: 10px;
        }
        input[type="radio"] {
            margin-right: 5px;
			accent-color: blue; /* This CSS property changes the color of radio buttons */
        }
    </style>
		<title>NDA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<div class="logo container">
						<div>
							<h1><a href="index.html" id="logo">NDA</a></h1>
							<p>New Dark Age Charcter Sheet Creator</p>
						</div>
					</div>
				</header>

			
			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<h2>New Dark Age 2</h2>
						<p>Create you charcter sheet online</p>
						<a href="index.php#form" class="button scrolly">Start</a>
					</div>
				</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
						<div class="row gtr-200">
							<div class="col-12">

															</div>
							<div class="col-12">

								<!-- Features -->
									<section class="box features">
										<h2 id="form" class="major"><span>Basic Info</span></h2>
									 <form method="post" action="">
        <label  for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="age">Age:</label>
        <select id="age" name="age" required>
            <?php
            for ($i = 1; $i <= 100; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>
		<label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Gideon</option>
        </select><br><br>

        <input type="submit" value="Next">
    </form>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
