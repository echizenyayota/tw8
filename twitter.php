<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>user timeline</title>
</head>
<body>
      <a href=""><h1>Testなう</h1></a>
<?php
// tw_more9 foreachをつかった時刻の区切りとアドセンスの表示について

require_once("twitteroauth/twitteroauth.php");

$consumerKey = "";
$consumerSecret = "";
$accessToken = "";
$accessTokenSecret = "";

$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

$request = $twObj->OAuthRequest('https://api.twitter.com/1.1/statuses/user_timeline.json','GET',
    array(
        'count'=>'100',
        'screen_name' => 'echizenya_yota',
        ));
$results = json_decode($request);
?>

<?php if(isset($results) && empty($results->errors)){ ?>

    <!-- 時刻の区切り表示のための変数　-->
    <?php $before = ""; ?>

    <!-- つぶやきの繰り返し表示　-->
    <?php foreach($results as $key => $tweet){ ?>

        <!-- 時刻の区切り表示　-->
        <?php $after = date('YmdH', strtotime($tweet->created_at)); ?>
        <?php if($before != $after) { ?>
            <span style="background:green"><?php echo date('Y/m/d H時', strtotime($tweet->created_at)) ; ?></span><br/><br/>
        <?php } ?>
        <?php echo date('Y-m-d H:i:s', strtotime($tweet->created_at)) ; ?></br>
        <?php echo $tweet->text; ?><br/><br/>
        <?php $before = $after; ?>

         <!-- アドセンスの表示　-->
        <?php if ($key == 9 || $key == 19){ ?>
            <span style="background:red; color:white; margin:20%"><?php echo "アドセンスのバナー";　?></span><br/><br/>
        <?php } ?>

    <?php } ?>

<?php }else{ ?>
    <?php echo "関連したつぶやきがありません。"; ?>
<?php } ?>

</body>
</html>