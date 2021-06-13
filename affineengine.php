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
    $result='';
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
                    $result .= $encodedCharElement;
                }
                //kodowanie znaków interpunkcyjnych
                else if(array_key_exists($encodedIntElement, $punctuationDictionary)) {
                    $encodedCharElement = $punctuationDictionary[$encodedIntElement];
                    //echo $encodedCharElement;
                    $result .= $encodedCharElement;
                }
        }
        $result .= ' ';
    }
    return $result;
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
    $affineParts = explode(' ', $stringToDecode);
    $result = '';
    for($i = 0; $i < count($affineParts); $i++){
        $affinePart = str_split(strtolower($affineParts[$i]));
        foreach ($affinePart as $affineElement) {
            if (array_key_exists($affineElement, $affineDictionary)) {

                $encodedIntElement = ($oppositeA * ($affineDictionary[$affineElement] - $b)) % 26;
                    if($encodedIntElement < 0){
                        $encodedIntElement += 26;
                    }
            }
            //przypisanie wartości dla znaku interpunkcyjnego
            else if (array_key_exists($affineElement, $punctuationDictionary)){
                $encodedIntElement = $affineElement;
            }
            //kodowanie:
            if (array_key_exists($encodedIntElement, $affineDictionaryFlipped)) {
                $encodedCharElement = $affineDictionaryFlipped[$encodedIntElement];
                $result .= $encodedCharElement;
            }
            //kodowanie znaków interpunkcyjnych
            else if(array_key_exists($encodedIntElement, $punctuationDictionary)) {
                $encodedCharElement = $punctuationDictionary[$encodedIntElement];
                $result .= $encodedCharElement;
            }
        }
        $result .= ' ';
    }
    return $result;
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
          echo "Nie wybrałeś pliku.";
        }
      }
if (isset($_POST['download'])){
    $url = './files/decodedtext.txt';
    $file_name = basename($url);
    if(file_put_contents( $file_name,file_get_contents($url))) {
    echo "File downloaded successfully";
}
else {
    echo "File downloading failed.";
}
}
?>
                </textarea>
                    </div>
                    <div class="col-sm-4" style="padding-bottom: 20px; background-color: rgba(176,185,196,0.5); padding-top: 5%">

                            <div class = "action">
                                  <ul class="navbar-nav">
                                    <div class="select">
                                        <p>Podaj klucz:</p>
                                        <li><input type="text" required size=1px list="selecta" name="selecta" placeholder="a"></li>
                                            <datalist id="selecta">
                                                <option value="1"></option>
                                                <option value="3"></option>
                                                <option value="5"></option>
                                                <option value="7"></option>
                                                <option value="9"></option>
                                                <option value="11"></option>
                                                <option value="15"></option>
                                                <option value="17"></option>
                                                <option value="19"></option>
                                                <option value="21"></option>
                                                <option value="23"></option>
                                                <option value="25"></option>
                                            </datalist> 
                                        <li><input type="text" required size=1px list="selectb" name="selectb" placeholder="b"></li>
                                            <datalist id="selectb">
                                                <option value="1"></option>
                                                <option value="2"></option>
                                                <option value="3"></option>
                                                <option value="4"></option>
                                                <option value="5"></option>
                                                <option value="6"></option>
                                                <option value="7"></option>
                                                <option value="8"></option>
                                                <option value="9"></option>
                                                <option value="10"></option>
                                                <option value="11"></option>
                                                <option value="12"></option>
                                                <option value="13"></option>
                                                <option value="14"></option>
                                                <option value="15"></option>
                                                <option value="16"></option>
                                                <option value="17"></option>
                                                <option value="18"></option>
                                                <option value="19"></option>
                                                <option value="20"></option>
                                                <option value="21"></option>
                                                <option value="23"></option>
                                                <option value="24"></option>
                                                <option value="25"></option>
                                                <option value="26"></option>
                                            </datalist> 
                                    </div> 
                                    <li class="nav-item">
                                        <input type="submit" name="code" value="Zakoduj" style="color: blue; background-color: rgba(0,0,0,0); border: none;">
                                    </li>
                                    <li class="nav-item">
                                        <input type="submit" name="decode" value="Dekoduj" style="color: blue; background-color: rgba(0,0,0,0); padding-top: 10px; border: none">
                                    </li>  
                                    <li class="nav-item">
                                        <input type="submit" name="download" value="Pobierz plik" style="color: blue; background-color: rgba(0,0,0,0); padding-top: 10px; padding-bottom: 10px; border: none;">
                                    </li>
                                    <li class="nav-item">
                                        <a href="morse.php" style="color: blue; text-decoration: none">Powrót</a>
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
        $fd = fopen('./files/codedtext.txt', 'w');
        fwrite($fd, $morse);
        fclose($fd);
        echo $morse;
}
else if(array_key_exists('decode', $_POST)){
    $texttocode = $_POST['tocode']. PHP_EOL;
    $morse = morseToString($texttocode);
        $fd = fopen('./files/decodedtext.txt', 'w');
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