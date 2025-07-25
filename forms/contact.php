<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$token = '7965471734:AAGpHbfFwDCfqgMArD5oZuJfO7dJ4xYbLvc';
$chat_id = '6606697793';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $source = htmlspecialchars(trim($_POST['source'] ?? 'نامشخص'));

    if (!$message) {
        exit("❌ پیام نمی‌تواند خالی باشد");
    }

    $text = "📩 پیام جدید از $source:\n👤 نام: $name\n📝 پیام: $message";

    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = ['chat_id' => $chat_id, 'text' => $text];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result !== false) {
        echo "<script>alert('✅ پیام شما ارسال شد'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('❌ ارسال نشد، لطفا بررسی کنید.'); window.location.href='../index.html';</script>";
    }
} else {
    echo "🔒 این فرم فقط برای ارسال POST است.";
    exit;
}


