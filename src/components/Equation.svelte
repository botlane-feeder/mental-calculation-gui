<script lang="ts">
  let {equation, response}: {equation:string, response:number} = $props();
</script>

<div class="container">
  {equation} = 
  {#if response > 0 }
  {response}
  {/if}
</div>

<style>
  .container{
    width: 96%;
    text-align: center;
    padding: 2%;

    font-size: 40px;

    border: solid 2px grey;

    background-color: #D9DFC6;
  }
</style>