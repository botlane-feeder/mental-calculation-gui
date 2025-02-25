<script lang="ts">
  import MentalCalculation from "../components/MentalCalculation.svelte";
  import Navbar from "../components/Navbar.svelte";
  import type { EquationType } from "$lib/types";
  import { onMount } from "svelte";
  import Modal from "../components/Modal.svelte";

  interface Profile{
    name:string,
    level:number,
    scoreArray:number[]
  }
  
  let { data }= $props();
  let localProfile:Profile=$state({name:"", scoreArray:[], level:0});
  //TODO : faire calculer le score à l'intérieur !
  let score:number=$state(0);
  let lastScore:number=$state(0);

  let gameTrigger:{new:boolean, end:boolean}=$state({new:false, end:true});
  let levelString:string[]=["facile", "moyen", "difficile"];
  let equationArray:EquationType[] = $derived(data["equationArray"][localProfile["level"]]);

  let mentalCalculatioSettings = {
    globalTimer:60
  };
  // Quand l'application est disponible sur navigateur
  onMount(()=>{
    // Récupération du profil local
    updateProfile();
  });
  function updateProfile(){
    let storage = localStorage.getItem("mental-calculation");
    if(storage!=null){
      //Vérification du bon type du profil (pas de données manquantes)
      localProfile = JSON.parse(storage);
    }
  }
  $effect(()=>{
    saveProfile(localProfile);
  })
  function saveProfile(localProfile:Profile){
    localStorage.setItem("mental-calculation", JSON.stringify(localProfile));
  } 
  function addScore(newScore:number){
    let scoreArray:number[] = localProfile["scoreArray"]
    scoreArray.push(newScore);
    scoreArray.sort((a,b)=>b-a)
    // Limite à 3 scores
    if(scoreArray.length > 2) scoreArray.splice(3);
    // Enregistre
    localProfile["scoreArray"] = scoreArray;
  }
  $effect(()=>{
    if(score != 0 && gameTrigger["end"]){
      lastScore = score;
      score = 0;
      addScore(lastScore);
    }
  });
</script>

<div class="container">
  <Navbar bind:newGameTrigger={gameTrigger["new"]} bind:level={localProfile["level"]} height={"50px"}/>
  <div class="main">
    <MentalCalculation bind:gameTrigger={gameTrigger} { equationArray } {mentalCalculatioSettings} bind:score={score}/>
  </div>
</div>


{#snippet printScoreArray(scoreArray:number[])}
  <table>
    <thead><tr><th>Classement</th><th>Score</th></tr></thead>
    <tbody>
      {#each scoreArray as oneScore, index}
      <tr>
        <th>{index+1}</th>
        <td>{oneScore}</td>
      </tr>  
      {/each}
    </tbody>
  </table>
{/snippet}

<Modal onclick={()=>{ gameTrigger["new"] = true}} title={`Résolvez autant d'équation possible en ${mentalCalculatioSettings["globalTimer"]} s`} show={gameTrigger["end"]}>
  {#if lastScore > 0}
    <div class="score">Au niveau <span class="bold">{levelString[localProfile["level"]]}</span>, votre score est de {lastScore} !</div>
  {/if}
  {#if localProfile["scoreArray"].length > 0}
    Améliorez votre meilleur score :{@render printScoreArray(localProfile["scoreArray"])}
  {:else}
    Faites votre première tentative pour établir un score !
  {/if}
</Modal>


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

  .score{
    width: 80%;
    text-align: center;
  }
  .bold{
    font-weight: bold;
  }
  table {
    border-collapse: collapse;
    display:inline-block;
    padding: 10px;
  }
  th, td{
    width: 60px;
    border:black solid 1px;
    padding: 3px 10px;
  }
  td{
    text-align: right;
  }
</style>s