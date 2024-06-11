<?php
$apiUrl = 'http://localhost:8080/api/reports';
$reports = file_get_contents($apiUrl);
$reports = json_decode($reports, true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>
<h1>Reports</h1>
<ul>
    <?php foreach ($reports as $report): ?>
        <li><?php echo htmlspecialchars($report['description'] . ' - ' . $report['createdDate']); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
