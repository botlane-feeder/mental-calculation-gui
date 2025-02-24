<script lang="ts">
  import type { EquationType, CoundownTriggers } from "$lib/types";
  
  import CountdownTime from "./CountdownTime.svelte";
  import Equation from "./Equation.svelte";
  import CountdownBar from "./CountdownBar.svelte";
  import Keypad from "./Keypad.svelte";

  import Modal from "./Modal.svelte";

  let { newGameTrigger=$bindable(), equationArray, level }:{newGameTrigger:boolean, equationArray:EquationType[], level:string } = $props();

  let globalTimer = 30;
  
  let score = $state(0);

  let response:number = $state(0);
  let winAnimating:boolean=$state(false);
  let wrongAnimating:boolean=$state(false);
  let idEquation:number = $state( sortEquation( equationArray.length-1 ) );

  let countdownTimeTriggers:CoundownTriggers=$state({start:false, pause:false, reset:false});
  let countdownTimeEnd:boolean= $state(true);

  let countdownBarTriggers:CoundownTriggers=$state({start:false, pause:false, reset:false});
  let countdownBarEnd:boolean= $state(false);

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  function verification(){
    if(!countdownTimeEnd && equationArray[idEquation]["result"] == response){
      // Affichage vert
      winAnimation();
      // Lance une nouvelle équation
      startNewEquation();
      score += 1;
    }else{
      // Affichage rouge
      wrongAnimation();
    }
  }
  function sortEquation(max:number):number{
    return Math.floor(Math.random() * max);
  }
  function startNewEquation(){
    // Selectionne une nouvelle equation
    idEquation = sortEquation( equationArray.length-1 );
    // Relance le chrono
    countdownBarTriggers["start"]=true;

  }

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
  function startNewGame(){
    countdownTimeTriggers["start"]=true;
    countdownBarTriggers["start"]=true;
    score=0;
    startNewEquation();
  }
  // Lancement initial du jeu
  $effect(()=>{
    if( newGameTrigger ){
      newGameTrigger=false;
      countdownTimeEnd=false;
      startNewGame();
    }
  })
  $effect(()=>{
    if(!countdownTimeEnd){
      startNewGame();
    }
  });
  // 
  $effect(()=>{
    if(!countdownTimeEnd && countdownBarEnd){
      // Affichage rouge
      wrongAnimation();
      // Lance une nouvelle équation
      startNewEquation();
      // Réinitialisation de la réponse
      response = 0;
    }else if( countdownTimeEnd ){
      countdownBarTriggers["pause"]=true;
    }
  })
</script>

<div class="container">
  <CountdownTime bind:triggers={countdownTimeTriggers} bind:end={countdownTimeEnd} duration={globalTimer}/>
  {#key winAnimating || wrongAnimating}
  <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  {/key}
  <CountdownBar bind:triggers={countdownBarTriggers} duration={5000} bind:end={countdownBarEnd}/>
  <Keypad bind:response={response} {verification}/>
  
  {#if countdownTimeEnd} <div class="blur"> </div> {/if}
</div>

<Modal onclick={()=>{ countdownTimeEnd = false}} title={`Résolvez autant d'équation possible en ${globalTimer} s`} show={countdownTimeEnd}>
  {#if score > 0}
    <div class="score">Au niveau <span class="bold">{level}</span>, votre score est de {score} !</div>
  {:else}
    <div class="score">Obtenez votre score après votre tentative</div>
  {/if}
</Modal>




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