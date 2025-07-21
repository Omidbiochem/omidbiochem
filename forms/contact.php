<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars(strip_tags(trim($_POST["subject"])));
  $message = htmlspecialchars(trim($_POST["message"]));

  if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "⚠️ لطفاً همه فیلدها را به‌درستی پر کنید.";
    exit;
  }

  $recipient = "OMIDJUDI66@GMAIL.COM";
  $email_subject = "📬 پیام از سایت - موضوع: $subject";

  $email_content  = "👤 نام فرستنده: $name\n";
  $email_content .= "📧 ایمیل: $email\n";
  $email_content .= "🖊 موضوع: $subject\n\n";
  $email_content .= "📨 پیام:\n$message\n\n";
  $email_content .= "🌐 IP: " . $_SERVER['REMOTE_ADDR'] . "\n";

  $email_headers = "From: $name <$email>";

  if (mail($recipient, $email_subject, $email_content, $email_headers)) {
    http_response_code(200);
    echo "✅ پیام شما با موفقیت ارسال شد. ممنونم عزیز دلم!";
  } else {
    http_response_code(500);
    echo "❌ ارسال پیام با خطا مواجه شد. لطفاً دوباره تلاش کنید.";
  }

} else {
  http_response_code(403);
  echo "⛔ دسترسی غیرمجاز.";
}
?>
