<?php
session_start();

// Define species attributes
$species_list = [
    'Humans' => [
        'description' => 'The most dominant species on the planet of Lo, at the moment. These mostly hairless bipeds were trapped in religious servitude to the Theyrans before their empire fell at the dawn of the new dark age. Now, humans wage just as much war on each other as they do other on other species. The power vacuum destabilized most settlements into feuding kingdoms and tribes, leaving humans the most vulnerable they’ve ever been. Settlements already had to be sparse and walled off due to the danger of monsters and raiders. Now the Theyrans that protected and provided are gone. Humans are at the beginning of their decline. They have an average height of around 5½ft.',
        'health' => 1,
        'blood' => 2,
        'size' => 1
    ],
    'Trolls' => [
        'description' => 'One of the most ancient surviving species on Lo. These creatures are humanoid in shape, with a hulking frame and long curly hair covering their body. Their heads sport a long but strong snout tipped with a black nose, not unlike that of a wolf. Their most noticeable feature are the bony crests that surround the eyes. The males tend to be leaner than the females, which tend to be larger. As such, while most of the men go to war, the women are typically just as practiced in war to defend their homes and families. Trolls were removed from their dominant position after an event called the First Scorching, the first massive invasion of demons. They almost went extinct, and never fully recovered from their losses in both numbers and cultures. Most trolls now live in isolated areas far away from humans or as nomads. Very few participate in raids, usually on human settlements, both as a way of life, and revenge. They have an average height of around 7ft.',
        'health' => 2,
        'blood' => 3,
        'size' => 2
    ],
    'Veteris' => [
        'description' => 'Massive humanoid demons, with broad and short snouts and bodies larger than even trolls on average. They bare resemblance between a man and ape, with large teeth and sagittal crests. They are also covered in sparse but coarse hairs that are thickest around the head and down the back. Veteris first arrived in the war-hordes of the first scorching where they were used as expendable troops in the ranks of the invading demon lords. When they were freed from their war hordes, they gained an infamous reputation of being raiders and bandits. A reputation that is still believed today. However, in actuality most veteris live in small reclusive pockets away from anyone and anything. They are in decline as they are forced from any homes they do have. The rest of the world still only sees mindless demons, undesirable threats. They have an average height of around 7½ft.',
        'health' => 2,
        'blood' => 5,
        'size' => 2
    ],
    'Kobolds' => [
        'description' => 'Strange creatures, kobolds have chimp-like bodies, with their arms being much longer than their legs, while also sporting hook claws that allow for climbing. Their bodies are lightly scaled with a wide arrangement of mostly dull colors. From black, gray, brown, white (often found in albinos), and rarely a brick red. Kobold heads hoist small black horns with differing orientations that can stem from out the back of their brow ridge to the back of their head. They have wide eyes, whose pupils encompass almost the entire eye leaving no seeable white. This adaptation allows them to take in more light, granting them basic night vision. They are a species of demon that came out of hiding alongside the Dragons, when the Theyran Empire fell. Kobolds worship dragons and have fed upon their flesh since their inception, in hopes of gaining their power, even if it was just a fraction. They are greatly entwined with the Dragon Cult and do the bidding of the Dragons of Lo, with any heretics or deserters being hunted down and killed. They have an average height of around 5ft.',
        'health' => 1,
        'blood' => 1,
        'size' => 1
    ],
    'Catalyst' => [
        'description' => 'A relative newcomer to Lo, with strange resonating bodies with a floating crystal-like head, and limbs that levitate near where joints would be. They hoist themselves through the air along the ground with tripod legs, the third back leg having a thick upper thigh that splits into two leg ends. With two sets of arms, one set longer and the other shorter, closer towards the front of the body. These smaller pairs of arms are not designed to hold any objects and are instead relegated to cleaning around the mouth. Under the levitating crystal head is the flesh collar where sustenance is taken into the main body before being processed and delivered to the rest of the creature. Originally deployed by power hungry Star-Spawn as a mercenary militia, they are hired out to prepare worlds for invasion. However, Lo is an unpredictable place and many catalysts either end up dead or become habituated over the generations. This is the reason why most catalyst invasions fail, small, deployed forces in unfamiliar lands quickly who over generations, their children become dedicated to an art other than warfare for the Star-Spawn in space. Catalysts have strange ways and cultures that match their strange biology. Catalysts live in pods where they dedicate themselves to a single.',
        'health' => 2,
        'blood' => 2,
        'size' => 2
    ]
];

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store species selection
    $species = htmlspecialchars($_POST['species']);
    $_SESSION['species'] = $species;

    // Retrieve the selected species attributes
    if (isset($species_list[$species])) {
        $_SESSION['speciesAttributes'] = $species_list[$species];

        // Save species to JSON file
        $filename = "data/" . $_SESSION['name'] . ".json";
        $data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

        // Prepare data for JSON
        $data['species'] = $species;
        $data['speciesAttributes'] = $_SESSION['speciesAttributes'];

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        // Redirect to the next page
        header("Location: bg.php");
        exit();
    }
}

// Retrieve the selected species from session
$selected_species = isset($_SESSION['species']) ? $_SESSION['species'] : '';
?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>NDA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
        }
        .species-option {
            margin-bottom: 20px;
        }
        .species-option label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .species-option input[type="radio"] {
            margin-right: 10px;
        }
        .species-option textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 5px;
            resize: none;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
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
<form method="POST">
            <?php foreach ($species_list as $species_name => $species_data): ?>
                <div class="species-option">
                    <label>
                        <input type="radio" name="species" value="<?php echo $species_name; ?>" <?php echo ($selected_species === $species_name) ? 'checked' : ''; ?>>
                        <?php echo $species_name; ?>
                    </label>
                    <textarea readonly><?php echo $species_data['description']; ?></textarea>
                </div>
            <?php endforeach; ?>
            <button type="submit">Next</button>
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