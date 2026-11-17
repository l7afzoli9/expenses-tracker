<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';

$id = $_SESSION['user_id'];

$sql = 'select
            e.expense_date, c.name, e.amount, e.note
        from expenses as e
        inner join categories as c
        on e.category_id = c.id
        where e.user_id = ?
        order by e.expense_date desc';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$data = $stmt->fetchAll();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="expenses.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Date', 'Category', 'Amount', 'Note']);
foreach ($data as $e) {
    fputcsv($output, $e);
}

fclose($output);