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
        ' ' => '   ',
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
    $morse = '';
    for($i = 0; $i < count($morseParts); $i++){
        $morsePart = explode(' ', $morseParts[$i]);
        foreach ($morsePart as $morseElement) {
            if (array_key_exists($morseElement, $morseDictionary)) {
                $morse .= $morseDictionary[$morseElement];
            }
        }
        $morse .= ' ';
    }
    return $morse;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Kod Morse'a</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/pages.css">
  <link rel="stylesheet" href="css/textarea.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="height:1000px; background-image: url(img/greybackground.jpg)">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="background-color: darkgray">
  <a class="navbar-brand" >Kod Morse'a</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php" >Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="affine.php">Szyfr afiniczny</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="vigenere.php">Szyfr Vigenere'a</a>
    </li>
  </ul>
</nav>
<div class="container-fluid" style="margin-top:150px">
  <div class="container" style="margin-top: 10%">
      <div class="row">
        <div class="col-sm-4" style="padding-bottom: 20px; background-color: rgba(176,185,196,0.5); height: 70%">
            <form method = "POST" action="morseengine.php" name="text" enctype="multipart/form-data">
                <label for="tocode">Wpisz text:</label>
                <textarea id="text" name="tocode" rows="20" style="width: 100%; height: 100%; background-color: rgba(0,126,194,0.1)">
<?php
    if(array_key_exists('code', $_POST)){
    $texttocode = $_POST['tocode']. PHP_EOL;
    echo $texttocode;
}
else if(array_key_exists('decode', $_POST)){
    $texttocode = $_POST['tocode']. PHP_EOL;
    echo $texttocode; 
}
if (isset($_POST['readfile'])) {
    $currentDirectory = getcwd();
    $uploadDirectory = "./uploads/";
    $fileName = $_FILES['the_file']['name'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
          $fd = fopen('./uploads/'.$fileName, 'r');
          $textfromfile = fgets($fd);
            fclose($fd);
          echo $textfromfile;
        } else {
          echo "Nie wybra??e?? pliku.";
        }
      }

?>
                </textarea>
                    </div>
                    <div class="col-sm-4" style="padding-bottom: 20px; background-color: rgba(176,185,196,0.5); padding-top: 10%">

                            <div class = "action">
                                  <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <input type="submit" name="code" value="Zakoduj" style="color: blue; background-color: rgba(0,0,0,0); border: none;">
                                    </li>
                                    <li class="nav-item">
                                        <input type="submit" name="decode" value="Dekoduj" style="color: blue; background-color: rgba(0,0,0,0); padding-top: 10px; border: none">
                                    </li>  
                                    <li class="nav-item">
                                        <a download= "morse.txt" href ="morse.txt">Pobierz plik</a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="morse.php" style="color: blue; text-decoration: none">Powr??t</a>
                                    </li>
                                  </ul>            
                            </div>
                    </div>   
            </form>
                  <div class="col-sm-4" style=" padding-bottom: 20px; background-color: rgba(176,185,196,0.5); height: 70%">
                    <form method = "post" action=# name="text">
                        <label for="story">Wynik:</label>
                        <textarea id="text" name="tocode" rows="20" style="width: 100%; height: 100%; background-color: rgba(0,126,194,0.1)"><?php
    if(array_key_exists('code', $_POST)){
    $texttocode = $_POST['tocode']. PHP_EOL;
    $morse = stringToMorse($texttocode);
        $fd = fopen('morse.txt', 'w');
        fwrite($fd, $morse);
        fclose($fd);
        echo $morse;
}
else if(array_key_exists('decode', $_POST)){
    $texttocode = $_POST['tocode'];
    $morse = morseToString($texttocode);
        $fd = fopen('morse.txt', 'w');
        fwrite($fd, $morse);
        fclose($fd);
        echo $morse; 
}
?></textarea>  
                    </form>
                   </div>
      </div>
  </div>
</div>
</body>
</html>