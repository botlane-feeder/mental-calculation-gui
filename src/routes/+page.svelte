<script lang="ts">
  import MentalCalculation from "../components/MentalCalculation.svelte";
  import Navbar from "../components/Navbar.svelte";
  import type { EquationType } from "$lib/types";

  let { data }= $props();

  let newGameTrigger:boolean=$state(false);
  let level:number = $state(0);
  let levelString:string[]=["facile", "moyen", "difficile"];
  let equationArray:EquationType[] = $derived(data["equationArray"][level]);
</script>

<div class="container">
  <Navbar bind:newGameTrigger={newGameTrigger} bind:level={level} height={"50px"}/>
  <div class="main">
    <MentalCalculation bind:newGameTrigger={newGameTrigger} { equationArray } level={levelString[level]}/>
  </div>
</div>


<style>
  .container{
    width: 80%;
    margin: 0 10%;
    display:flex;
    flex-direction: column;
    align-items: start;    
  }
  .main{
    width: 100%;
    display:flex;
    flex-direction: column;
    align-items: center;
  }
</style>