<script lang="ts">
  import type { Snippet } from 'svelte';
  interface P {
    children:Snippet,
    title:string,
    direction:string,
    closeDropdown?:boolean};

  let { children, title, direction="row", closeDropdown=$bindable()}:P = $props();
  
  let show = $state(false);

  $effect(()=>{
    if(closeDropdown){
      show = false;
      closeDropdown=false;
    }
  })

</script>

<div class="container" >
  <button class="buttonTitle" onmouseup={()=>{show=!show}} >{title+(show?" <":" >")}</button>
  <div class="dropdown" style="flex-direction: {direction};">
    {#if show}
    {@render children()}
    {/if}
  </div>
</div>

<style>
  .container{
    background-color: #FFFDF0;
    border-radius: 5px;
    padding: 5px 10px;
    /* margin:5px 10px; */
    display:flex;
    gap:5px;
    align-items: start;
    flex-direction: row;
  }
  button{
    width: 100px;
    font-size: 16px;
    display: flex;
    justify-content: center;

    margin:0px 4px;
    cursor: pointer;
  }
  .dropdown{
    display:flex;
    align-items: start;
    gap: 5px;
  }
  @media (max-width: 600px) {
  .dropdown {
    flex-direction: column !important;
  }
}
</style>