<html>
<head>
  <title>SAO episodes checker</title>
</head>
<body>

<?php
  const EPISODES_COUNT = 12;
  const EPISODE_RELEASE_INTERVAL_IN_DAYS = 7;
  const FIRST_EPISODE_DATE_STRING = '2019-10-05';

  function createDate($dateString, $timezone = null) {
    $timezone = $timezone ?? new DateTimezone('Europe/Moscow');

    return new DateTime($dateString, $timezone);
  }

  function getReleasedEpisodesCount($firstEpisodeDate, $todayDate) {
    $daysPassedAfterFirstEpisode = $todayDate->diff($firstEpisodeDate)->d;
    // Addition is used to count the first episode as well
    $releasedEpisodesCount = 1 + floor($daysPassedAfterFirstEpisode / EPISODE_RELEASE_INTERVAL_IN_DAYS);

    return $releasedEpisodesCount;
  }

  function getIntervalBeforeNextEpisode($releasedEpisodesCount, $firstEpisodeDate, $todayDate) {
    $daysBeforeNextEpisode = $releasedEpisodesCount * EPISODE_RELEASE_INTERVAL_IN_DAYS;
    $nextEpisodeDate = $firstEpisodeDate->modify("+ {$daysBeforeNextEpisode} day");

    $beforeNextEpisodeInterval = $nextEpisodeDate->diff($todayDate);
    return $beforeNextEpisodeInterval;
  }

  $firstEpisodeDate = createDate(FIRST_EPISODE_DATE_STRING);
  $todayDate = createDate('now');

  $releasedEpisodesCount = getReleasedEpisodesCount($firstEpisodeDate, $todayDate);
  $nextEpisode = $releasedEpisodesCount + 1;
  $beforeNextEpisodeInterval = getIntervalBeforeNextEpisode($releasedEpisodesCount, $firstEpisodeDate, $todayDate);

  echo "Next episode #{$nextEpisode} is gonna be released in ";
  echo $beforeNextEpisodeInterval->format("%a days, %h hours, %i minutes");
?>

</body>
</html>
