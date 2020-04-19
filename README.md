# twaddry

ツイッター風の会員登録制掲示板WEBアプリです。名前の由来は「くだらぬことを書く」という意味の「twaddle」という単語に「diary」を組み合わせてもじったものです。200字以内で日々思ったことを書き記せます。（140字だとやや書ききれないことが多かったので。）

## 使用言語

- PHP (DBはMySQL)
- Javascript (jQuery)
- CSSフレームワークはBootstrap

## 実装内容とポイント

- データベースによる情報管理
  - PHPのクラスを用いることでDB上での処理をカプセル化
    - マジックメソッド__callを用いることで共通処理をまとめた（本来の使い方としては正しくないかもしれないが）
  - テーブルのクラスを作ることでテーブルの追加はインスタンス化のみで容易に可能
- アカウントの新規登録とログイン機能
  - ユーザーIDはユニークなため新規登録のさいのユーザーIDが使用済みかのチェック。
  - ログインのさいのパスワードのコンファーム機能
- 新規投稿および自分の投稿の編集・削除機能
  - ログインしているときのみ新規投稿可能
    - ログイン情報はセッションで管理
  - 編集・削除はマイページにて可能
    - セッションが切れた状態でマイページに入るとトップへリダイレクト
  - 文字数カウント機能およびテキストエリアのリサイズ機能
    - jQueryのon()でテキストボックスの入力をリアルタイムに監視、空白および200字より多いテキストは送信ボタンを無効
    - 改行でテキストボックスのサイズを自動でリサイズ（autosize.js使用）、最大で10行まで改行可能
- 投稿の閲覧機能
  - トップページでは全ユーザーの全投稿、ユーザー名をクリックすることでユーザーページに飛びその人の全投稿を閲覧可能
    - 投稿データのテーブルは最初に投稿した日時と編集して更新した日時を保存、更新日時順でデータを問い合わせ上から新しい順に表示
- ajaxによるフォーム送信の非同期通信化
  - フォーム（投稿、ログイン、新規登録）はすべてモーダルウィンドウで表示、かつajax送信を使用することで非遷移化
  - モーダルウィンドウを消したときフォームの入力値を初期化
- レスポンシブな固定ナビメニュー


## デモ

ユーザーID：ryunosuke_akutagawa、パスワード：0000でログイン可能

https://twaddry.herokuapp.com/

## 今後実装したい機能
- 返信機能
- フォロー機能
- スレッド
- 投稿の下書き保存
- リアルタイムチャット
  - ajaxで疑似的に実装してみたがサーバーへの負荷が大きすぎるので却下（PHPでは非現実的か）