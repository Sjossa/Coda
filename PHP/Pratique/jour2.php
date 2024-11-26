<?php
echo "- if - <br>";

$note = 0;

if ($note >= 0 && $note < 10) {
    echo "insuffisant";
} elseif ($note >= 10 && $note < 12) {
    echo "bien";
} elseif ($note >= 12) {
    echo "très bien";
} else {
    echo "Note invalide";
}

echo "<br> - switch - <br>";

$code = "403";


switch ($code) {
    case '200':
        echo 'succès';
        break;
    case '400':
        echo 'bad request';
        break;
    case '500':
        echo 'erreur interne';
        break;
    case '403':
        echo 'forbidden';
        break;
    default:
        echo 'erreur inconnue';
        break;
}

echo "<br> - switch avec tableau - <br>";


$errorCodes = [200, 400, 500, 403];
shuffle($errorCodes);



switch ($errorCodes[0]) {
    case 200:
        echo "succès";
        break;
    case 400:
        echo "bad request";
        break;
    case 500:
        echo "erreur interne";
        break;
    case 403:
        echo "forbidden";
        break;
    default:
        echo "erreur inconnue";
        break;
}

echo "<br> - Les fonction - <br>";



function email($mail)
{
    $caractere = '@';

    if (strpos($mail, $caractere) !== false) {
        echo "Le caractère '$caractere' a été trouvé.";
    } else {
        echo "Le caractère n'a pas été trouvé.";
    }
}
$mail = 'johnnysfgrgergtreg@gmail.com';
echo email($mail);

?>
