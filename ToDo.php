<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
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
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            display: flex;
            margin-bottom: 15px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        ul li button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        ul li button:hover {
            background-color: darkred;
        }
    </style>
    <script>
        function confirmClear() {
            return confirm("Are you sure you want to clear all tasks?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="task" placeholder="Enter a new task">
                <button type="submit" name="add">Add Task</button>
            </div>
        </form>
        <ul>
            <?php
            $file = "tasks.txt";

            // Handle task addition
            if (isset($_POST['add']) && !empty(trim($_POST['task']))) {
                $task = htmlspecialchars(trim($_POST['task']));
                file_put_contents($file, $task . PHP_EOL, FILE_APPEND);
            }

            // Handle task deletion
            if (isset($_POST['delete'])) {
                $tasks = file($file, FILE_IGNORE_NEW_LINES);
                unset($tasks[$_POST['task_index']]);
                file_put_contents($file, implode(PHP_EOL, $tasks) . PHP_EOL);
            }

            // Handle clearing all tasks
            if (isset($_POST['clear'])) {
                file_put_contents($file, "");
            }

            // Display tasks
            if (file_exists($file)) {
                $tasks = file($file, FILE_IGNORE_NEW_LINES);
                foreach ($tasks as $index => $task) {
                    echo "<li>$task 
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='task_index' value='$index'>
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                          </li>";
                }
            }
            ?>
        </ul>
        <?php if (file_exists($file) && filesize($file) > 0): ?>
            <form method="POST" onsubmit="return confirmClear()">
                <button type="submit" name="clear" style="width: 100%; margin-top: 10px; background-color: orange;">Clear All Tasks</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
