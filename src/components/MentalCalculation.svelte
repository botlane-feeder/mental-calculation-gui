<script lang="ts">
  import type { EquationType,CoundownTriggers } from "$lib/types";
  
  import CountdownTime from "./CountdownTime.svelte";
  import Equation from "./Equation.svelte";
  import CountdownBar from "./CountdownBar.svelte";
  import Keypad from "./Keypad.svelte";

  let { equationArray }:{ equationArray:EquationType[] } = $props();

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
  // Lancement initial du jeu
  $effect(()=>{
    if(!countdownTimeEnd){
      // Lancement des chronos
      countdownTimeTriggers["start"]=true;
      countdownBarTriggers["start"]=true;
    }
  });
  // 
  $effect(()=>{
    
    if(!countdownTimeEnd && countdownBarEnd){
      // Affichage rouge
      wrongAnimation();
      // Lance une nouvelle équation
      startNewEquation();
    }else if( countdownTimeEnd ){
      countdownBarTriggers["pause"]=true;
    }
  })
</script>

<div class="container">
  <CountdownTime bind:triggers={countdownTimeTriggers} bind:end={countdownTimeEnd} duration={20}/>
  {#key winAnimating || wrongAnimating}
  <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  {/key}
  <CountdownBar bind:triggers={countdownBarTriggers} duration={3000} bind:end={countdownBarEnd}/>
  <Keypad bind:response={response} {verification}/>
  
  {#if countdownTimeEnd}
  <div class="startMentalCalculation">
    <button onclick={()=>{ countdownTimeEnd = false}}>Start to calculate ?</button>
  </div>
  <!-- <div>FIN, Score : </div> -->
  {/if}
</div>

<style>
  .container{
    position: relative;
    max-width: 800px;
    min-width: 300px;

    background-color: #EFF3EA;
    border: solid 2px grey;
  }
  .startMentalCalculation{
    position: absolute;
    top: 0px;
    background-color: #bbb7b788;
    width:100%;
    height:100%;
    z-index: 10;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .startMentalCalculation button{
    font-size: 28px;
    padding: 20px 10px;
  }
  
</style>