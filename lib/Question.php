<?php

require_once('config/config.php');

/**
 * 質問データを扱うクラス
 */
class Question
{
  /**
   * DB ハンドラ
   */
  public $dbh;

  /**
   * __construct
   */
  public function __construct() {
    $this->dbh = $this->connectDatabase();
  }

  /**
   * データベースに接続
   *
   * @return PDO
   */
  public function connectDatabase() {
    try {
      return new PDO(DSN, DB_USER, DB_PASSWORD);
    }
    catch(PDOException $e) {
      throw $e;
    }
  }

  /**
   * 質問データを返す
   *
   * @param int $step 取得する質問のステップ
   * @return array
   */
  public function findByStep($step) {
    $dbh = $this->dbh;
    $sql = "select * from question where step = :step";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':step',$step);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  /**
   * 質問の選択肢データを返す
   *
   * @param int $question_id
   * @return array
   */
  public function findChoicesByQuestionId($question_id) {
    $dbh = $this->dbh;
    $sql = "select * from question_choice where question_id = :question_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':question_id',$question_id);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}
