<?php
// set timezone
date_default_timezone_set("Asia/Jakarta");

// load class twitteroauth
include "twitteroauth/twitteroauth.php";
// set key for auth rest api
$consumer_key = "";
$consumer_secret = "";
$access_token = "";
$access_token_secret = "";
// create object twitter
$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
// get tweets from hashtag "#SmartTraffic"
$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=%23SmartTraffic&result_type=recent&count=100');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API</title>

  <!-- load css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="assets/css/style.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 header">
      <h1>Twitter REST API</h1>
    </div>
  </div>
  <?php foreach ($tweets->statuses as $key => $tweet) {
    // date format
    $date = new DateTime($tweet->created_at);
    $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $formatted_date = $date->format('H:i, M d');
  ?>
  <div class="row">
    <div class="col-md-8 col-md-offset-2 section">
      <div class="image">
        <img src="<?=$tweet->user->profile_image_url;?>" />
      </div>
      <div class="detail">
        <div class="names">
          <p class="name"><?=$tweet->user->name; ?></p>
          <span class="username">( <?=$tweet->user->screen_name; ?> )</span>
        </div>
      </div>
      <div class="tweets">
        <p><?=$tweet->text; ?></p><span class="date"> &raquo; <?=$formatted_date; ?></span>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

</body>
</html>
