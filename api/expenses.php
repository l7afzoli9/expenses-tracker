<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$methode = $_SERVER['REQUEST_METHOD'];

if ($methode == 'GET') {
    getExpenses($pdo, $user_id);
} elseif ($methode == 'POST') {
    postExpenses($pdo, $user_id);
} elseif ($methode == 'PUT') {
    putExpenses($pdo, $user_id);
} elseif ($methode == 'DELETE') {
    deleteExpenses($pdo, $user_id);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

function getExpenses(PDO $pdo, int $user_id): void
{
    if (isset($_GET['expense_id'])) {
        $stmt = $pdo->prepare(
            'select e.id, e.amount, e.note, e.expense_date, e.category_id,
                    c.name as category
             from expenses e
             inner join categories c on e.category_id = c.id
             where e.id = ? and e.user_id = ?'
        );
        $stmt->execute([$_GET['expense_id'], $user_id]);
        echo json_encode($stmt->fetch() ?: []);
        return;
    }

    $month = (int) ($_GET['month'] ?? date('m'));
    $year  = (int) ($_GET['year']  ?? date('Y'));

    $sql = 'select e.id, e.amount, e.note, e.expense_date, c.name as category
            from expenses as e
            inner join categories as c
            on e.category_id = c.id
            where e.user_id = ? and month(e.expense_date) = ? and year(e.expense_date) = ?
            order by e.expense_date desc, e.id desc';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $month, $year]);
    echo json_encode($stmt->fetchAll() ?: []);
}

function postExpenses(PDO $pdo, int $user_id): void
{
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['amount']) || empty($data['category_id']) || empty($data['date'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Amount, Category and Date are required']);
        return;
    }

    $sql = 'insert into expenses (user_id, category_id, amount, note, expense_date)
            values (?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user_id,
        $data['category_id'],
        $data['amount'],
        $data['note'] ?? '',
        $data['date']
    ]);

    http_response_code(201);
    echo json_encode(['msg' => 'Expense Added']);
}

function putExpenses(PDO $pdo, int $user_id): void
{
    $expense_id = $_GET['expense_id'] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$expense_id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is Required']);
        return;
    }
    if (empty($data['amount']) || empty($data['category_id']) || empty($data['date'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Amount, Category and Date are required']);
        return;
    }

    $sql = 'update expenses
            set amount = ?, note = ?, category_id = ?, expense_date = ?
            where id = ? and user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['amount'],
        $data['note'] ?? '',
        $data['category_id'],
        $data['date'],
        $expense_id,
        $user_id
    ]);

    if ($stmt->rowCount() == 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Expense not found']);
        return;
    }

    http_response_code(200);
    echo json_encode(['msg' => 'Expense updated']);
}

function deleteExpenses(PDO $pdo, int $user_id): void
{
    $expense_id = $_GET['expense_id'] ?? null;

    if (!$expense_id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is Required']);
        return;
    }

    $sql = 'delete from expenses
            where id = ? and user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$expense_id, $user_id]);

    if ($stmt->rowCount() == 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Expense not found']);
        return;
    }

    http_response_code(200);
    echo json_encode(['msg' => 'Expense Deleted']);
}