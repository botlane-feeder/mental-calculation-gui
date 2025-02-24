<script lang="ts">
  import type { EquationType, CoundownTriggers } from "$lib/types";
  import { onMount } from 'svelte';

  import CountdownTime from "./CountdownTime.svelte";
  import Equation from "./Equation.svelte";
  import CountdownBar from "./CountdownBar.svelte";
  import Keypad from "./Keypad.svelte";

  import Modal from "./Modal.svelte";

  interface P {
    gameTrigger:{new:boolean, end:boolean},
    equationArray:EquationType[],
    mentalCalculatioSettings:any,
    score:number
  };

  let { gameTrigger=$bindable(), equationArray, mentalCalculatioSettings, score=$bindable() }:P = $props();

  // let score = $state(0);

  let localProfile = $state();

  let response:number|null = $state(null);
  let winAnimating:boolean=$state(false);
  let wrongAnimating:boolean=$state(false);
  let idEquation:number = $state( getEquation( equationArray.length-1 ) );

  let countdownTimeTriggers:CoundownTriggers=$state({start:false, pause:false, reset:false});

  let countdownBarTriggers:CoundownTriggers=$state({start:false, pause:false, reset:false});
  let countdownBarEnd:boolean= $state(false);

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  // Vérifie une réponse. En cas de bonne réponse lance une nouvelle équation et calcule le score
  function verification(){
    if(!gameTrigger["end"] && equationArray[idEquation]["result"] == response){
      // Affichage vert
      winAnimation();
      // Lance une nouvelle équation
      startNewEquation();
      score += 1; //calculateScore();
    }else{
      // Affichage rouge
      wrongAnimation();
    }
  }
  // Retourne une équation aléatoire depuis la liste
  function getEquation(max:number):number{
    return Math.floor(Math.random() * max);
  }
  // Modifie les éléments pour lancer une nouvelle équation
  function startNewEquation(){
    // Selectionne une nouvelle equation
    idEquation = getEquation( equationArray.length-1 );
    // Relance le chrono
    countdownBarTriggers["start"]=true;
    // Réinitialisation de la réponse
    response = null;

  }
  // Modifie les éléments pour lancer une nouvelle partie
  function startNewGame(){
    // Gestion des timers
    countdownTimeTriggers["start"]=true;
    // Mise à 0 du score actuel
    score=0;
    // Lancement d'une nouvelle équation
    startNewEquation();
  }


  // Écoute pour le lancement initial du jeu
  $effect(()=>{
    if( gameTrigger["new"] ){
      gameTrigger["new"]=false;
      gameTrigger["end"]=false;
      startNewGame();
    }
  });
  // Écoute la fin d'une décompte d'une équation et relance un équation ou la fin du décompte global
  $effect(()=>{
    if(!gameTrigger["end"] && countdownBarEnd){
      // Affichage rouge
      wrongAnimation();
      // Lance une nouvelle équation
      startNewEquation();
    }else if( gameTrigger["end"] ){
      countdownBarTriggers["pause"]=true;
    }
  });

  function calculateScore(){
    score = score;
  }

  // Animations visuelles
  function winAnimation() {
    winAnimating = true;
    setTimeout(() => {
      winAnimating = false;
    }, 1000);
  }
  function wrongAnimation(){
    wrongAnimating = true;
    setTimeout(() => {
      wrongAnimating = false;
    }, 1000);
  }
</script>

<div class="container">
  <CountdownTime bind:triggers={countdownTimeTriggers} bind:end={gameTrigger["end"]} duration={mentalCalculatioSettings["globalTimer"]}/>
  {#key winAnimating || wrongAnimating}
  <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  {/key}
  <CountdownBar bind:triggers={countdownBarTriggers} duration={5000} bind:end={countdownBarEnd}/>
  <Keypad bind:response={response} {verification}/>
  
  {#if gameTrigger["end"]} <div class="blur"> </div> {/if}
</div>

<!-- <Modal onclick={()=>{ countdownTimeEnd = false}} title={`Résolvez autant d'équation possible en ${globalTimer} s`} show={countdownTimeEnd}>
  {#if score > 0}
    <div class="score">Au niveau <span class="bold">{level}</span>, votre score est de {score} !</div>
  {:else}
    <div class="score">Obtenez votre score après votre tentative</div>
  {/if}
  {#if localProfile}
    Améliorez votre score {localProfile["scoreArray"]}
  {/if}
</Modal> -->




<style>
  .container{
    position: relative;
    max-width: 800px;
    min-width: 300px;

    background-color: #EFF3EA;
    border: solid 2px grey;
  }
  .blur{
    position: absolute;
    top: 0px;
    background-color: #bbb7b788;
    width:100%;
    height:100%;
    z-index: 10;
  }
  .score{
    width: 80%;
    text-align: center;
  }
  .bold{
    font-weight: bold;
  }
  
</style>