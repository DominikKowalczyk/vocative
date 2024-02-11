<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Counts</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #d4d4d4; /* Adjusted text color */
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the container horizontally */
        }

        h2 {
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 600px; /* Limit the maximum width of the container */
            width: 100%;
        }

        .case {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Align items vertically in each case row */
            padding: 10px;
            background-color: #333333;
            border-radius: 5px;
            width: 100%; /* Ensure full width */
        }

        .case-name {
            font-weight: bold;
            flex: 2; /* Set the case name column to occupy more space */
            padding-left: 10px; /* Add left padding for readability */
        }

        .count {
            color: #aaaaaa; /* Adjusted count color */
            min-width: 50px; /* Set minimum width for count */
            text-align: center; /* Center count text */
            flex: 1; /* Set the count column to occupy less space */
            padding-right: 10px; /* Add right padding for readability */
        }
    </style>
</head>
<body>
    <h2>Case Counts</h2>
    <div class="container">
        <?php
        // Initialize counters for each case
        $casesCount = [
            "Name_ends_with_a" => 0,
            "Name_ends_with_k" => 0,
            "Name_ends_with_j" => 0,
            "Name_ends_with_l" => 0,
            "Name_ends_with_z" => 0,
            "Name_ends_with_h" => 0,
            "Name_ends_with_ś" => 0,
            "Name_ends_with_n" => 0,
            "Name_ends_with_w" => 0,
            "Name_ends_with_f" => 0,
            "Name_ends_with_s" => 0,
            "Name_ends_with_t_without_s" => 0,
            "Name_ends_with_t_with_s" => 0,
            "Name_ends_with_y" => 0,
            "Name_ends_with_i" => 0,
            "Name_ends_with_d" => 0,
            "Name_ends_with_r" => 0,
            "Default" => 0,
        ];

        function toVocative($name, &$casesCount)
        {
            $length = mb_strlen($name, 'UTF-8');
            $lastChar = mb_substr($name, -1, 1, 'UTF-8');
            $secondLastChar = mb_substr($name, -2, 1, 'UTF-8');

            // Determine vocative form based on rules
            if ($length > 3 && $lastChar == "a") {
                $casesCount["Name_ends_with_a"]++;
                return mb_substr($name, 0, -1, 'UTF-8') . "o";
            } else {
                // Masculine names 
                if ($lastChar == "k") {
                    if ($secondLastChar == "e") {
                        $casesCount["Name_ends_with_k"]++;
                        return mb_substr($name, 0, -2, 'UTF-8') . "ku";
                    }
                    $casesCount["Name_ends_with_k"]++;
                    return $name . "u";
                }
                if ($lastChar == "j") {
                    $casesCount["Name_ends_with_j"]++;
                    return $name . "u";
                } else if ($lastChar == "l") {
                    $casesCount["Name_ends_with_l"]++;
                    return $name . "u";
                } else if ($lastChar == "z") {
                    $casesCount["Name_ends_with_z"]++;
                    return $name . "u";
                } else if ($lastChar == "h") {
                    $casesCount["Name_ends_with_h"]++;
                    return $name . "u";
                } else if ($lastChar == "ś") {
                    $casesCount["Name_ends_with_ś"]++;
                    return $name . "u";
                } else if ($lastChar == "n") {
                    $casesCount["Name_ends_with_n"]++;
                    return $name . "ie";
                } else if ($lastChar == "w") {
                    $casesCount["Name_ends_with_w"]++;
                    return $name . "ie";
                } else if ($lastChar == "f") {
                    $casesCount["Name_ends_with_f"]++;
                    return $name . "ie";
                } else if ($lastChar == "s") {
                    $casesCount["Name_ends_with_s"]++;
                    return $name . "ie";
                } else if ($lastChar == "t") {
                    $casesCount["Name_ends_with_t_without_s"]++;
                    if ($secondLastChar == "s") {
                        $casesCount["Name_ends_with_t_with_s"]++;
                        return mb_substr($name, 0, -2, 'UTF-8') . "ście";
                    } else {
                        return mb_substr($name, 0, -1, 'UTF-8') . "cie";
                    }
                } else if ($lastChar == "y") {
                    $casesCount["Name_ends_with_y"]++;
                    return $name;
                } else if ($lastChar == "i") {
                    $casesCount["Name_ends_with_i"]++;
                    return $name;
                } else if ($lastChar == "d") {
                    $casesCount["Name_ends_with_d"]++;
                    return $name . "zie";
                } else if ($lastChar == "r") {
                    $casesCount["Name_ends_with_r"]++;
                    return $name . "zie";
                } else {
                    $casesCount["Default"]++;
                    return $name;
                }
            }
        }

        // Usage
        $jsonContent = file_get_contents('./polishnames.json');
        $data = json_decode($jsonContent, true);

        foreach ($data['male'] as $name) {
            toVocative($name, $casesCount);
        }

        // Sort the casesCount array in descending order of counts
        arsort($casesCount);

        // Output case counts
        foreach ($casesCount as $case => $count) : ?>
            <div class="case">
                <span class="case-name"><?= str_replace('_', ' ', $case) ?></span>
                <span class="count"><?= $count ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
