<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ПРОВЕРКА НА БОТА (Honeypot)
    // Если скрытое поле заполнено, это бот. Делаем вид, что всё ок, но базу не пачкаем.
    if (!empty($_POST["website"])) {
        header("Location: https://theaisignal.online/thanks.html");
        exit();
    }

    // Забираем email и очищаем от мусора
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    
    // Если это реально похоже на почту
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // 1. Сохраняем лид в базу (CSV)
        $date = date('Y-m-d H:i:s');
        $file = fopen("leads_secure_77x.csv", "a");
        fputcsv($file, array($date, $email));
        fclose($file);

        // 2. Отправляем письмо с PDF-гайдом клиенту
        $subject = "Your free AI Workflow Guide is here";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: The AI Signal <your_email@yourdomain.com>\r\n"; 

        $message = '
        <div style="font-family: Arial, sans-serif; color: #333333; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 20px;">
            <p>Hi,</p>
            
            <p>Here’s your free guide:</p>
            
            <p style="font-size: 18px; font-weight: bold; color: #111;">7 Practical AI Workflows to Save Hours Every Week</p>
            
            <p style="margin: 30px 0;">
                <a href="https://theaisignal.online/files/guide.pdf" style="background-color: #000000; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                    Download the guide
                </a>
            </p>
            
            <p>This is a short, practical resource built for founders, creators, operators, solo builders, and lean teams who want less routine work and more useful output from AI.</p>
            
            <p>You do not need to use all 7 workflows.<br>
            Start with one. Keep what saves time. Drop what doesn’t.</p>
            
            <p>If you want more practical workflows and next steps, head to the Main Hub:</p>
            
            <p style="margin: 30px 0;">
                <a href="YOUR_TELEGRAM_LINK" style="background-color: #2AABEE; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                    Go to the Main Hub
                </a>
            </p>
            
            <p>Best,<br><strong>The AI Signal</strong></p>
        </div>
        ';

        // Функция отправки
 mail($email, $subject, $message, $headers, "-fyour_email@yourdomain.com");
    }
    
    // Моментально кидаем человека на страницу благодарности
    header("Location: https://theaisignal.online/thanks.html");
    exit();
    
} else {
    // Если зашли напрямую по ссылке - кидаем на главную
    header("Location: https://theaisignal.online/");
    exit();
}
?>