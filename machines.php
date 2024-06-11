<?php
$apiUrl = 'http://localhost:8080/api/machines';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['name' => $_POST['name'], 'status' => $_POST['status']];
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

$machines = file_get_contents($apiUrl);
$machines = json_decode($machines, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Machines</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Machines</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($machines as $machine): ?>
            <tr>
                <td><?php echo htmlspecialchars($machine['name']); ?></td>
                <td><?php echo htmlspecialchars($machine['status']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="<?php echo $machine['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2 class="my-4">Add Machine</h2>
    <form method="post">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control">
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
