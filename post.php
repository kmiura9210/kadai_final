<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規記事作成</title>
    <script>
        function callChatGPT() {
            // 質問の入力値を取得
            // var question = document.getElementById('question').value;
            var when = "「" + document.getElementById('when').value + "」";
            var where = "「" + document.getElementById('where').value + "」";
            var who = "「" + document.getElementById('who').value + "」";
            var what = "「" + document.getElementById('what').value + "」";
            var why = "「" + document.getElementById('why').value + "」";
            var how = "「" + document.getElementById('how').value + "」";
            var question = when + where + who + what + why + how

            // AJAXリクエストを作成
            var xhr = new XMLHttpRequest();

            // PHPスクリプトのパスを指定
            var url = 'gptchan.php?question=' + encodeURIComponent(question);
            xhr.open('GET', url, true);

            console.log('xhr success')

            // レスポンス受信時の処理
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // レスポンスを表示
                    // document.getElementById('response').innerText = xhr.responseText;
                    document.getElementById('content').value = xhr.responseText;
                    console.log('xhr response success')
                } else {
                    // エラーメッセージを表示
                    document.getElementById('content').innerText = 'エラー：サーバーからのレスポンスがありませんでした。';
                }
            };

            // リクエスト送信
            xhr.send();
        }
    </script>
</head>

<body>
    <!-- ヘッダー読み込み -->
    <?php include "header.html" ?>

    <fieldset>
        <!-- AIモード -->
        <legend>AI記者モード</legend>
        <p>5W1Hの入力で記事案を作成できます</p>
        <label>When（いつ）<br><textArea id="when" name="when" rows="4" cols="40"></textArea></label><br>
        <label>Where（どこで）<br><textArea id="where" name="where" rows="4" cols="40"></textArea></label><br>
        <label>Who（だれが）<br><textArea id="who" name="who" rows="4" cols="40"></textArea></label><br>
        <label>What（なにをした）<br><textArea id="what" name="what" rows="4" cols="40"></textArea></label><br>
        <label>Why（なぜ）<br><textArea id="why" name="why" rows="4" cols="40"></textArea></label><br>
        <label>How（どのように）<br><textArea id="how" name="how" rows="4" cols="40"></textArea></label><br>
        <button onclick="callChatGPT()">記事案作成</button>
    </fieldset>

    <!-- 記事の入力ができる部分 -->
    <form method="post" action="./insert.php">
        <label>タイトル<br><textArea name="title" rows="1" cols="40"></textArea></label><br>
        <label>本文<br><textArea id="content" name="content" rows="4" cols="40"></textArea></label><br>
        <input type="submit" value="送信">
    </form>
</body>

</html>