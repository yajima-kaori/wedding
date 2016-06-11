// 現在の質問ステップ
var step = 0;

/**
 * 次の質問を表示する
 */
function showNextQuestion()
{
  var params = {
    'step': step,
    'selected[]': [],
  };

  $('.circle.selected').each(function () {
    params['selected[]'].push($(this).attr('data-choice-id'));
  });

  // 質問データ取得
  $.get('question.php', params, function (html) {
    if (html) {
      $('main').html(html);
    }

    updateSelectedConditions();

    // 時間差タイマー
    var t = 150;

    setTimeout(function () {
      $('.result-count-text').fadeOut('fast', function () {
        var resultsNum = [542, 207, 180, 61, 19]; // XXX テストデータ
        $(this).text(resultsNum[step]).fadeIn();
      });
    }, t);

    // 透明度を時間差で変更して表示する
    $('.circle:odd')
      .sort(function(){
        return Math.random() > 0.5 ? 1 : -1;
      })
      .each(function () {
        $(this).delay(t).fadeTo('slow', 1);
        t += 150;
      });

    $('.circle:even')
      .sort(function(){
        return Math.random() > 0.5 ? 1 : -1;
      })
      .each(function () {
        $(this).delay(t).fadeTo('slow', 1);
        t += 150;
      });

    $('#step_container > .step-item').removeClass('active').eq(step).addClass('active');
  })
  .fail(function () {
    updateSelectedConditions();
    showResult();
  });
}

/**
 * 検索結果を表示する
 */
function showResult()
{
  var $doc = $(document);
  $('.result-link').attr('disabled', 'disabled').fadeTo('fast', 0);
  $doc.off('click', '.result-link');
  $('.question-header').fadeTo('fast', 0);

  // 時間差タイマー(ミリ秒)
  var t = 150;

  // 透明度を時間差で変更して非表示にする
  $('.circle:odd')
    .sort(function() {
      return Math.random() > 0.5 ? 1 : -1;
    })
    .each(function () {
      $(this).delay(t).fadeTo('slow', 0);
      t += 150;
    });

  $('.circle:even')
    .sort(function() {
      return Math.random() > 0.5 ? 1 : -1;
    })
    .each(function () {
      $(this).delay(t).fadeTo('slow', 0);
      t += 150;
    });

  // 背景画像を消す
  $('body').addClass('result');
  $('#container').addClass('result');

  // 全ての円画像が消えてから結果ページ取得
  setTimeout(function () {
    $.get('result.php', function (html) {
      if (html) {
        $('main').hide().html(html).fadeIn();
      }
    });
  }, t + 200);

  // 画面右上の質問ステップを最後まで進める
  $('#step_container > .step-item').removeClass('active').last().addClass('active');
}

/**
 * 選択した検索条件のタグを更新する
 */
function updateSelectedConditions()
{
  $.get('selected_conditions.php', function (html) {
    if (html) {
      $('#selected_conditions').html(html);
    }
  });
}


$(function () {
  var $doc = $(document);
  var $arrow = $('#arrow');

  // 円画像がクリックされた時
  $doc.on('click', '.circle', function () {
    var $circle = $(this);

    // 選択済の場合
    if ($circle.hasClass('selected')) {
      $circle.animate({'width': '200px', 'height': '200px'}, 300, "easeOutQuint");
      $circle.removeClass('selected');

      if ($('.circle.selected').length == 0) {
        $arrow.removeClass('active');
      }
    }
    // 選択されてない場合
    else {
      $circle.animate({'width': '240px', 'height': '240px'}, 300, "easeOutQuint");
      $circle.addClass('selected');

      $arrow.addClass('active');
    }
  });

  // 次ステップへの矢印をクリックされた時のイベントハンドラ
  $arrow.on('click', function () {
    var $button = $(this);

    $button.prop('disabled', true);

    var t = 150;

    // 透明度を時間差で変更して非表示にする
    $('.circle:odd')
      .sort(function() {
        return Math.random() > 0.5 ? 1 : -1;
      })
      .each(function () {
        $(this).delay(t).fadeTo('slow', 0);
        t += 150;
      });

    $('.circle:even')
      .sort(function() {
        return Math.random() > 0.5 ? 1 : -1;
      })
      .each(function () {
        $(this).delay(t).fadeTo('slow', 0);
        t += 150;
      });

    // 全ての円画像が消えた後に処理
    setTimeout(function () {
      $arrow.removeClass('active');
      step++;
      showNextQuestion();
      $button.prop('disabled', true);
    }, t);
  });

  // 「検索結果をすべて見る」ボタンを押された時のイベントハンドラ
  $doc.on('click', '.result-link', function (e) {
    e.preventDefault();
    showResult();
  });

  // 最初のSTART ボタン
  $doc.on('click', 'a.start', function (e) {
    e.preventDefault();
    $('#top_Photo').addClass('started');
    $('#toptext').fadeOut(1000, function () {
      $('header').fadeIn(1000);
      $('#container').fadeIn(1000, function () {
        showNextQuestion();
      });
    });
  });
});
