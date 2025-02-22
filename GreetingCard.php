<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Greeting Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .greeting-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
    <script>
        function validateForm() {
            const name = document.forms["greetingForm"]["name"].value.trim();
            const message = document.forms["greetingForm"]["message"].value.trim();
            if (name === "" || message === "") {
                alert("Both Name and Message are required!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Create Your Greeting Card</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php
                $name = htmlspecialchars($_POST["name"]);
                $message = htmlspecialchars($_POST["message"]);
                $color = htmlspecialchars($_POST["color"]);
            ?>
            <div class="greeting-card" style="background-color: <?= $color ?>;">
                <h2>Hello, <?= $name ?>!</h2>
                <p><?= $message ?></p>
            </div>
            <a href="/GreetingCard.php" style="display: block; text-align: center; margin-top: 15px;">Create Another</a>
        <?php else: ?>
            <form name="greetingForm" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Recipient's Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Write your message"></textarea>
                </div>
                <div class="form-group">
                    <label for="color">Card Color</label>
                    <select id="color" name="color">
                        <option value="#ffcccb">Light Red</option>
                        <option value="#d4edda">Light Green</option>
                        <option value="#cce5ff">Light Blue</option>
                        <option value="#fff3cd">Light Yellow</option>
                    </select>
                </div>
                <button type="submit">Generate Card</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
