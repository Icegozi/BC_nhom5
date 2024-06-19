<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Online Store</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        /* Để footer không che phủ nội dung chính */
    }

    .footer {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
        width: 97.3%;
    }

    .footer a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer .social-icons {
        margin-top: 10px;
    }

    .footer .social-icons a {
        display: inline-block;
        width: 30px;
        height: 30px;
        background-color: #fff;
        border-radius: 50%;
        line-height: 30px;
        text-align: center;
        margin: 0 5px;
        color: #333;
        font-size: 18px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .footer .social-icons a:hover {
        background-color: #666;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="content">
        <!-- Your content here -->
    </div>
    <footer class="footer">
        <div class="footer-links">
            <a href="#">Home</a>
            <a href="#">Products</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="contact-info">
            <p>Email: contact@example.com</p>
            <p>Phone: +1234567890</p>
        </div>
        <div class="social-icons">
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">Twitter</a>
            <a href="#" target="_blank">Instagram</a>
            <a href="#" target="_blank">LinkedIn</a>
        </div>
        <p>&copy; 2024 Sample Online Store. All rights reserved.</p>
    </footer>
</body>

</html>