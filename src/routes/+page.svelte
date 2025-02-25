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

  let gameTrigger:{new:boolean, end:boolean}=$state({new:false, end:true});
  let levelString:string[]=["facile", "moyen", "difficile"];
  let equationArray:EquationType[] = $derived(data["equationArray"][localProfile["level"]]);

  let mentalCalculatioSettings = {
    globalTimer:10
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
    // let scores = [3,2,5,6]//localStorage.getItem("mental-calculation")["scores"];
    let scoreArray:number[] = localProfile["scoreArray"]
    scoreArray.push(newScore);
    scoreArray.sort((a,b)=>b-a)
    // Limite à 3 scores
    if(scoreArray.length > 2) scoreArray.splice(3);
    // Enregistre
    console.log(scoreArray);
    localProfile["scoreArray"] = scoreArray;
  }
  // $effect(()=>{
  //   if( gameTrigger["end"] == true ){
  //     addScore(score);
  //   }
  // });
</script>

<div class="container">
  <Navbar bind:newGameTrigger={gameTrigger["new"]} bind:level={localProfile["level"]} height={"50px"}/>
  <div class="main">
    <MentalCalculation bind:gameTrigger={gameTrigger} { equationArray } {mentalCalculatioSettings} bind:score={score}/>
  </div>
</div>

<Modal onclick={()=>{ gameTrigger["new"] = true}} title={`Résolvez autant d'équation possible en ${mentalCalculatioSettings["globalTimer"]} s`} show={gameTrigger["end"]}>
  {#if score > 0}
    <div class="score">Au niveau <span class="bold">{levelString[localProfile["level"]]}</span>, votre score est de {score} !</div>
  {/if}
  {#if localProfile["scoreArray"].length > 0}
    Améliorez votre meilleur score {localProfile["scoreArray"]}
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
</style>