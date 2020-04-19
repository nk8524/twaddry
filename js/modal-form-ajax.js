/*

ajaxを使ってモーダル内のフォーム送信を非遷移化

*/
$(function(){
  // ajaxで情報送信
  $('*[data-id="ajax"]').click(function(e) {

    var $button = $(this);
    var $form = $button.parents('form');
    var buttonName = $button.attr('name');
    var requestData = $form.serializeArray();
    var noInput = false;
    $.each(requestData,function(index,dict) {
      if(dict['value'] == "") {
        noInput = true;
      }
    })
    var addData = { name : buttonName, value : "1" }
    requestData.push(addData);
    var errorMessage = "";
    var error = $form.find('#error');
    if(error.length){
      error.remove();
    }
    $.ajax({
        url: '/twaddry/server/response_ajax.php',
        method: $form.attr('method'),
        data: requestData,
        dataType: 'json',
        timeout: 10000,
        beforeSend: function(xhr, settings) {
            $button.attr('disabled', true);
            if (noInput) {
              errorMessage = '未入力の項目があります。';
              var errorHTML = '<div id="error"><span>' + errorMessage + '</span></div>';
              $form.prepend(errorHTML);
              $button.attr('disabled', false);
              return false;
            }
        },
        complete: function(xhr, textStatus) {
            $button.attr('disabled', false);
        }
    }).done(function(responseData, textStatus, jqXHR){
        errorMessage = responseData.error_message;
        if(!errorMessage) {
          location.reload();
        } else {
          var errorHTML = '<div id="error"><span>' + errorMessage + '</span></div>';
          $form.prepend(errorHTML);
          $button.attr('disabled', false);
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
      console.log("ajax通信に失敗しました");
      console.log("jqXHR          : " + jqXHR.status);
      console.log("textStatus     : " + textStatus);
      console.log("errorThrown    : " + errorThrown.message);
    });

    return false;
  });

  // モーダルが消えたら入力値を初期化
  $('.modal').on('hidden.bs.modal', function (e) {
    var $form = $(this).find('form');
    $form[0].reset();
    var error = $form.find('#error');
    if(error.length){
      error.remove();
    }
  })

});