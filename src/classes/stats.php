<?php   
  class Stats {
    public function updateStats($json) {
      $hashed = new Security($json);
      $json = $hashed->decrypt();
      $json = json_decode($json);
      $db = new Database();
      $conn = $db->Connect();
      // Check if table exists
      if(!$db->existsTable('DailyStats')) {
        $conn->query("CREATE TABLE IF NOT EXISTS `DailyStats` (
          `Id` int(4) NOT NULL AUTO_INCREMENT,
          `LastUpdate` datetime NOT NULL,
          `HitCount` int(11) NOT NULL,
          `LastTag` varchar(32) NOT NULL,
          PRIMARY KEY (`Id`))
        ");
      }
      // Find out if there is or not a statistic for today.
      $result = $conn->query("SELECT `Id` FROM `DailyStats` WHERE DATE(`LastUpdate`) = DATE(CURDATE())");
      $result = $result->fetchAll();
      // Execute query based on result.
      if(empty($result)) {
        $sql = "INSERT INTO `dailystats`(`LastUpdate`, `LastTag`, `HitCount`) VALUES ('$json->lastUpdate', '$json->lastTag', 1)";
      } 
      else {
        $sql = "UPDATE dailystats SET `LastUpdate` = '$json->lastUpdate', `LastTag` = '$json->lastTag', `HitCount` = HitCount + 1 WHERE DATE(`LastUpdate`) = DATE(CURDATE())";
      }
      $conn->query($sql);
    }
  }
?>