<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';



header('Content-type: application/json');

$sql = 'select 
            c.name as category, 
            ifnull(e.total_expenses, 0) as expenses, 
            ifnull(b.amount, 0) as budgets
        from categories as c
        left join (
            select 
                category_id, 
                sum(amount) as total_expenses
            from expenses
            where 
                user_id = ? and
                month(expense_date) = ? and 
                year(expense_date) = ?
            group by category_id
        ) as e on c.id = e.category_id
        left join budgets as b on 
            c.id = b.category_id and 
                b.user_id = ? and
            b.month = ? and 
            b.year = ?; 
            ';

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['user_id'],
    $_GET['month'] ?? date('m'),
    $_GET['year'] ?? date('Y'),
    $_SESSION['user_id'],
    $_GET['month'] ?? date('m'),
    $_GET['year'] ?? date('Y'),
]);
$data = $stmt->fetchAll();
echo json_encode($data ?: []);
