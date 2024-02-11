<?php

function toVocative($name)
{
    $length = strlen($name);
    $lastChar = substr($name, -1);
    $secondLastChar = substr($name, -2,   1);
    // Exceptions
    if ($name == "tata" || $name == "Tata") return ["vocative" => "tato", "gender" =>  0];
    if ($name == "ciocia" || $name == "Ciocia") return ["vocative" => "ciociu", "gender" =>  1];
    if ($name == "mamusia" || $name == "Mamusia") return ["vocative" => "mamusiu", "gender" =>  1];
    if ($name == "babcia" || $name == "Babcia") return ["vocative" => "babciu", "gender" =>  1];
    if ($name == "Kosma") return ["vocative" => "Kosmo", "gender" =>  0];

    // Determine gender based on length and last character
    if ($length > 3 && $lastChar == "a") {
        // Feminine names ending in "-a"
        return ["vocative" => substr($name,   0, -1) . "o", "gender" => 1];
    } else if ($length = 3 && $lastChar == "a") {
        return ["vocative" => substr($name,   0, -1) . "u", "gender" => 1];
    } else {
        // Masculine names 
        if ($lastChar == "k") {
            if ($secondLastChar == "e") {
                return ["vocative" => substr($name,   0, -2) . "ku", "gender" => 0];
            }
            return ["vocative" => $name . "u", "gender" => 0];
        }
        if ($lastChar == "j" || $lastChar == "l" || $lastChar == "z" || $lastChar == "h" || $lastChar == "ś") {
            return ["vocative" => $name . "u", "gender" => 0];
        } else if ($lastChar == "n" || $lastChar == "w" || $lastChar == "f" || $lastChar == "s") {
            return ["vocative" => $name . "ie", "gender" => 0];
        } else if ($lastChar == "t") {
            if ($secondLastChar == "s") {
                return ["vocative" => substr($name,   0, -2) . "ście", "gender" => 0];
            } else {
                return ["vocative" => substr($name,   0, -1) . "cie", "gender" => 0];
            }
        } else if ($lastChar == "y" || $lastChar == "i") {
            return ["vocative" => $name, "gender" => 0];
        } else if ($lastChar == "d") {
            return ["vocative" => $name . "zie", "gender" => 0];
        } else if ($lastChar == "r") {
            if ($secondLastChar == "e") {
                return ["vocative" => substr($name,   0, -2) . "rze", "gender" => 0];
            } else {
                return ["vocative" => substr($name,   0, -1) . "rze", "gender" => 0];
            }
        } else {
            return ["vocative" => $name, "gender" => 0];
        }
    }
}

function greetPolitely($name)
{
    $vocativeData = toVocative($name);
    $gender = $vocativeData['gender'];
    $vocative = $vocativeData['vocative'];
    if ($gender) {
        return "Szanowna Pani $vocative,";
    } else {
        return "Szanowny Panie $vocative,";
    }
}

// Usage
$jsonContent = file_get_contents('./polishnames.json');
$data = json_decode($jsonContent, true);

foreach ($data['male'] as $name) {
    echo greetPolitely($name) . "<br><hr>\n";
}

foreach ($data['female'] as $name) {
    echo greetPolitely($name) . "<br><hr>\n";
}
