<script lang="ts">

  let {startTrigger=$bindable(), end=$bindable(), duration}:{startTrigger:boolean, end:boolean, duration:number} = $props();
  let conf={format:"min"};
  let pauseTrigger:boolean=false;
  let countdown:number = $state(duration*1000);
  let countdownString:string = $derived.by(()=>{
    let str="";
    let min = Math.floor(countdown/(60*1000));
    let sec = Math.floor(countdown/1000);
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
        countdown -=10
      }else{
        pause();
        end=true;
      }
    },10);
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
    if(startTrigger){
      start();
      startTrigger=false;
    }
  });
  $effect(()=>{
    if(pauseTrigger){
      pause();
      pauseTrigger=false;
    }
  });
</script>

<div class="container">
  <div class="countdownString">{countdownString}</div>
</div>

<style>
  @import url('https://fonts.cdnfonts.com/css/alarm-clock');
  .countdownString{
    font-family: 'alarm clock', sans-serif;
    font-size: 48px;
    text-align:center;
  }

</style>