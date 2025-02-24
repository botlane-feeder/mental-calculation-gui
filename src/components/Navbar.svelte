<script lang="ts">
  import Dropdown from "./Dropdown.svelte";
  /** TODO
   * Faire un dropdown pour le menu
   * - nouvelle partie
   * - changer de niveau
   * Avec un dropdown changer de niveau
   * - facile
   * - moyen
   * - difficile
   */
  
  let {newGameTrigger=$bindable(), height}:{newGameTrigger:boolean, height:string}=$props();
  let closeDropdown:boolean = $state(false)

  function onButtonClick(callback:any){
    callback();
    closeDropdown = true;
  }
</script>

<div class="container" style="height:{height}">
  <Dropdown title={"MENU"} direction={"column"}  bind:closeDropdown={closeDropdown}>
    <button onclick={()=>{onButtonClick(()=>{newGameTrigger=true})}}>Nouvelle partie</button>
    <!-- <Dropdown title={"Niveau"} direction={"row"}>
      <button>Facile</button>
      <button>Moyen</button>
      <button>Difficile</button>
    </Dropdown> -->

    <!-- <Dropdown title={"Jeux seul"} direction={"row"}>
      <button>Sudoku</button>
      <button>Masteming</button>
    </Dropdown> -->

    <!-- <Dropdown title={"Jeux équipe"} direction={"row"}>
      <button>Sudoku</button>
      <button>Bataille navale</button>
    </Dropdown> -->
    <!-- <button>Mental Calculation</button> -->
    <!-- <button>SUDOKU</button> -->
    <!-- <button>Memorize</button> -->
  </Dropdown>
</div>

<style>
  .container{
    position: relative;

    z-index: 15;
  }

  button{
    /* position: absolute; */
    /* top:50%; */
    background-color:#0a0a23;
    color: #fff;
    border:none; 
    border-radius:10px; 
    padding: 10px;
    /* min-height:30px;  */
    /* min-width: 120px; */
    cursor: pointer;

    transition: all 0.3s ease;
  }
  button:hover{
    background-color:#002ead;
    border-radius:10px;
    box-shadow: 0px 0px 2px 2px rgb(0,0,0);
  }
</style>