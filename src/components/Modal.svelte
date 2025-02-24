<script lang="ts">

  // import close from "$static/icons/closeCrosse-black.png"

  let {onclick, title, show, children} = $props();
  let modalButton=$state({
    delay:5,
    idInterval:0,
    btnDisabled:true
  });

  function delayButton(){
    if(modalButton["delay"] > 0){
     modalButton["delay"] -= 1;
    }else{
      clearInterval(modalButton["idInterval"]);
      modalButton["btnDisabled"]=false;
    }
  }

  $effect(()=>{
    if(show){
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
    {@render children()} 
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
    height: 300px;

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

    cursor:pointer;
    transition: all 0.3s ease;
  }
  .closingCross:hover{
    scale: 1.2;
    background-color: #FFFFFF;
    border-radius: 30px;
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