<script lang="ts">
  import MentalCalculation from "../components/MentalCalculation.svelte";
  import Navbar from "../components/Navbar.svelte";
  import type { EquationType } from "$lib/types";

  let { data }= $props();

  let newGameTrigger:boolean=$state(false);
  let equationArray:EquationType[] = data["equationArray"];
</script>

<div class="container">
  <Navbar bind:newGameTrigger={newGameTrigger} height={"50px"}/>
  <div class="main">
    <MentalCalculation bind:newGameTrigger={newGameTrigger} { equationArray }/>
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