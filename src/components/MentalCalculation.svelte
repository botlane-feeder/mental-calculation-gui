<script lang="ts">
  import type { EquationType } from "$lib/types";
  
  import CountdownTime from "./CountdownTime.svelte";
  import Equation from "./Equation.svelte";
  import CountdownBar from "./CountdownBar.svelte";
  import Keypad from "./Keypad.svelte";

  let { equationArray }:{ equationArray:EquationType[] } = $props();

  let response:number = $state(0);
  let winAnimating:boolean=$state(false);
  let wrongAnimating:boolean=$state(false);
  let idEquation:number = $state( sortEquation( equationArray.length-1 ) );

  let startCountdownTime:boolean=$state(false)
  let countdownTimeEnd:boolean= $state(false);

  let startCountdown:boolean= $state(false);
  let pauseCountdown:boolean= $state(false);
  let resetCountdown:boolean= $state(false);
  let countdownBarEnd:boolean= $state(false);

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  function verification(){
    console.log("verification");
    if(equationArray[idEquation]["result"] == response){
      // Affichage vert
      winAnimation();
      // Lance une nouvelle équation
      startNewEquation()
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
    // Relance du chrono
    startCountdown=true;

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
  $effect(()=>{
    if(!countdownTimeEnd && countdownBarEnd){
      startNewEquation();
    }
  })
</script>

<div class="container">
  {#if countdownTimeEnd}
    <div>FIN, Score : </div>
  {/if}
  <CountdownTime bind:startTrigger={startCountdownTime} bind:end={countdownTimeEnd} duration={2}/>
  <button onclick={()=>{startCountdownTime=true}}>Start</button>
  {#key winAnimating || wrongAnimating}
    <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  {/key}
  <CountdownBar bind:startTrigger={startCountdown} bind:pauseTrigger={pauseCountdown} bind:resetTrigger={resetCountdown} duration={3000} bind:end={countdownBarEnd}/>
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