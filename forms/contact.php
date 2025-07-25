<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$token = '7965471734':AAGpHbfFwDCfqgMArD5oZuJfO7dJ4xYbLvc';
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

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
    ]);

    $result = curl_exec($ch);
    $response = json_decode($result, true);
    curl_close($ch);

    if ($response && isset($response['ok']) && $response['ok']) {
        echo "<script>alert('✅ پیام شما ارسال شد'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('❌ ارسال نشد، لطفاً بعداً دوباره تلاش کنید.'); window.location.href='../index.html';</script>";
    }
} else {
    echo "🔒 این فرم فقط برای ارسال POST است.";
    exit;
}
