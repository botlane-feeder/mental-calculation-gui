<script lang="ts">
  import type { Snippet } from "svelte";

  // import close from "$static/icons/closeCrosse-black.png"
  interface P{
    onclick: any,
    title: string,
    show: boolean,
    children?: Snippet
  }

  let {onclick, title, show=$bindable(), children}:P = $props();
  let modalButton=$state({
    delay:10,
    idInterval:0,
    btnDisabled:true
  });

  function delayButton(){
    if(modalButton["delay"] > 0){
     modalButton["delay"] -= 1;
    }else{
      clearInterval(modalButton["idInterval"]);
      modalButton["btnDisabled"]=false;
      modalButton["delay"]=10;
    }
  }

  $effect(()=>{
    if(show){
      modalButton["btnDisabled"]=true;
      modalButton["idInterval"] = setInterval(delayButton, 100);
    }
  });
</script>

{#if show}
<div class="container">
  <div class="modal">
    <p class="title">{title}</p>
    <button {onclick} disabled={modalButton["btnDisabled"]}>CALCULER !</button>
    <p class="text"></p>
    {@render children?.()} 
    <!-- svelte-ignore a11y_no_static_element_interactions -->
    <div class="closingCross" onmouseup={()=>{show=false;}}>X</div>
  </div>
</div>
{/if}

<style>
  .container{
    position: absolute;
    top:50px;
    left:0px;
    z-index: 10;
    width:100%;
    /* height:100%; */
    height: calc(100% - 50px);
    background-color: #6e6e6ea6;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
  }
  
  .modal{
    position: absolute;
    top: 50px;
    /* transform: translateY(-50%); */
    width: 80%;
    max-width: 1000px;
    min-width: 350px;
    min-height: 300px;
    max-height: 800px;

    background-color: #FFFFFFAA;
    border-radius: 15px;

    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: center;

  }
  .closingCross{
    position: absolute;
    top:10px;
    right:10px;
    width: 30px;
    height: 30px;

    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;

    background-color: #FFFFFF;
    border-radius: 30px;

    cursor:pointer;
    transition: all 0.3s ease;
  }
  .closingCross:hover{
    scale: 1.2;
  }
  p{
    padding: 3px 15px;
  }
  .title{
    background-color: #00000088;
    color: white;
    font-size: 20px;
  }
  .modal button{
    width: 80%;

    font-size: 20px;
    padding: 20px 10px;
    
    cursor: pointer;
  }
  button:disabled{
    cursor: wait;
  }
</style>