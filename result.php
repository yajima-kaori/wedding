<?php
// 検索結果画面を表示
// テストデータを使用するために iframe を使う

require_once('lib/functions.php');
?>
<script>
$(function () {
// XXX テストデータ用の処理 (iframe 中のクリックイベントを上書き)
  $('#result_list').on('load', function(){
    $(this).height(0);
    $(this).height(this.contentWindow.document.documentElement.scrollHeight);
    var $content = $(this.contentWindow.document);
    $content.find('a').attr('target', '_blank');
    $content.find('.jscTitleLink a').click(function(event) { event.stopPropagation();});
    $content.find('.jscClientCaset').click(function(e) { e.stopPropagation(); e.preventDefault(); window.open($(this).find('a.jscTitleLink').attr('href'),'_blank'); return false;});
  });
});
</script>
<iframe id="result_list" src="result_list.php" scrolling="no" seamless="seamless" style="overflow:hidden; width: 750px; border: none;"></iframe>

