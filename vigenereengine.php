<?php
function vigenereEncode($key, $stringToEncode)
{
    $keyindex = 0;
    $keylength = strlen($key);
    $stringlength = strlen($stringToEncode);

    $key = strtolower($key);
    $stringToEncode = strtolower($stringToEncode);

    // przeszukanie textu
    for ($i = 0; $i < $stringlength; $i++)
    {
        // zakodowanie znaku jeżeli jest literą(dla znaku interpumkcyjnego nie zakoduje go). znak klucza i znak tekstu dodawane są modulo 26
        if (ctype_alpha($stringToEncode[$i]))
        {
            if (ctype_lower($stringToEncode[$i]))
            {
                $stringToEncode[$i] = chr(((ord($key[$keyindex]) - ord('a') + ord($stringToEncode[$i]) - ord('a')) % 26) + ord('a'));
            }

            // update pozycji w kluczu i ew zerowanie
            $keyindex++;
            if ($keyindex >= $keylength)
            {
                $keyindex = 0;
            }
        }

    }
    return $stringToEncode;
}

function vigenereDecode($key, $stringToDecode)
{
    $keyindex = 0;
    $keylength = strlen($key);
    $stringlength = strlen($stringToDecode);

    $key = strtolower($key);
    $stringToDecode= strtolower($stringToDecode);

    // przeszukanie textu
    for ($i = 0; $i < $stringlength; $i++)
    {
        // odkodowanie znaku jeżeli jest literą
        if (ctype_alpha($stringToDecode[$i]))
        {
            if (ctype_lower($stringToDecode[$i]))
            {
                $temp = (ord($stringToDecode[$i]) - ord($key[$keyindex]) + 26)%26;
                $temp+=ord("a");
            }
            $stringToDecode[$i] = chr($temp);

            // update pozycji w kluczu i ew zerowanie
            $keyindex++;
            if ($keyindex >= $keylength)
            {
                $keyindex = 0;
            }
        }

    }
    return $stringToDecode;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Szyfr Vigenere'a</title>
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
  <a class="navbar-brand" >Szyfr Vigenere'a</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php" >Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="morse.php">Kod Morse'a</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="affine.php">Szyfr afiniczny</a>
    </li>
  </ul>
</nav>
<div class="container-fluid" style="margin-top:150px">
  <div class="container" style="margin-top: 10%">
      <div class="row">
        <div class="col-sm-4" style="padding-bottom: 20px; background-color: rgba(176,185,196,0.5); height: 70%">
            <form method = "POST" action="vigenereengine.php" name="text" enctype="multipart/form-data">
                <label for="tocode">Wpisz text:</label>
                <textarea id="text" name="tocode" rows="20" style="width: 100%; height: 100%; background-color: rgba(0,126,194,0.1)">
<?php
    if(array_key_exists('code', $_POST)){
    $texttocode = $_POST['tocode'];
    echo $texttocode;
}
else if(array_key_exists('decode', $_POST)){
    $texttocode = $_POST['tocode'];
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
                                        <li><input type="text" required size=10px name="key" placeholder="klucz"></li>
                                    </div> 
                                    <li class="nav-item">
                                        <input type="submit" name="code" value="Zakoduj" style="color: blue; background-color: rgba(0,0,0,0); border: none;">
                                    </li>
                                    <li class="nav-item">
                                        <input type="submit" name="decode" value="Dekoduj" style="color: blue; background-color: rgba(0,0,0,0); padding-top: 10px; border: none">
                                    </li>  
                                    <li class="nav-item">
                                        <a download= "vigenere.txt" href ="vigenere.txt">Pobierz plik</a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="vigenere.php" style="color: blue; text-decoration: none">Powrót</a>
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
    $key = $_POST['key'];
    $texttocode = $_POST['tocode'];
    $vigenere = vigenereEncode($key, $texttocode);
        $fd = fopen('vigenere.txt', 'w');
        fwrite($fd, $vigenere);
        fclose($fd);
        echo $vigenere;
}
else if(array_key_exists('decode', $_POST)){
    $key = $_POST['key'];
    $texttocode = $_POST['tocode'];
    $vigenere = vigenereDecode($key, $texttocode);
        $fd = fopen('vigenere.txt', 'w');
        fwrite($fd, $vigenere);
        fclose($fd);
        echo $vigenere; 
}
?></textarea>  
                    </form>
                   </div>
      </div>
  </div>
</div>
</body>
</html>