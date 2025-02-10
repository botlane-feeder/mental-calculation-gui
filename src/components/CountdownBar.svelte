<script lang="ts">

  let {startTrigger=$bindable(), pauseTrigger=$bindable(), resetTrigger=$bindable(), duration, end=$bindable()}:
  {startTrigger:boolean, pauseTrigger:boolean, resetTrigger:boolean, duration:number, end:boolean} = $props();

  let progress:number = $state(100);
  let intervalId:number=0;

  function startCountdown() {
    // S'il y a déjà un décompte reset et relance
    // if (intervalId!=0){
      resetCountdown();
    // }
    // Lance un interval qui va diminuer la progression
    intervalId = setInterval(() => {
      if (progress > 0) {
        progress -= 1;
      } else {
        clearInterval(intervalId);
        intervalId = 0;
        end=true;
      }
    }, duration/100);
  }

  function pauseCountdown() {
    clearInterval(intervalId);
    intervalId = 0;
  }
  
  function resetCountdown() {
    progress = 100;
    end=false;
    clearInterval(intervalId);
    intervalId = 0;
  }

  // Réagir aux changements des props
  $effect(()=>{
    if (startTrigger) {
      startCountdown();
      startTrigger = false;
    }
  });
  $effect(()=>{
    if (pauseTrigger) {
      pauseCountdown();
      pauseTrigger = false;
    }
  });
  $effect(()=>{
    if (resetTrigger) {
      resetCountdown();
      resetTrigger = false;
    }
  });
</script>


<div class="container">
  <div class="progress-bar" style="width: {progress}%"></div>
</div>

<style>
  .container{
    width:100%;
    margin:0;
    padding:0;
  }
  .progress-bar{
    width: 100%;
    height: 10px;
    background-color: lightcoral;
    transition: width 0.03s linear;
  }
</style>