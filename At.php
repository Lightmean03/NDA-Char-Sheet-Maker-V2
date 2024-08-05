<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['attributes'] = [
        'strength' => $_POST['strength'],
        'agility' => $_POST['agility'],
        'intelligence' => $_POST['intelligence'],
        'toughness' => $_POST['toughness'],
        'attractiveness' => $_POST['attractiveness'],
        'awareness' => $_POST['awareness']
    ];

    // Update JSON file
    $filename = "data/" . $_SESSION['name'] . ".json";
    $data = [
        'name' => $_SESSION['name'],
        'age' => $_SESSION['age'],
        'gender' => $_SESSION['gender'],
        'attributes' => $_SESSION['attributes']
    ];
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

    header("Location: Sp.php");
    exit();
}
?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>NDA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
  <script>
        function updatePoints() {
            let totalAttributePoints = 10;
            let attributePointsSpent = 0;

            const attributes = ['strength', 'agility', 'intelligence', 'toughness', 'attractiveness', 'awareness'];
            attributes.forEach(attribute => {
                attributePointsSpent += parseInt(document.getElementById(attribute).value);
            });

            const attributePointsLeft = totalAttributePoints - attributePointsSpent;
            document.getElementById('attribute-points-left').textContent = attributePointsLeft;

            let valid = attributePointsLeft >= 0;
            document.getElementById('submit-btn').disabled = !valid;
        }

        window.onload = function() {
            updatePoints();
            const attributes = ['strength', 'agility', 'intelligence', 'toughness', 'attractiveness', 'awareness'];
            attributes.forEach(attribute => {
                document.getElementById(attribute).addEventListener('change', updatePoints);
            });
        }
    </script>

	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<div class="logo container">
						<div>
							<h1><a href="index.php" id="logo">NDA</a></h1>
							<p>	

New Dark Age Charcter Sheet Creator</p>
						</div>
					</div>
				</header>

						<!-- Main -->
				<section id="main">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="content">

									<!-- Content -->

										<article class="box page-content">

											<header>
												<h2>Attributes</h2>
												<p>Attribute Points Distribution (10 points to distribute, max 5 per attribute):</p>
												
											</header>
  <form method="post" action="">
        <?php
        $attributes = ['strength', 'agility', 'intelligence', 'toughness', 'attractiveness', 'awareness'];
        foreach ($attributes as $attribute) {
            echo "<label for='$attribute'>" . ucfirst($attribute) . ":</label>
            <select id='$attribute' name='$attribute' required>
                <option value='0'>0</option>";
            for ($i = 1; $i <= 5; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select><br><br>";
        }
        ?>
        <p>Attribute points left: <span id="attribute-points-left">10</span></p>
        <input type="submit" id="submit-btn" value="Next">
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