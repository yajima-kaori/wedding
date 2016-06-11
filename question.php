<?php

require_once('lib/functions.php');
require_once('lib/Question.php');

session_start();

// 表示する質問ステップ(最初の質問は 0)
$step = 0;
if (!empty($_GET['step'])) {
  $step = $_GET['step'];
}

// 選択中の検索条件(最初のステップ表示時に初期化)
if (empty($_SESSION['selected']) || $step == 0) {
  $_SESSION['selected'] = array();
}

// 選択した検索条件
if ($step > 0 && !empty($_GET['selected'])) {
  $_SESSION['selected'][$step - 1] = $_GET['selected'];
}

// パラメータで指定されたステップの質問データを取得
$question = new Question();
$row = $question->findByStep($step);
if (empty($row)) {
  header("HTTP/1.0 404 Not Found");
  exit;
}
$choices = $question->findChoicesByQuestionId($row["id"]);

?>

<p class="question-header"><?php echo h($row['title']) ?></p>

<?php foreach ($choices as $k => $choice): ?>

  <?php
    // 円画像ごとのID
    $circle_id = $step . '_' . $choice['id'];
  ?>

  <style>
  /* 円画像ごとに別のアニメーションを設定する */
  #circle_<?php echo h($circle_id) ?> {
    position:relative;
    display:inline-block;
    width: 200px;
    height: 200px;
    opacity:0;
    margin:10px;
    cursor:pointer;
    background: url(<?php echo h($choice['image']) ?>) no-repeat;
    background-size: cover;
    vertical-align:middle;

    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;

    -webkit-animation: move<?php echo h($circle_id) ?> 20s infinite;
    -webkit-animation-direction: alternate;
    -webkit-animation-timing-function: linear;
    animation: move<?php echo h($circle_id) ?> 20s infinite;
    animation-direction: alternate;
    animation-timing-function: linear;
  }

  @-webkit-keyframes move<?php echo h($circle_id) ?> {
    <?php for ($i = 0; $i <= 100; $i += 10): ?>
      <?= $i ?>%   {transform:translateY(<?= mt_rand(0, 10) ?>%) translateX(<?= mt_rand(0, 10) ?>%);}
    <?php endfor ?>
  }

  @keyframes move<?php echo h($circle_id) ?> {
    <?php for ($i = 0; $i <= 100; $i += 10): ?>
      <?= $i ?>%   {transform:translateY(<?= mt_rand(0, 10) ?>%) translateX(<?= mt_rand(0, 10) ?>%);}
    <?php endfor ?>
  }
  </style>

  <div id="circle_<?php echo h($circle_id) ?>" class="circle" data-choice-id="<?php echo h($choice['id']) ?>">
    <div class="overlay"></div>
    <div class="text"><span><?php echo nl2br(h($choice['label'])) ?></span></div>
  </div>
  <?php if ($k > 0 && $k % 3 == 0): ?>
  <br>
  <?php endif ?>

<?php endforeach ?>
