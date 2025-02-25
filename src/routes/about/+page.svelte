<script lang="ts">
  let { data } = $props();
  console.log(data)
  // let version = "0.6.0";
</script>

<div class="container">
  <a href="/">Retour au jeu</a>
  <h1>À propos de {data["name"]}</h1>
  <ul>
    <li>Mental Calculation GUI</li>
    <ul>
      <li>Développé par <a href="https://github.com/botlane-feeder">botlane-feeder</a></li>
      <li>Version actuelle : {data["version"]}</li>
    </ul>
    <li>Calcul du score</li>
    <ul>
      <li>Le score est calculé pour chaque équation réussie, en fonction du temps mis à la résoudre et de la difficulté de celle-ci.</li>
    </ul>
    <li>Stockage de vos données</li>
    <ul>
      <li>Il n'y a aucun stockage de donnée sur un serveur, tout est stocké sur votre navigateur.</li>
      <li>Seulement l'historique de votre score et le niveu de difficulté choisi.</li></ul>
  </ul>
</div>

<style>

</style>