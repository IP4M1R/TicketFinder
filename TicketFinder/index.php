<?php

$tickets = [
    ["from" => "Tehran", "to" => "Mashhad", "type" => "Air", "price" => 1200000, "link" => "https://www.example.com/ticket1"],
    ["from" => "Tehran", "to" => "Mashhad", "type" => "Ground", "price" => 300000, "link" => "https://www.example.com/ticket2"],
    ["from" => "Isfahan", "to" => "Tabriz", "type" => "Air", "price" => 1500000, "link" => "https://www.example.com/ticket3"],
    ["from" => "Isfahan", "to" => "Tabriz", "type" => "Ground", "price" => 350000, "link" => "https://www.example.com/ticket4"],
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = trim($_POST["from"]);
    $to = trim($_POST["to"]);
    $type = $_POST["type"];
    

    if (!empty($from) && !empty($to)) {
        $availableTickets = array_filter($tickets, function($ticket) use ($from, $to, $type) {
            return $ticket["from"] == $from && $ticket["to"] == $to && $ticket["type"] == $type;
        });
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2, h3 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input, select {
            padding: 10px;
            margin: 5px;
            width: 200px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 8px;
            background-color: #fff;
            margin: 5px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Search for Tickets</h2>
    
    <?php if (isset($errorMessage)): ?>
        <p class="error"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    
    <form method="post">
        <label>From:</label>
        <input type="text" name="from" required>
        <label>To:</label>
        <input type="text" name="to" required>
        <label>Travel Type:</label>
        <select name="type">
            <option value="Air">Air</option>
            <option value="Ground">Ground</option>
        </select>
        <button type="submit">Search</button>
    </form>
    
    <?php if (isset($availableTickets) && count($availableTickets) > 0): ?>
        <h3>Available Tickets:</h3>
        <ul>
            <?php foreach ($availableTickets as $ticket): ?>
                <li>From <?php echo $ticket["from"] ?> to <?php echo $ticket["to"] ?> - <?php echo $ticket["type"] ?> - Price: <?php echo number_format($ticket["price"]) ?> IRR - <a href="<?php echo $ticket["link"] ?>" target="_blank">View and Buy</a></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($availableTickets)): ?>
        <p>No tickets found.</p>
    <?php endif; ?>
</body>
</html>