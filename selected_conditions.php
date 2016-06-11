<?php
// 選択済の検索条件のタグを返す

session_start();
require_once('lib/functions.php');
require_once('lib/Question.php');

$question = new Question();
?>

<?php if (!empty($_SESSION['selected'])): ?>
  <?php foreach ($_SESSION['selected'] as $step => $list): ?>
    <?php foreach ($list as $id): ?>
      <?php
      $q = $question->findByStep($step);
      $choices = $question->findChoicesByQuestionId($q["id"]);

      $label = '';
      foreach ($choices as $v) {
        if ($v['id'] == $id) {
          $label = $v['label'];
          break;
        }
      }
      ?>

      <div class="chip"><?php echo h($label) ?></div>

    <?php endforeach ?>
  <?php endforeach ?>
<?php endif ?>

