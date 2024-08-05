<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store skills
    $_SESSION['skills'] = [
        'combat' => [
            'martial' => $_POST['martial'],
            'ranged' => $_POST['ranged'],
            'dodge' => $_POST['dodge']
        ],
        'stealth' => [
            'hide' => $_POST['hide'],
            'quiet' => $_POST['quiet'],
            'assassination' => $_POST['assassination'],
            'sleight' => $_POST['sleight'],
            'disguise' => $_POST['disguise']
        ],
        'personality' => [
            'charm' => $_POST['charm'],
            'persuasion' => $_POST['persuasion'],
            'command' => $_POST['command'],
            'intrigue' => $_POST['intrigue'],
            'intimidate' => $_POST['intimidate']
        ],
        'awareness' => [
            'spotting' => $_POST['spotting'],
            'listening' => $_POST['listening'],
            'insight' => $_POST['insight'],
            'barter' => $_POST['barter'],
            'evaluate' => $_POST['evaluate']
        ],
        'knowledge_skills' => [
            'first_aid' => $_POST['first_aid'],
            'religion' => $_POST['religion'],
            'speak_language' => $_POST['speak_language'],
            'read_write_language' => $_POST['read_write_language'],
            'craft' => $_POST['craft'],
            'lore' => $_POST['lore']
        ],
        'nature' => [
            'athletics' => $_POST['athletics'],
            'survival' => $_POST['survival'],
            'track' => $_POST['track'],
            'animals' => $_POST['animals'],
            'riding' => $_POST['riding'],
            'climbing' => $_POST['climbing'],
            'swimming' => $_POST['swimming'],
            'trap' => $_POST['trap']
        ],
        'magic' => [
            'evocation' => $_POST['evocation'],
            'attunement' => $_POST['attunement'],
            'ritual' => $_POST['ritual']
        ]
    ];

    // Update JSON file
    $filename = "data/" . $_SESSION['name'] . ".json";
    if (file_exists($filename)) {
        // Load existing data
        $existingData = json_decode(file_get_contents($filename), true);
    } else {
        $existingData = [];
    }

    // Merge existing data with new data
    $data = array_merge($existingData, [
        'name' => $_SESSION['name'],
        'age' => $_SESSION['age'],
        'gender' => $_SESSION['gender'],
        'attributes' => $_SESSION['attributes'],
        'species' => $_SESSION['species'],
        'background' => $_SESSION['background'],
        'skills' => $_SESSION['skills']
    ]);

    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: json.php");
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
												<h2>Skills</h2>
												<p> Skill Points Distribution (20 points to distribute, max 5 for magic skills)</p>
												
											</header>
    <script>
        function updatePoints() {
            let totalSkillPoints = 20;
            let skillPointsSpent = 0;

            const skills = [
                'martial', 'ranged', 'dodge', 'hide', 'quiet', 'assassination', 'sleight', 'disguise',
                'charm', 'persuasion', 'command', 'intrigue', 'intimidate', 'spotting', 'listening',
                'insight', 'barter', 'evaluate', 'first_aid', 'religion', 'speak_language',
                'read_write_language', 'craft', 'lore', 'athletics', 'survival', 'track', 'animals',
                'riding', 'climbing', 'swimming', 'trap', 'evocation', 'attunement', 'ritual'
            ];

            skills.forEach(skill => {
                skillPointsSpent += parseInt(document.getElementById(skill).value) || 0;
            });

            const skillPointsLeft = totalSkillPoints - skillPointsSpent;
            document.getElementById('skill-points-left').textContent = skillPointsLeft;

            let valid = true;
            if (skillPointsLeft < 0 || skillPointsLeft > 20) {
                valid = false;
            }

            const magicSkills = ['evocation', 'attunement', 'ritual'];
            magicSkills.forEach(skill => {
                if (parseInt(document.getElementById(skill).value) > 5) {
                    valid = false;
                }
            });

            document.getElementById('submit-btn').disabled = !valid;
        }

        window.onload = function() {
            updatePoints();
            const skills = [
                'martial', 'ranged', 'dodge', 'hide', 'quiet', 'assassination', 'sleight', 'disguise',
                'charm', 'persuasion', 'command', 'intrigue', 'intimidate', 'spotting', 'listening',
                'insight', 'barter', 'evaluate', 'first_aid', 'religion', 'speak_language',
                'read_write_language', 'craft', 'lore', 'athletics', 'survival', 'track', 'animals',
                'riding', 'climbing', 'swimming', 'trap', 'evocation', 'attunement', 'ritual'
            ];
            skills.forEach(skill => {
                document.getElementById(skill).addEventListener('change', updatePoints);
            });
        }
    </script>
</head>
<body>
    <form method="post" action="">
        <?php
        $skills = [
            'combat' => ['martial', 'ranged', 'dodge'],
            'stealth' => ['hide', 'quiet', 'assassination', 'sleight', 'disguise'],
            'personality' => ['charm', 'persuasion', 'command', 'intrigue', 'intimidate'],
            'awareness' => ['spotting', 'listening', 'insight', 'barter', 'evaluate'],
            'knowledge_skills' => ['first_aid', 'religion', 'speak_language', 'read_write_language', 'craft', 'lore'],
            'nature' => ['athletics', 'survival', 'track', 'animals', 'riding', 'climbing', 'swimming', 'trap'],
            'magic' => ['evocation', 'attunement', 'ritual']
        ];

        foreach ($skills as $category => $skillList) {
            echo "<h3>" . ucfirst($category) . "</h3>";
            foreach ($skillList as $skill) {
                echo "<label for='$skill'>" . ucfirst($skill) . ":</label>
                <input type='number' id='$skill' name='$skill' min='0' max='10' value='0' required><br><br>";
            }
        }
        ?>
        <p>Skill points left: <span id="skill-points-left">20</span></p>
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