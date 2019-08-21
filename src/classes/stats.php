<?php   
  class Stats {
    public function updateStats($json) {
      $json = base64_decode($json);
      $json = json_decode($json);
      $db = new Database();
      $conn = $db->Connect();
      // Check if table exists
      if(!$db->existsTable('DailyStats')) {
        $conn->query("CREATE TABLE IF NOT EXISTS `DailyStats` (
          `Id` int(4) NOT NULL AUTO_INCREMENT,
          `LastUpdate` datetime NOT NULL,
          `HitCount` int(11) DEFAULT NULL,
          `LastTag` varchar(32) NOT NULL,
          PRIMARY KEY (`Id`))
        ");
      }
      // Find out if there is or not a statistic for today.
      $result = $conn->query("SELECT `Id` FROM `DailyStats` WHERE DATE(`LastUpdate`) = DATE(CURDATE())");
      $result = $result->fetchAll();
      // Execute query based on result.
      if(empty($result)) {
        $sql = "INSERT INTO `dailystats`(`LastUpdate`, `LastTag`) VALUES ('$json->lastUpdate', '$json->lastTag')";
      } 
      else {
        $sql = "UPDATE dailystats SET `LastUpdate` = '$json->lastUpdate', `LastTag` = '$json->lastTag' WHERE DATE(`LastUpdate`) = DATE(CURDATE())";
      }
      $conn->query($sql);
    }
  }
?>