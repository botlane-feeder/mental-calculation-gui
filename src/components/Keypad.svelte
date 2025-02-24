<script lang="ts">

  // let response:number=$state(0);
  
  let { response=$bindable(), verification }:{response:number|null, verification:any}=$props();
  
  function pushResponse(cell:string){
    if(response == null) response = 0;
    if(cell == "C"){
      response=0;
    }else if(cell == "-"){
      response = -response;
    }else{
      response = parseInt(response+cell);
    }
  }
  function enterResponse(){
    // Envoie la réponse
    verification()
    // Remet à 0 la réponse
    response = null;
  }
</script>

<div class="container">
  <div class="numbers">
    {#each ["1","2","3","4","5","6","7","8","9","-","0","C"] as cell}
    <!-- svelte-ignore a11y_click_events_have_key_events, a11y_no_static_element_interactions -->
    <div class="cell number" onclick={()=>{pushResponse(cell);}}>{cell}</div>
    {/each}
  </div>
  <!-- svelte-ignore a11y_click_events_have_key_events, a11y_no_static_element_interactions -->
  <div class="cell" onclick={enterResponse}> Entrer </div>
</div>

<!-- <div class="container">
  <div class="numbers">
    {#each ["1","2","3","4","5","6","7","8","9","-","0","C"] as cell}
    <button class="cell number" onclick={()=>{pushResponse(cell);}}>{cell}</button>
    {/each}
  </div>
  <button class="cell" onclick={enterResponse}> Entrer </button>
</div> -->

<style>
  .container{
    display: flex;
    flex-direction: column;
    gap: 20px;
    
    width: 92%;
    padding: 4%;

    cursor: pointer;
  }
  div.numbers{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    
  }
  div.cell{
    display:flex;
    justify-content:center;
    align-items: center;
    text-align: center;
    font-size: 32px;
    
    box-shadow: 5px 5px 5px grey;
    transition: all 0.3s ease;

    /* background-color: #FFF2C2; */
    
  }
  div.cell:hover{
    box-shadow: -5px -5px 5px grey;
    background-color: lightgrey;
  }
  div.number{
    height: 65px;
  }
</style>