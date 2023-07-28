<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function callChatGPT() {
            // 質問の入力値を取得
            var question = document.getElementById('question').value;

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
                    document.getElementById('response').innerText = xhr.responseText;
                    console.log('xhr response success')
                } else {
                    // エラーメッセージを表示
                    document.getElementById('response').innerText = 'エラー：サーバーからのレスポンスがありませんでした。';
                }
            };

            // リクエスト送信
            xhr.send();
        }
    </script>
</head>
<body>
    <h1>ChatGPT ボタンクリック</h1>

    <input type="text" id="question" placeholder="質問を入力してください">
    <button onclick="callChatGPT()">ChatGPTに質問する</button>

    <div id="response"></div>
</body>
</html>