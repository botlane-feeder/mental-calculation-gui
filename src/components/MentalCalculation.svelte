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
  let idEquation:number = $state( sortEquation( equationArray.length-1 ) );

  let equation:string = $derived(equationArray[idEquation]["equation"]);

  function verification(){
    if(equationArray[idEquation]["response"] == response){
      // Affichage vert
      // Nouvelle équation
      idEquation = sortEquation( equationArray.length );
      console.log(idEquation);
      // Relance du chrono
    }else{
      // Affichage vert
    }
  }
  function sortEquation(max:number):number{
    return Math.floor(Math.random() * max);
  }
</script>

<div class="container">
  <Equation {equation} {response}/>
  <Keypad bind:response={response} {verification}/>
</div>

<style>
  .container{
    max-width: 800px;
    min-width: 400px;
  }
</style>