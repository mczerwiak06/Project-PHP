<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Szyfr afiniczny</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/pages.css">
  <link rel="stylesheet" href="css/textarea.css">
  <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="height:1000px; background-image: url(img/greybackground.jpg)">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="background-color: darkgray">
  <a class="navbar-brand" >Szyfr afiniczny</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php" >Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="morse.php">Kod Morse'a</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="vigenere.php">Szyfr Vigenere'a</a>
    </li>
  </ul>
</nav>
<div class="container-fluid" style="margin-top:150px">
  <div class="container" style="margin-top: 10%">
      <div class="row">
        <div class="col-sm-4" style=" padding-bottom: 20px; background-color: rgba(176,185,196,0.5); height: 70%">
            <form method = "POST" action="affineengine.php" name="text" enctype="multipart/form-data">
                            <label for="story">Wpisz text:</label>
                            <textarea id="text" name="tocode" rows="20"
                                 style="width: 100%; height: 100%; background-color: rgba(0,126,194,0.1)"></textarea>
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
                                        <label for="the_file" style="color: blue; padding-top: 10px;">Wybierz plik txt</label>  
                                        <input type="file" name="the_file" id="the_file" style="display: none">
                                    </li>
                                    <li class="nav-item">
                                        <input type="submit" name="readfile" value="Wczytaj plik" style="color: blue; background-color: rgba(0,0,0,0); padding-top: 5px; border: none">
                                    </li>
                                  </ul>            
                            </div>
                    </div>
            </form>
                  <div class="col-sm-4" style=" padding-bottom: 20px; background-color: rgba(176,185,196,0.5); height: 70%">
                    <form method = "post" action=# name="text">
                        <label for="story">Wynik:</label>
                        <textarea id="text" name="tocode" rows="20"
                                 style="width: 100%; height: 100%; background-color: rgba(0,126,194,0.1)"></textarea>  
                    </form>
                   </div> 
      </div>
  </div>
</div>
</body>
</html>
