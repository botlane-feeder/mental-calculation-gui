<?php

/** Déterminer les niveaux des équations : 
 * 1 : 
 *   - "+" et "-" sont disponibles
 *   - 3 * plus d'additions que de soustactions 
 *   - limites 1 à 10
 *   - aucun nombre négatifs
 * 2 : 
 *   - "+" et "-" sont disponibles
 *   - 2 * plus d'additions que de soustactions 
 *   - limites 1 à 30
 *   - aucun nombre négatifs
 * 3 :
 *   - "+" et "-" sont disponibles
 *   - autant d'additions que de soustactions 
 *   - limites 1 à 50
 *   - aucun nombre négatifs
 * 4 :
 *   - "+", "-", "*" sont disponibles
 *   - 3 d'additions pour 2 soustactions pour 1 multiplication
 *   - limites 1 à 30 pour les "+" et "-" et de 1 à 10 pour les "*"
 *   - aucun nombre négatifs
 * 5 :
 *   - "+", "-", "*" sont disponibles
 *   - 3 d'additions pour 2 soustactions pour 1 multiplication
 *   - limites 1 à 30 pour les "+" et "-" et de 1 à 20 pour les "*"
 *   - aucun nombre négatifs
 * 6 :
 *   - "+", "-", "*" sont disponibles
 *   - 3 d'additions pour 2 soustactions pour 1 multiplication
 *   - limites 1 à 50 pour les "+" et "-" et de 1 à 20 pour les "*"
 *   - aucun nombre négatifs
 * 7 : + et -, avec limites de 1 à 20 & * avec limites de 1 à 10 & / avec limites de 1 à 10
 * 8 : + et -, avec limites de 1 à 30 & * avec limites de 1 à 20 & / avec limites de 1 à 10
*/

$operationSettings = [
  [
    "operation" => "+",
    "limits" => ["min"=>0, "max"=>10],
    "negative"=>false,
    "scoreFactor"=>1
  ],
  [
    "operation" => "-",
    "limits" => ["min"=>0, "max"=>10],
    "negative"=>false,
    "scoreFactor"=>1.2
  ],
  [
    "operation" => "+",
    "limits" => ["min"=>10, "max"=>30],
    "negative"=>false,
    "scoreFactor"=>1.2
  ],
  [
    "operation" => "+",
    "limits" => ["min"=>20, "max"=>50],
    "negative"=>false,
    "scoreFactor"=>1.4
  ],
  [
    "operation" => "-",
    "limits" => ["min"=>10, "max"=>30],
    "negative"=>false,
    "scoreFactor"=>1.5
  ],
  [
    "operation" => "*",
    "limits" => ["min"=>1, "max"=>10],
    "negative"=>false,
    "scoreFactor"=>1.5
  ],
];
$levelSettings=[
  "ease"=>[0,0,1,2],
  "medium"=>[1,2,3],
  "hard"=>[2,3,4,5]
];
$levelArray = [
  [
    "operationArray" => [ "+","+","+","-" ],
    "limits" => [
      "default"=>["min"=>0, "max"=>10],
    ],
    "negative"=>false,
    "scoreFactor"=>0.5
  ],
  [
    "operationArray" => [ "+","+","-" ],
    "limits" =>  [
      "+"=>["min"=>10, "max"=>30],
      "-"=>["min"=>0, "max"=>20],
    ],
    "negative"=>false,
    "scoreFactor"=>0.8
  ],
  [
    "operationArray" => [ "+","-" ],
    "limits" =>  [
      "+"=>["min"=>20, "max"=>50],
      "-"=>["min"=>10, "max"=>40],
    ],
    "negative"=>false,
    "scoreFactor"=>1
  ],
  [
    "operationArray" => [ "+","+","+","-","-","*" ],
    "limits" => [
      "+"=>["min"=>10, "max"=>30],
      "-"=>["min"=>0, "max"=>20],
      "*"=>["min"=>1, "max"=>10]
    ],
    "negative"=>false,
    "scoreFactor"=>1.2
  ],
  [
    "operationArray" => [ "+","-","*" ],
    "limits" => [
      "+"=>["min"=>10, "max"=>30],
      "-"=>["min"=>0, "max"=>20],
      "*"=>["min"=>1, "max"=>10]
    ],
    "negative"=>false,
    "scoreFactor"=>1.5
  ]

];

function getEquation(array $level):array{
  // Générer l'opération entre les deux
  $operationArray = ["+", "-", "*", "/"];
  $operation = $level["operationArray"][ rand(0, count($level["operationArray"])-1) ];
  // Générer deux nombre random
  $min = $level["limits"][$operation]["min"]??$level["limits"]["default"]["min"];
  $max = $level["limits"][$operation]["max"]??$level["limits"]["default"]["max"];
  if( !$level["negative"] && $operation === "-"){
    $firstNumber = rand($min + intval($max*1/4), $max);
    $secondNumber = rand(0, $firstNumber);    
  }else{
    $firstNumber = rand( $min, $max );
    $secondNumber = rand( $min, $max );
  }
  // Générer le résultat
  $result = getResult($firstNumber, $secondNumber, $operation); 
  // Générer la configuration
  return ["equation" => $firstNumber." ".$operation." ".$secondNumber, "result"=>$result];
}

function getResult(int $firstNumber, int $secondNumber, string $operation): int{
  $result = 0;
  switch ($operation) {
    case '+': $result = $firstNumber + $secondNumber; break;
    case '-': $result = $firstNumber - $secondNumber; break;
    case '*': $result = $firstNumber * $secondNumber; break;
    case '/': $result = $firstNumber / $secondNumber; break;
  }
  return $result;
}

for ($i=0; $i < 100; $i++) { 
  $oneEquation = getEquation($levelArray[3]);
  print( json_encode($oneEquation).",\n");
}
