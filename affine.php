<?php
//kodowanie
function affineEncode($stringToEncode, $a, $b){
    $affineDictionary = [
        'a' => 0,
        'b' => 1,
        'c' => 2,
        'd' => 3,
        'e' => 4,
        'f' => 5,
        'g' => 6,
        'h' => 7,
        'i' => 8,
        'j' => 9,
        'k' => 10,
        'l' => 11,
        'm' => 12,
        'n' => 13,
        'o' => 14,
        'p' => 15,
        'q' => 16,
        'r' => 17,
        's' => 18,
        't' => 19,
        'u' => 20,
        'v' => 21,
        'w' => 22,
        'x' => 23,
        'y' => 24,
        'z' => 25,
    ];
    $punctuationDictionary =[
     ',' => ',',
     '.' => '.',
     ';' => ';',
     ':' => ':',
     '!' => '!',
     '?' => '?',
    ];
    $affineDictionaryFlipped = array_flip($affineDictionary);

    $affineParts = explode(' ', $stringToEncode);
    for($i = 0; $i < count($affineParts); $i++){
        $affinePart = str_split(strtolower($affineParts[$i]));
        foreach ($affinePart as $affineElement) {
                if (array_key_exists($affineElement, $affineDictionary)) {
                    $encodedIntElement = ($a * $affineDictionary[$affineElement] + $b) % 26;
                }
                //przypisanie wartości dla znaku interpunkcyjnego
                else if (array_key_exists($affineElement, $punctuationDictionary)){
                    $encodedIntElement = $affineElement;
                }
                //kodowanie:
                if (array_key_exists($encodedIntElement, $affineDictionaryFlipped)) {
                    $encodedCharElement = $affineDictionaryFlipped[$encodedIntElement];
                    echo $encodedCharElement;
                }
                //kodowanie znaków interpunkcyjnych
                else if(array_key_exists($encodedIntElement, $punctuationDictionary)) {
                    $encodedCharElement = $punctuationDictionary[$encodedIntElement];
                    echo $encodedCharElement;
                }

        }
        echo ' ';
    }
}
//rozkodowanie
function affineDecode($stringToDecode, $a, $b){
    $affineDictionary = [
        'a' => 0,
        'b' => 1,
        'c' => 2,
        'd' => 3,
        'e' => 4,
        'f' => 5,
        'g' => 6,
        'h' => 7,
        'i' => 8,
        'j' => 9,
        'k' => 10,
        'l' => 11,
        'm' => 12,
        'n' => 13,
        'o' => 14,
        'p' => 15,
        'q' => 16,
        'r' => 17,
        's' => 18,
        't' => 19,
        'u' => 20,
        'v' => 21,
        'w' => 22,
        'x' => 23,
        'y' => 24,
        'z' => 25
    ];
    $punctuationDictionary =[
        ',' => ',',
        '.' => '.',
        ';' => ';',
        ':' => ':',
        '!' => '!',
        '?' => '?'
    ];
    //deklaracja elementów przeciwnych do klucza kodowania $a w Z26
    $oppositeElements = [
        1 => 1,
        3 => 9,
        5 => 21,
        7 => 15,
        9 => 3,
        11 => 19,
        15 => 7,
        17 => 23,
        19 => 11,
        21 => 5,
        23 => 17,
        25 => 25
    ];
    $affineDictionaryFlipped = array_flip($affineDictionary);
    //ustawienie elementu przeciwnego do $oppositeA

    for ($i = 1; $i<=25; $i++){
        if ($a == $i){
            $oppositeA = $oppositeElements[$i];
            break;
        }
    }
    //echo $oppositeA;
    $affineParts = explode(' ', $stringToDecode);
    for($i = 0; $i < count($affineParts); $i++){
        $affinePart = str_split(strtolower($affineParts[$i]));
        foreach ($affinePart as $affineElement) {
            if (array_key_exists($affineElement, $affineDictionary)) {
                $encodedIntElement = ($oppositeA * ($affineDictionary[$affineElement] - $b)) % 26;
            }
            //przypisanie wartości dla znaku interpunkcyjnego
            else if (array_key_exists($affineElement, $punctuationDictionary)){
                $encodedIntElement = $affineElement;
            }
            //kodowanie:
            if (array_key_exists($encodedIntElement, $affineDictionaryFlipped)) {
                $encodedCharElement = $affineDictionaryFlipped[$encodedIntElement];
                echo $encodedCharElement;
            }
            //kodowanie znaków interpunkcyjnych
            else if(array_key_exists($encodedIntElement, $punctuationDictionary)) {
                $encodedCharElement = $punctuationDictionary[$encodedIntElement];
                echo $encodedCharElement;
            }

        }
        echo ' ';
    }
}
affineEncode('veni', 7, 5);
echo "\n";
affineDecode('whsj!!!', 7, 5);
?>
