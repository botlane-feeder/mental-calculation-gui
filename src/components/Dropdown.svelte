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

    background-color: lightcoral;
    color: #fff;
    border:none; 
    border-radius:10px; 
    padding: 5px 10px;
    font-size: 16px;
    text-decoration: none;
    min-width: 100px;
    /* min-height:30px;  */
    text-align: center;
    cursor: pointer;

    transition: all 0.3s ease;

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