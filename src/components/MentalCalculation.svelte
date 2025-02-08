<script lang="ts">
  import Equation from "./Equation.svelte";
  import Keypad from "./Keypad.svelte";

  let response:number = $state(0);
  let equationArray:{equation:string, response:number}[] = [
    {"equation":"3 + 2", "response":5},
    {"equation":"2 + 3", "response":5},
    {"equation":"8 + 5", "response":13},
    {"equation":"20 + 5", "response":25},
    {"equation":"23 - 8", "response":15},
  ];
  let winAnimating=$state(false);
  let wrongAnimating=$state(false);
  let idEquation:number = $state( sortEquation( equationArray.length-1 ) );

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  function verification(){
    if(equationArray[idEquation]["response"] == response){
      // Affichage vert
      winAnimation();
      // Nouvelle équation
      idEquation = sortEquation( equationArray.length );
      console.log(idEquation);
      // Relance du chrono
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

{#key winAnimating || wrongAnimating}
<div class="container {winAnimating ? 'winAnimating' : ''} {wrongAnimating ? 'wrongAnimating' : ''}">
  <Equation {equation} {response}/>
  <Keypad bind:response={response} {verification}/>
</div>
{/key}


<style>
  .container{
    max-width: 800px;
    min-width: 300px;

    background-color: #EFF3EA;
    /* border: transparent 10px solid; */
  }
  .wrongAnimating{
    animation: blinkRed 0.2s infinite;

  }
  @keyframes blinkRed {
    0%, 100% {
      border: transparent 10px solid;
    }
    50% {
      border: red 10px solid;
    }
  }


  .winAnimating {
    animation: rotateBorder 3s linear;
  }

  @keyframes rotateBorder {
    0% {
      border: green 10px solid;
      border-top-color: transparent;
      border-left-color: transparent;
    }
    25% {
      border: green 10px solid;
      border-right-color: transparent;
      border-bottom-color: transparent;
    }
    50% {
      border: green 10px solid;
      border-left-color: transparent;
      border-top-color: transparent;
    }
    75% {
      border: green 10px solid;
      border-bottom-color: transparent;
      border-right-color: transparent;
    }
    100% {
      border: green 10px solid;
      border-top-color: transparent;
      border-left-color: transparent;
    }
  }
</style>