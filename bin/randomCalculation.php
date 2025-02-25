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

$operationSettingsArray = [
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
    "scoreFactor"=>2
  ],
  [
    "operation" => "+",
    "limits" => ["min"=>10, "max"=>30],
    "negative"=>false,
    "scoreFactor"=>2
  ],
  [
    "operation" => "+",
    "limits" => ["min"=>20, "max"=>50],
    "negative"=>false,
    "scoreFactor"=>3
  ],
  [
    "operation" => "-",
    "limits" => ["min"=>10, "max"=>30],
    "negative"=>false,
    "scoreFactor"=>5
  ],
  [
    "operation" => "*",
    "limits" => ["min"=>1, "max"=>10],
    "negative"=>false,
    "scoreFactor"=>5
  ],
];
$levelSettingsArray=[
  "ease"=>[0,0,1,2],
  "medium"=>[1,1,2,3],
  "hard"=>[2,3,4,5]
];

function getEquation(array $operationSettings):array{
  // Générer l'opération entre les deux
  $operationArray = ["+", "-", "*", "/"];
  $operation = $operationSettings["operation"];
  // Générer deux nombre random
  $min = $operationSettings["limits"]["min"];
  $max = $operationSettings["limits"]["max"];
  if( !$operationSettings["negative"] && $operation === "-"){
    $firstNumber = rand($min + intval($max*1/4), $max);
    $secondNumber = rand(0, $firstNumber);    
  }else{
    $firstNumber = rand( $min, $max );
    $secondNumber = rand( $min, $max );
  }
  // Générer le résultat
  $result = getResult($firstNumber, $secondNumber, $operation); 
  // Générer la configuration
  return ["equation" => $firstNumber." ".$operation." ".$secondNumber, "result"=>$result, "scoreFactor"=>$operationSettings["scoreFactor"]];
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


$levelName="hard";
for ($i=0; $i < 100; $i++) { 
  $levelSettings = $levelSettingsArray[$levelName][rand( 0, count($levelSettingsArray[$levelName])-1 )];
  $oneEquation = getEquation( $operationSettingsArray[$levelSettings] );
  print( json_encode($oneEquation).",\n");
}
