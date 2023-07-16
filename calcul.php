<?php
if (isset($_POST['num'])) {
    $quantites = $_POST['num'];
  
    function getPacksConfig() {
      $configFile = 'configPrice.json';
      $configData = file_get_contents($configFile);
      return json_decode($configData, true);
    }
  
    function getPriceById($packsConfig, $id) {
        foreach ($packsConfig['packs'] as $pack) {
          if ($pack['id_pack'] == $id) {
            return $pack['price'];
          }
        }
        return 0;
      }
      
  
    $coutTotal = 0;
  
    if (isset($_POST['submit'])) {
      $quantites = is_array($quantites) ? $quantites : array($quantites);
  
      $packsConfig = getPacksConfig();
  
      foreach ($quantites as $id => $quantite) {
        $quantite = intval($quantite);
        $prixPack = getPriceById($packsConfig, $id);
        $coutTotal += $quantite * $prixPack;
      }
    }
  
    echo "Le coût total des licences est de $coutTotal $";
  }
  