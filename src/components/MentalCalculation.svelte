<script lang="ts">
  import type { EquationType } from "$lib/types";
  
  import Equation from "./Equation.svelte";
  import Countdown from "./Countdown.svelte";
  import Keypad from "./Keypad.svelte";

  let { equationArray }:{ equationArray:EquationType[] } = $props();

  let response:number = $state(0);
  let winAnimating=$state(false);
  let wrongAnimating=$state(false);
  let idEquation:number = $state( sortEquation( equationArray.length-1 ) );

  let startCountdown= $state(false);
  let pauseCountdown= $state(false);
  let resetCountdown= $state(false);
  let timerEnding= $state(false);

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  function verification(){
    console.log("verification");
    if(equationArray[idEquation]["result"] == response){
      // Affichage vert
      winAnimation();
      // Nouvelle équation
      idEquation = sortEquation( equationArray.length-1 );
      // Relance du chrono
      startCountdown=true;
    }else{
      // Affichage rouge
      wrongAnimation();
    }
  }
  function sortEquation(max:number):number{
    return Math.floor(Math.random() * max);
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
</script>

<div class="container">
  {#if timerEnding}
    <div>FIN, Score : </div>
  {/if}
  {#key winAnimating || wrongAnimating}
    <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  {/key}
  <Countdown bind:startTrigger={startCountdown} bind:pauseTrigger={pauseCountdown} bind:resetTrigger={resetCountdown} duration={3000} bind:end={timerEnding}/>
  <Keypad bind:response={response} {verification}/>
</div>

<style>
  .container{
    max-width: 800px;
    min-width: 300px;

    background-color: #EFF3EA;
    border: solid 2px grey;
  }
  
</style>