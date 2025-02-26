<script lang="ts">
  import type { CoundownTriggers } from "$lib/types";

  let {triggers=$bindable(), end=$bindable(), duration}:{triggers:CoundownTriggers, end:boolean, duration:number} = $props();
  let conf={format:"min"};
  let countdown:number = $state(duration*1000);
  let countdownString:string = $derived.by(()=>{
    let str="";
    let min = Math.floor(countdown/(60*1000));
    let sec = Math.ceil((countdown-(min*60*1000))/1000);
    if(conf["format"] == "min"){
      str = min+" : "+sec;
    }else{
      let ms = (countdown - sec*1000)/10;
      str = sec+" : "+ms;
    }
    return str;
  });
  let idInterval:number=0;
  function start(){
    // Si un interval était déjà en cours : évite les doublons
    reset();
    //Lance l'interval
    idInterval = setInterval(()=>{
      if(countdown > 0){
        countdown -=100
      }else{
        pause();
        end=true;
      }
    },100);
  }
  function decremente(){
    if(countdown > 0){
      countdown -=10
    }else{
      pause();
      end=true;
    }
  }
  function pause(){
    clearInterval(idInterval);
  }
  function reset(){
    clearInterval(idInterval);
    countdown = duration * 1000;    
    end=false;
  }

  $effect(()=>{
    if(triggers["start"]){
      start();
      triggers["start"]=false;
    }
  });
  $effect(()=>{
    if(triggers["pause"]){
      pause();
      triggers["pause"]=false;
    }
  });
</script>

<div class="container">
  <div class="countdownString">{countdownString}</div>
</div>

<style>
  @import url('https://fonts.cdnfonts.com/css/alarm-clock');
  .container{
    width:100%;
    margin:0;
    padding:0;
  }
  .countdownString{
    font-family: 'alarm clock', sans-serif;
    font-size: 48px;
    text-align:center;
  }

</style>