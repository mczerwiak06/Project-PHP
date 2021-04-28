<?php
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
affineEncode('veni, vidi, vici!', 3, 12);
?>
