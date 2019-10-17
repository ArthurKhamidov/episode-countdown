<html>
 <head>
  <title>SAO episodes checker</title>
 </head>
 <body>
 <?php
 // Get content from the DataBase:
 $fEp = fopen('episodes.txt', 'r');
 while (!feof($fEp)) {
    $fromFileEp = fgets($fEp, 4);
 } 
 fclose($fEp);

 $fDate = fopen('date.txt', 'r');
 while (!feof($fDate)) {
    $fromFileDate = fgets($fDate, 12);
 }
 fclose($fEp); 
 // Initialize vars: 
 $episodeNum = $fromFileEp;
 $releaseDay = substr($fromFileDate, 8, 2);
 $releaseMonth = substr($fromFileDate, 5, 2);
 $releaseYear = substr($fromFileDate, 0, 4);
 $currentEpisodeRelease = "{$releaseYear}-{$releaseMonth}-{$releaseDay}";

 $releaseTime = mktime(0, 0, 0, $releaseMonth, $releaseDay, $releaseYear);
 $currentTime = time();
 $diff = ($releaseTime - $currentTime);

 $days = date('j', $diff);
 $hours = date('G', $diff);
 $mins = date('i', $diff);
 $secs = date('s', $diff);

 echo "<p><b><center> Welcome to the SAO new episodes checking service!</center></b></p>";

 if ($currentTime > $releaseTime) {
     $nextEpisodeRelease = date('Y-m-d', strtotime($currentEpisodeRelease . " + 7 days"));
     $episodeNum++;
     // Update the DataBase:
     $fEp = fopen('episodes.txt', 'w');
     $file = fwrite($fEp, $episodeNum);
     fclose($fEp);

     $fDate = fopen('date.txt', 'w');
     $file = fwrite($fDate, $nextEpisodeRelease);
     fclose($fDate);
 } else {
    echo "<p><center>Until the release of the episode #{$episodeNum}
    remains {$days} days {$hours} hours {$mins} minutes {$secs} seconds</center></p>";
 }
 ?>
 </body>
</html>