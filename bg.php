<?php
session_start();
$filename = "data/" . $_SESSION['name'] . ".json";

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store background selection
    $background = htmlspecialchars($_POST['background']);
    $_SESSION['background'] = $background;

    // Retrieve background data
    $backgrounds = [
        'Acolyte' => [
            'description' => 'A lowly practitioner of a particular faith, well-practiced in rituals.',
            'items' => ['Dagger', 'Holy Book', 'Artisans Kit'],
            'money' => 25,
            'skills' => ['Religion(Choice)' => 3, 'Ritual' => 3, 'Read/Write(Choice)' => 3]
        ],
        'Alchemist' => [
            'description' => 'A smalltime chemist who can create potent curatives or poisons.',
            'items' => ['Dagger', 'Alchemist Kit', 'Potion'],
            'money' => 50,
            'skills' => ['Read/Write(Choice)' => 3, 'Alchemy' => 3, 'Transmutation' => 1]
        ],
        'Assassin' => [
            'description' => 'A hired killer who specializes in stealth and espionage.',
            'items' => ['Dagger(Choice)'],
            'money' => 50,
            'skills' => ['Hide' => 2, 'Quiet' => 2, 'Assassination' => 3, 'Disguise' => 1]
        ],
        'Banished' => [
            'description' => 'An outcast and wayfarer, thrown from their home for some crime or taboo they violated.',
            'items' => ['Machete', 'Short Bow', 'Quiver(20 Arrows)'],
            'money' => 0,
            'skills' => ['Martial' => 1, 'Ranged' => 1, 'Intimidate' => 2, 'Survival' => 3, 'Track' => 2]
        ],
        'Bounty Hunter' => [
            'description' => 'An opportunist that hunts wanted folk for coin.',
            'items' => ['Club/Mancatcher(Choice)', 'Net'],
            'money' => 50,
            'skills' => ['Martial' => 2, 'Intrigue' => 2, 'Athletics' => 1, 'Track' => 3]
        ],
        'Craftsman' => [
            'description' => 'The common, but skilled craftsman that can make useful items or structures.',
            'items' => ['Dagger', 'Tools(Choice)'],
            'money' => 40,
            'skills' => ['Barter' => 2, 'Evaluate' => 2, 'Craft(Choice)' => 4, 'Athletics' => 1]
        ],
        'Criminal' => [
            'description' => 'A criminal with a past in petty theft or worse.',
            'items' => ['Dagger/Club(Choice)', 'Lockpicking Tools'],
            'money' => 25,
            'skills' => ['Hide' => 2, 'Quiet' => 2, 'Assassination' => 1, 'Sleight' => 3, 'Intrigue' => 2]
        ],
        'Cultist' => [
            'description' => 'A hidden practitioner of an often-forbidden faith and the occult.',
            'items' => ['Dagger(Choice)', 'Holy Book'],
            'money' => 20,
            'skills' => ['Assassination' => 1, 'Disguise' => 1, 'Religion(Choice)' => 3, 'Ritual' => 3, 'Read/Write(Choice)' => 3]
        ],
        'Deserter/Soldier' => [
            'description' => 'A soldier who deserted their post or a soldier who was abandoned.',
            'items' => ['Polearm/Axe/Arming Sword(Choice)', '1 piece Padded Cloth', '2 Misc Armors(Choice)', 'Kettlepot/Conical Helmet(Choice)', 'or trade 1 armor piece for a Round/Heater Shield(Choice)'],
            'money' => 10,
            'skills' => ['Martial' => 3, 'Dodge' => 1, 'Athletics' => 1, 'Survival' => 2]
        ],
        'Deprived' => [
            'description' => 'You were abandoned, forsaken, and left to die stranded with nothing to your name. Not even clothes.',
            'items' => ['Nothing'],
            'money' => 0,
            'skills' => ['+10 Skill Points']
        ],
        'Diplomat' => [
            'description' => 'A skilled negotiator and representative of their realm.',
            'items' => ['Dagger'],
            'money' => 100,
            'skills' => ['Charm' => 2, 'Persuasion' => 3, 'Speak Language(Choice)' => 3]
        ],
        'Executioner' => [
            'description' => 'A brutal enforcer of the law, skilled in delivering the final blow.',
            'items' => ['Greatsword/Battle Axe(Choice)', 'Rope(50ft)'],
            'money' => 30,
            'skills' => ['Martial' => 2, 'Assassination' => 3, 'Intimidate' => 1, 'Athletics' => 1]
        ],
        'Farmer' => [
            'description' => 'A hardworking individual skilled in agriculture and animal husbandry.',
            'items' => ['Flail', 'Dagger', '3 Days of Food'],
            'money' => 25,
            'skills' => ['Botany' => 2, 'Athletics' => 1, 'Riding' => 2, 'Animals' => 3]
        ],
        'Fence' => [
            'description' => 'A handler of stolen goods with connections in the underworld.',
            'items' => ['Dagger'],
            'money' => 50,
            'skills' => ['Evaluate' => 3, 'Barter' => 3, 'Insight' => 1, 'Read/Write(Choice)' => 3]
        ],
        'Fisherman' => [
            'description' => 'A skilled fisherman with knowledge of the waterways.',
            'items' => ['Dagger', 'Fishing Rod', 'Fish-Bait', 'Net'],
            'money' => 25,
            'skills' => ['Fish' => 3, 'Swim' => 3, 'Trapping' => 2]
        ],
        'Grave Tender' => [
            'description' => 'A caretaker of graves and the keeper of the dead.',
            'items' => ['Staff', 'Torch(3)'],
            'money' => 50,
            'skills' => ['Religion(Choice)' => 3, 'Read/Write(Choice)' => 3, 'Spiritualism' => 1]
        ],
        'Guard' => [
            'description' => 'A watchful protector and defender of the realm.',
            'items' => ['Polearm/Longbow and Quiver(20 Arrows)(Choice)', 'Club', '1 Piece of Padded Cloth', 'Kettlepot/Conical Helmet(Choice)'],
            'money' => 30,
            'skills' => ['Martial' => 2, 'Ranged' => 2, 'Spotting' => 1]
        ],
        'Herbalist' => [
            'description' => 'A practitioner of herbal medicine and natural remedies.',
            'items' => ['Staff', 'Dagger', 'Healing Herb(x3)'],
            'money' => 35,
            'skills' => ['Botany' => 4, 'First Aid' => 2, 'Survival' => 2]
        ],
        'Herder' => [
            'description' => 'A caretaker of livestock and animals.',
            'items' => ['Staff', 'Dagger'],
            'money' => 20,
            'skills' => ['Animals' => 3, 'Survival' => 3, 'Track' => 2]
        ],
        'Hunter' => [
            'description' => 'A skilled hunter with expertise in tracking and ranged combat.',
            'items' => ['Throwing Spears(x3)', 'Short Bow and Quiver(20 Arrows)'],
            'money' => 40,
            'skills' => ['Martial' => 1, 'Ranged' => 1, 'Trap' => 3, 'Track' => 2]
        ],
                'Marauder' => [
            'description' => 'A violent raider with a criminal background.',
            'items' => ['War Axe', 'Polearm/Short Bow and Quiver(20 Arrows)/Round Shield/Heater Shield(Choice)', 'Kettlepot/Conical Helmet(Choice)', 'Leather Jerkin'],
            'money' => 25,
            'skills' => ['Martial' => 3, 'Ranged' => 1, 'Hide' => 1, 'Quiet' => 1, 'Survival' => 2, 'Trap' => 2]
        ],
        'Mercenary' => [
            'description' => 'A professional soldier-for-hire skilled in combat.',
            'items' => ['Weapon(Choice)', 'Full Padded Cloth', 'Kettlepot/Conical Helmet(Choice)'],
            'money' => 40,
            'skills' => ['Martial' => 3, 'Ranged' => 1, 'Barter' => 2]
        ],
        'Merchant' => [
            'description' => 'A savvy trader and negotiator skilled in commerce.',
            'items' => ['Dagger', 'Backpack'],
            'money' => 100,
            'skills' => ['Persuasion' => 1, 'Intrigue' => 1, 'Barter' => 3, 'Evaluate' => 3]
        ],
        'Miner' => [
            'description' => 'A laborer skilled in excavation and geology.',
            'items' => ['War Pick/Warhammer(Choice)', 'Digging Tools'],
            'money' => 30,
            'skills' => ['Evaluate' => 2, 'Earthlore' => 3, 'Athletics' => 2, 'Survival' => 1, 'Climbing' => 2]
        ],
        'Noble' => [
            'description' => 'A member of the aristocracy with connections and privilege.',
            'items' => ['Sword(Choice)', 'Full Gambeson'],
            'money' => 100,
            'skills' => ['Martial' => 1, 'Command' => 3, 'Read/Write' => 3, 'Riding' => 2]
        ],
        'Nomad' => [
            'description' => 'A wandering traveler skilled in surviving in the wild.',
            'items' => ['Staff', 'Machete'],
            'money' => 20,
            'skills' => ['Spotting' => 2, 'Botany' => 2, 'Survival' => 3, 'Track' => 2, 'Animals' => 3]
        ],
        'Poacher' => [
            'description' => 'A secretive hunter skilled in illegal hunting practices.',
            'items' => ['Longbow and Quiver(20 Arrows)'],
            'money' => 40,
            'skills' => ['Ranged' => 3, 'Hide' => 1, 'Quiet' => 1, 'Survival' => 2, 'Track' => 3]
        ],
        'Physician' => [
            'description' => 'A skilled medical practitioner with knowledge of healing.',
            'items' => ['Dagger', 'First Aid Kit'],
            'money' => 60,
            'skills' => ['Assassination' => 1, 'First Aid' => 3, 'Read/Write(Choice)' => 3, 'Instrumentation' => 1]
        ],
        'Sailor' => [
            'description' => 'A seafarer with experience in navigating and surviving at sea.',
            'items' => ['Dagger', 'Rope(50ft)'],
            'money' => 50,
            'skills' => ['Spotting' => 2, 'Survival' => 2, 'Swim' => 3, 'Climb' => 2]
        ],
        'Slave' => [
            'description' => 'A person in bondage with a history of forced labor.',
            'items' => ['Dagger/Club(Choice)'],
            'money' => 0,
            'skills' => ['Hide' => 2, 'Quiet' => 3, 'Sleight' => 2, 'Disguise' => 2, 'Intrigue' => 1, 'Survival' => 2]
        ],
        'Slave Driver' => [
            'description' => 'A cruel overseer of slaves, skilled in control and intimidation.',
            'items' => ['Whip', 'Club'],
            'money' => 30,
            'skills' => ['Martial' => 2, 'Intimidate' => 3, 'Barter' => 1, 'Evaluate' => 1, 'Track' => 3]
        ],
        'Sorcerer' => [
            'description' => 'A practitioner of arcane magic with basic spellcasting abilities.',
            'items' => ['Staff', 'Artisans Kit'],
            'money' => 10,
            'skills' => ['Read/Write' => 3, 'Evocation' => 1, 'Attunement' => 1, 'Ritual' => 1]
        ],
        'Squire' => [
            'description' => 'A young knight-in-training with basic combat skills.',
            'items' => ['Weapon(Choice)', 'Sword(Choice)', 'Full Padded Cloth'],
            'money' => 25,
            'skills' => ['Martial' => 3, 'Ranged' => 1, 'Riding' => 2]
        ],
        'Troubadour' => [
            'description' => 'A minstrel and performer skilled in music and charm.',
            'items' => ['Dagger', 'Instrument(Choice)'],
            'money' => 35,
            'skills' => ['Charm' => 3, 'Intrigue' => 3, 'Listen' => 2, 'Performance' => 3]
        ],
        'Warrior Slave' => [
            'description' => 'A combatant who was enslaved, skilled in fighting and survival.',
            'items' => ['Weapon(Choice)', 'Great Helm', 'Scale Mail'],
            'money' => 0,
            'skills' => ['Martial' => 3, 'Intimidate' => 2, 'Survival' => 3]
        ]
    ];
    if (isset($backgrounds[$background])) {
        // Store selected background's items, money, and skills in session
        $_SESSION['items'] = $backgrounds[$background]['items'];
        $_SESSION['money'] = $backgrounds[$background]['money'];
        $_SESSION['skillsBG'] = $backgrounds[$background]['skills'];

        // Check if file exists and read existing JSON data
        if (file_exists($filename)) {
            $data = json_decode(file_get_contents($filename), true);
        } else {
            $data = []; // Initialize as empty array if file does not exist
        }

        // Update JSON data
        $data['background'] = $background;
        $data['items'] = $_SESSION['items'];
        $data['money'] = $_SESSION['money'];
        $data['skillsBG'] = $_SESSION['skillsBG'];

        // Save updated JSON data
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        // Redirect to the next page
        header('Location: skills.php');
    
        exit();
    }
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
												<h2>Backgrounds</h2>
												<p>Please select a background</p>
												
											</header>
