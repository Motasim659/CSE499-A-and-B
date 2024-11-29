<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medi Support</title>
    <link rel="stylesheet" href="Search.css">
    
</head>
<body>
    <!-- Header with Navbar -->
    <header>
        <nav>
            <ul>
                <li class="name">
                    <img src="Logo.png.png" alt="Logo">
                    Medi Support
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <div class="img-part">
            <img src="hospital-clinic-building-3d-icon-illustration-png.webp" alt="Hospital Image">
        </div>
        <h1>Search for Diseases</h1>

        <!-- Search Form -->
        <div class="search-box">
            <form method="POST" action="">
                <input type="text" id="symptoms" placeholder="Enter Symptoms" name="symptoms" required>
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- PHP for Search Results -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get symptoms entered by the user, trim whitespace, and convert to lowercase
            $userSymptoms = array_map('trim', explode(",", strtolower($_POST['symptoms'])));
            
            // Path to the  file
            $filePath = "Diseases_Symptoms.csv";
            
            // Array to store matching results
            $matches = [];
            
            // Check if the CSV file exists and is readable
            if (file_exists($filePath) && is_readable($filePath)) {
                // Open the CSV file
                if (($file = fopen($filePath, "r")) !== FALSE) {
                    // Skip the header row
                    $header = fgetcsv($file);

                    // Search through each row
                    while (($row = fgetcsv($file)) !== FALSE) {
                        list($code, $name, $symptoms, $treatments) = $row;

                        // Convert the CSV symptoms to a comparable array
                        $diseaseSymptoms = array_map('trim', explode(",", strtolower($symptoms)));

                        // Check if any user symptom matches disease symptoms
                        $matchesSymptoms = array_intersect($userSymptoms, $diseaseSymptoms);

                        if (count($matchesSymptoms) > 0) {  // Display if at least one symptom matches
                            $matches[] = [
                                'name' => $name,
                                'symptoms' => $symptoms,
                                'treatments' => $treatments
                            ];
                        }
                    }

                    // Close the file after reading
                    fclose($file);
                } else {
                    echo "<div class='info-box'><p style='color: red;'>Error opening the file. Please try again later.</p></div>";
                }
            } else {
                echo "<div class='info-box'><p style='color: red;'>Data file not found. Please contact support.</p></div>";
            }

            // Display results
            if (!empty($matches)) {
                echo "<div class='info-box'><h2>Search Results</h2>";
                foreach ($matches as $match) {
                    echo "<h3>Disease: " . htmlspecialchars($match['name']) . "</h3>"; 
                    echo "<h4>Symptoms:</h4><p>" . htmlspecialchars($match['symptoms']) . "</p>";
                    echo "<h4 style='color: green;'>Treatments:</h4><p style='color: green;'>" . htmlspecialchars($match['treatments']) . "</p><hr>";
                }
                echo "</div>";
            } else {
                echo "<div class='info-box'><p style='color: red;'>No diseases found matching those symptoms.</p></div>";
            }
        }
        ?>
    </main>
</body>
</html>
