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
        // zakodowanie znaku jeżeli jest literą(dla znaku interpumkcyjnego nie zakoduje go)
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
    echo $stringToEncode;
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
               $temp = (ord($stringToDecode[$i]) - ord("a")) - (ord($key[$keyindex]) - ord("a"));
               //do wyniku dodaje liczbę liter w alfabecie jeżeli wynik ujemny
               if ($temp < 0 ){
                   $temp +=26;
               }
               $temp+=ord('a');
               $stringToDecode[$i] = chr($temp);
            }

            // update pozycji w kluczu i ew zerowanie
            $keyindex++;
            if ($keyindex >= $keylength)
            {
                $keyindex = 0;
            }
        }

    }
    echo $stringToDecode;
}
vigenereEncode('cipher', 'cryptology, cryptology');
echo "\n";
vigenereDecode('cipher', 'eznwxfnwvf, giaxivpfig');
?>
