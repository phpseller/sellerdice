<?php
// التوكن الخاص بالبوت
$bot_token = '7899259056:AAHJSaV7U-k989hhVEl5YXiBk8R_yjDxPLc';
$api_url = "https://api.telegram.org/bot$bot_token/";

// الحصول على بيانات التحديث من تليجرام
$content = file_get_contents("php://input");
$update = json_decode($content, TRUE);

// التحقق من وجود أمر /start
if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $first_name = $update["message"]["from"]["first_name"];

    // التحقق مما إذا كان المستخدم قد أرسل أمر /start
   if (isset($update["message"]["text"])) {
        // رسالة الترحيب
        $welcome_message = "Hi $first_name! 🌟\n";
        $welcome_message .= "\nSubscribe to our channel 😊\n";
        $welcome_message .= "https://t.me/HamsterDiamondCodes\n ";
        $welcome_message .= "\nNow you can click the button Collect💎";

        // إعداد زر مع Web App لفتح الموقع بملء الشاشة
        $inline_keyboard = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Collect💎', 
                        'web_app' => ['url' => 'https://bi3wechri.net/H'] // رابط التطبيق
                    ]
                ]
            ]
        ];

        // إعداد البيانات لإرسال الرسالة
        $post_fields = [
            'chat_id' => $chat_id,
            'text' => $welcome_message,
            'reply_markup' => json_encode($inline_keyboard)
        ];

        // إرسال رسالة الترحيب مع الزر
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url . "sendMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
?>
