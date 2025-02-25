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
  
  let {newGameTrigger=$bindable(), height, level=$bindable()}:{newGameTrigger:boolean, height:string, level:number}=$props();
  let closeDropdown:boolean = $state(false)

  function onButtonClick(callback:any){
    callback();
    closeDropdown = true;
  }
</script>

<div class="container" style="height:{height}">
  <Dropdown title={"MENU"} direction={"column"}  bind:closeDropdown={closeDropdown}>
    <button onclick={()=>{onButtonClick(()=>{newGameTrigger=true})}}>Nouvelle partie</button>
    <Dropdown title={"Niveau"} direction={"row"}>
      <button onclick={()=>{onButtonClick(()=>{level=0})}} disabled={level==0}>Facile</button>
      <button onclick={()=>{onButtonClick(()=>{level=1})}} disabled={level==1}>Moyen</button>
      <button onclick={()=>{onButtonClick(()=>{level=2})}} disabled={level==2}>Difficile</button>
    </Dropdown>
    <a href="/about">À propos</a>
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

  button, a{
    background-color:#0a0a23;
    color: #fff;
    border:none; 
    border-radius:10px; 
    padding: 10px;
    font-size: 16px;
    text-decoration: none;
    min-width: 100px;
    /* min-height:30px;  */
    text-align: center;
    cursor: pointer;

    transition: all 0.3s ease;
  }
  button:hover, a:hover{
    background-color:#0068ad;
    border-radius:10px;
    box-shadow: 0px 0px 2px 2px rgb(0,0,0);
  }
  button:disabled{
    background-color:#0068ad;
    border-radius:10px;
  }
</style>