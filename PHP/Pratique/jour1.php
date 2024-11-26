<?php

$months = [
    "janvier" => ["jours" => 31, "saison" => "hiver"],
    "fevrier" => ["jours" => 28, "saison" => "hiver"],
    "mars" => ["jours" => 31, "saison" => "printemps"],
    "avril" => ["jours" => 30, "saison" => "printemps"],
    "mai" => ["jours" => 31, "saison" => "printemps"],
    "juin" => ["jours" => 30, "saison" => "printemps"],
    "juillet" => ["jours" => 31, "saison" => "été"],
    "aout" => ["jours" => 31, "saison" => "été"],
    "septembre" => ["jours" => 30, "saison" => "automne"],
    "octobre" => ["jours" => 31, "saison" => "automne"],
    "novembre" => ["jours" => 30, "saison" => "automne"],
    "décembre" => ["jours" => 31, "saison" => "hiver"]
];


// var_dump($months);
// echo  $months[0];

echo " nombre de jour : {$months['septembre']['jours']} saison: {$months['septembre']['saison']}";

foreach ($months as $key => $value) {
    echo "mois:  $key nbres de jours:  {$value["jours"]} saison{$value['saison']} <br>";
}

for ($i = 1; $i < 11; $i++) {
    $res = $i * 2;
    echo "$i X 2 = {$res} <br>";
}
?>