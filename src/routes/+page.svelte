<script lang="ts">
  import MentalCalculation from "../components/MentalCalculation.svelte";
  import type { EquationType } from "$lib/types";


  let { data }= $props();
  let equationArray:EquationType[] = data["equationArray"];
</script>

<div class="container">
  <MentalCalculation { equationArray }/>
</div>


<style>
  .container{
    width: 100%;
    display:flex;
    flex-direction: column;
    align-items: center;
  }
</style>