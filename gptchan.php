<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 質問内容を取得
    $question = $_GET['question'];


    // OpenAI APIのエンドポイント
    $apiEndpoint = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    $url = "https://api.openai.com/v1/chat/completions";

    // OpenAI APIキー
    $apiKey = '';

    // リクエストヘッダー
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ];

    // リクエストボディ
    // $data = [
    //     'model' => "text-davinci-003",
    //     'prompt' => $question, // 質問のプロンプト
    //     'max_tokens' => 50, // 応答の最大トークン数
    //     'temperature' => 0.6, // 応答の多様性。0.0から1.0の範囲で設定（0.0は最も確実な応答、1.0は最も多様な応答）
    //     'top_p' => 1.0, // トークンの確率分布の上位範囲。0.0から1.0の範囲で設定（1.0は全範囲）
    //     'n' => 1, // 生成する応答の数
    //     'stop' => ['\n'] // 応答の終了条件
    // ];

    $data = array(
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ["role" => "system", "content" => "次のフレーズを使って、200字以内で新聞記事を作ってください。"],
            ['role' => 'user', 'content' => $question],
        ],
        'max_tokens' => 500,
      );


    // $data = array(
    //     'model' => 'gpt-3.5-turbo',
    //     'messages' => [
    //       [
    //       "role" => "system",
    //       "content" => "日本語で応答してください"
    //       ],
    //       [
    //       "role" => "user",
    //       "content" => $question
    //       ]
    //     ]



    
    // POSTリクエストの送信
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    
    $response = curl_exec($ch); 
    curl_close($ch); 

    // レスポンスの処理
    if ($response === false) {
        echo 'エラー：APIリクエストが失敗しました。';
    } else {
        $responseData = json_decode($response, true);
        $answer = $responseData["choices"][0]["message"]["content"];
        echo $answer;
    }
}
