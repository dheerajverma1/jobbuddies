
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Transaction Confirmation</title>
    <style>
        body {
            background: #eaeaea;
            font-family: 'Open Sans', sans-serif;
        }

        .banner {
            background: blue;
            color: white;
        }

        .banner,
        .email-content {
            padding: 2em 5em;
            overflow: hidden;
        }

        h1 {
            font-family: 'Questrial', sans-serif;
            font-size: 5em;
            margin: 0 0 .5em 0;
        }

        hr {
            margin-top: 2em;
            background: blue;
        }

        a {
            text-decoration: none;
        }

        .sig {
            font-family: 'Dancing Script', cursive;
            font-size: 3.5em;
            margin: 0;
        }

        .email-container {
            margin: 5% 25% 1% 25%;
            background: #ffffff;
        }

        footer {
            text-align: center;
            margin: 0;
            padding: 1em;
        }
    </style>
</head>

<body>
    <main>
        <div class="email-container">
            <div class="email-body">
                <div class="banner">
                    <h4>Subscription Successful!</h4>
                    <h1>We Feel <span>the Love</span></h1>
                </div>
                <div class="email-content">
                    <p>Hi {{ $user->name }}!</p>
                    <p>Thank you for subscribing. We're so excited to share the latest news and updates about our
                        product
                        with you. If you'd like to learn more, follow us on social media!</p>
                    <hr>
                    <p>Sincerely,</p>
                    <br>Superschool</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
