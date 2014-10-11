<?php
  include_once('db.php');
  include("FeedWriter.php");

  $dd = '|||';
  $TestFeed = new FeedWriter(RSS2);
  $TestFeed->setTitle('SPI Registration');
  $TestFeed->setLink('http://sattapanchayat.org/');
  $TestFeed->setDescription(
        'nothing much'
  );

  mysql_connect($host, $username, $password);
  mysql_select_db($db_name);
  $result = mysql_query("select * from registration");
  $counter = 0;
  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $counter++;

      $newItem = $TestFeed->createNewItem();
      $newItem->setTitle($row['registration'] . $counter);
      $newItem->setLink('http://sattapanchayat.org/' . $counter . '.php');
      $desc = $row['id'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['name'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['mailID'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['address'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['town'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['city'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['state'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['bloodGroup'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['education'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['phone'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['donation'] . ' ' .  $dd . ' ';
      $newItem->setDescription($desc);

      $newItem->setDate($row['addedOn']);
      $TestFeed->addItem($newItem);
  }

  $TestFeed->genarateFeed();

?>
