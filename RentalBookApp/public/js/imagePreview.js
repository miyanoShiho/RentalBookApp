$(function(){
    $('#bookImagePath').change(function(e){
      //ファイルオブジェクトを取得
      var file = e.target.files[0];
      var reader = new FileReader();
   
      //画像でない場合は処理終了
      if(file.type.indexOf("image") < 0){
        alert("画像ファイルを指定してください。");
        return false;
      }
   
      //アップロードした画像を設定
      reader.onload = (function(file){
        return function(e){
          $("#bookImageDisplay").attr("src", e.target.result);
          $("#bookImageDisplay").attr("title", file.name);
        };
      })(file);
      reader.readAsDataURL(file);
   
    });
  });