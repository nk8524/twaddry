/*

textareaに関するJS

*/
$(function(){
  const minRows = 7;  // 初期行数
  const maxStr = 200;　// 最大投稿可能文字数
  const maxLineBreaks = 10;　// 最大投稿可能改行数
  $('.word_counter .max').text(maxStr);
  $('.modal-post').on('show.bs.modal', function(){
    var $modalPost = $(this)
    var $textarea = $modalPost.find('textarea');
    // リサイズ
    $textarea.attr('rows',minRows)
    $modalPost.css('display','block');
    autosize($textarea);
    // 文字数カウンタ
    var $btnPost = $modalPost.find('.btn-post');
    var $wordCounter = $modalPost.find('.word_counter');
    var $wordCounterNow = $modalPost.find('.word_counter .now');
    $textarea.on('change input keydown paste cut',function(){
      var text = $(this).val()
      var textNospace = text.replace(/\s+/g, "");
      var lineBreaks = text.split(/\r\n|\r|\n/).length;
      var cntSum = text.length;
      $wordCounterNow.text(cntSum);
      // 200字以下、空文字でない、改行数が10以下なら投稿可
      if(cntSum <= maxStr && textNospace && lineBreaks <= maxLineBreaks){
        $btnPost.prop('disabled', false);
        $wordCounter.removeClass('over');
      }else{
        $btnPost.prop('disabled', true);
        $wordCounter.addClass('over');
      }
    }).change();
  });
});