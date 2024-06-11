<?php
$apiUrl = 'http://localhost:8080/api/orders';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'product' => $_POST['product'],
        'quantity' => $_POST['quantity'],
        'startTime' => $_POST['startTime'],
        'endTime' => $_POST['endTime'],
        'status' => $_POST['status']
    ];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents($apiUrl, false, $context);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'delete') {
    $id = $_POST['id'];
    $options = [
        'http' => [
            'method'  => 'DELETE',
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents("$apiUrl/$id", false, $context);
}

$orders = file_get_contents($apiUrl);
$orders = json_decode($orders, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Orders</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['product']); ?></td>
                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                <td><?php echo htmlspecialchars($order['startTime']); ?></td>
                <td><?php echo htmlspecialchars($order['endTime']); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2 class="my-4">Add Order</h2>
    <form method="post">
        <div class="form-group">
            <label>Product:</label>
            <input type="text" name="product" class="form-control">
        </div>
        <div class="form-group">
            <label>Quantity:</label>
            <input type="number" name="quantity" class="form-control">
        </div>
        <div class="form-group">
            <label>Start Time:</label>
            <input type="datetime-local" name="startTime" class="form-control">
        </div>
        <div class="form-group">
            <label>End Time:</label>
            <input type="datetime-local" name="endTime" class="form-control">
        </div>
        <div class="form-group">
            <label>Status:</label>
            <input type="text" name="status" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    <a href="index.php" class="btn btn-secondary my-4">Back</a>
</div>
</body>
</html>
