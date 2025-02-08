<script lang="ts">
  import Equation from "./Equation.svelte";
  import Timer from "./Timer.svelte";
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
<div class="container">
  <Equation {equation} {response} {winAnimating} {wrongAnimating}/>
  <Timer />
  <Keypad bind:response={response} {verification}/>
</div>
{/key}


<style>
  .container{
    max-width: 800px;
    min-width: 300px;

    background-color: #EFF3EA;
    border: solid 2px grey;
  }
  
</style>