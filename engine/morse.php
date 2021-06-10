<?php
function stringToMorse($string) {
    $stringParts = str_split(strtolower($string));

    $morseDictionary = [
        'a' => '.-',
        'b' => '-...',
        'c' => '-.-.',
        'd' => '-..',
        'e' => '.',
        'f' => '..-.',
        'g' => '--.',
        'h' => '....',
        'i' => '..',
        'j' => '.---',
        'k' => '-.-',
        'l' => '.-..',
        'm' => '--',
        'n' => '-.',
        'o' => '---',
        'p' => '.--.',
        'q' => '--.-',
        'r' => '.-.',
        's' => '...',
        't' => '-',
        'u' => '..-',
        'v' => '...-',
        'w' => '.--',
        'x' => '-..-',
        'y' => '-.--',
        'z' => '--..',
        '0' => '-----',
        '1' => '.----',
        '2' => '..---',
        '3' => '...--',
        '4' => '....-',
        '5' => '.....',
        '6' => '-....',
        '7' => '--...',
        '8' => '---..',
        '9' => '----.',
        '.' => '.-.-.-',
        ',' => '--..--',
        '?' => '..--..',
        '/' => '-..-.',
        ' ' => ' ',
    ];

    $morse = '';
    foreach ($stringParts as $stringPart) {
        if (array_key_exists($stringPart, $morseDictionary)) {
            $morse .= $morseDictionary[$stringPart] . ' ';
        }
    }
    return $morse;
}
function morseToString($morseCode){
    $morseParts = explode('     ', $morseCode);
    $morseDictionary = [
        '.-' => 'a',
        '-...' => 'b',
        '-.-.' => 'c',
        '-..' => 'd',
        '.' => 'e',
        '..-.' => 'f',
        '--.' => 'g',
        '....' => 'h',
        '..' => 'i',
        '.---' => 'j',
        '-.-' => 'k',
        '.-..' => 'l',
        '--' => 'm',
        '-.' => 'n',
        '---' => 'o',
        '.--.' => 'p',
        '--.-' => 'q',
        '.-.' => 'r',
        '...' => 's',
        '-' => 't',
        '..-' => 'u',
        '...-' => 'v',
        '.--' => 'w',
        '-..-' => 'x',
        '-.--' => 'y',
        '--..' => 'z',
        '-----' => '0',
        '.----' => '1',
        '..---' => '2',
        '...--' => '3',
        '....-' => '4',
        '.....' => '5',
        '-....' => '6',
        '--...' => '7',
        '---..' => '8',
        '----.' => '9',
        '.-.-.-' => '.',
        '--..--' => ',',
        '..--..' => '?',
        '-..-.' => '/',
    ];

    for($i = 0; $i < count($morseParts); $i++){
        $morsePart = explode(' ', $morseParts[$i]);
        foreach ($morsePart as $morseElement) {
            if (array_key_exists($morseElement, $morseDictionary)) {
                echo $morseDictionary[$morseElement];
            }
        }
        echo ' ';
    }
}
echo stringToMorse("ala, ma kota")."\n";
echo stringToMorse("mama mnie bardzo lubi")."\n";
echo morseToString(".... --- .--.     ..--..")."\n";
morseToString("-- .- -- .-     -- -. .. .     -... .- .-. -.. --.. ---     .-.. ..- -... ..     .-.-.-");
?>
