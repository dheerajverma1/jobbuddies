<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Transaction Confirmation</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta name="google-site-verification" content="OBHSOz2bJypVuqhse4EbUNPh6u4nlzaqmKaLoOryaqs" />
</head>

<body style="background: #eaeaea; font-family: 'Open Sans', sans-serif;">
    <main>
        <div class="email-container" style="margin: 5% 25% 1% 25%; background: #ffffff;">
            <div class="email-body">
                <div class="banner" style="background: blue; color: white; padding: 2em 5em; overflow: hidden;">
                    <h4>Subscription Successful!</h4>
                    <h1 style="font-family: 'Questrial', sans-serif; font-size: 5em; margin: 0 0 .5em 0;">We Feel <span>the Love</span></h1>
                </div>
                <div class="email-content" style="padding: 2em 5em; overflow: hidden;">
                    <p>Hi {{ $user->name }}!</p>
                    <p>Thank you for subscribing. We're so excited to share the latest news and updates about our
                        product
                        with you. If you'd like to learn more, follow us on social media!</p>
                    <hr style="margin-top: 2em; background: blue;">
                    <p>Sincerely,</p>
                    <!-- <p class="sig" style="font-family: 'Dancing Script', cursive; font-size: 3.5em; margin: 0;">Melissa</p> -->
                    <!-- <p><em>Melissa A.</em> -->
                    <br>Superschool</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