<form action="" method="post"> <!-- Action should be current page to avoid redirection issues -->
        <label for="background">Select Background:</label>
        <select name="background" id="background" required>
            <option value="Acolyte">Acolyte</option>
            <option value="Alchemist">Alchemist</option>
            <option value="Assassin">Assassin</option>
            <option value="Banished">Banished</option>
            <option value="Bounty Hunter">Bounty Hunter</option>
            <option value="Craftsman">Craftsman</option>
            <option value="Criminal">Criminal</option>
            <option value="Cultist">Cultist</option>
            <option value="Deserter/Soldier">Deserter/Soldier</option>
            <option value="Deprived">Deprived</option>
            <option value="Diplomat">Diplomat</option>
            <option value="Executioner">Executioner</option>
            <option value="Farmer">Farmer</option>
            <option value="Fence">Fence</option>
            <option value="Fisherman">Fisherman</option>
            <option value="Grave Tender">Grave Tender</option>
            <option value="Guard">Guard</option>
            <option value="Herbalist">Herbalist</option>
            <option value="Herder">Herder</option>
            <option value="Hunter">Hunter</option>
            <option value="Marauder">Marauder</option>
            <option value="Mercenary">Mercenary</option>
            <option value="Merchant">Merchant</option>
            <option value="Miner">Miner</option>
            <option value="Noble">Noble</option>
            <option value="Nomad">Nomad</option>
            <option value="Poacher">Poacher</option>
            <option value="Physician">Physician</option>
            <option value="Sailor">Sailor</option>
            <option value="Slave">Slave</option>
            <option value="Slave Driver">Slave Driver</option>
            <option value="Sorcerer">Sorcerer</option>
            <option value="Squire">Squire</option>
            <option value="Troubadour">Troubadour</option>
            <option value="Warrior Slave">Warrior Slave</option>
        </select>
        <button type="submit">Choose Background</button>
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