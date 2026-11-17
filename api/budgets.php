<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$method  = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getBudgets($pdo, $user_id);
        break;
    case 'POST':
        postBudget($pdo, $user_id);
        break;
    case 'PUT':
        putBudget($pdo, $user_id);
        break;
    case 'DELETE':
        deleteBudget($pdo, $user_id);
         break;  
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

function getBudgets(PDO $pdo, int $user_id): void
{
    $month = $_GET['month'] ?? date('m');
    $year  = $_GET['year']  ?? date('Y');

    $sql = 'select b.id, b.amount, b.month, b.year, c.name as category_name
            from budgets b
            join categories c ON b.category_id = c.id
            where b.user_id = ? AND b.month = ? AND b.year = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $month, $year]);
    $budgets = $stmt->fetchAll();

    http_response_code(200);
    echo json_encode($budgets);
}

function postBudget(PDO $pdo, int $user_id): void
{
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    if (empty($data['category_id']) || empty($data['amount'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Amount and Category are required']);
        return;
    }

    $sql = 'insert into budgets (user_id, category_id, amount, month, year)
            values (?, ?, ?, ?, ?)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user_id,
        $data['category_id'],
        $data['amount'],
        $data['month'] ?? date('m'),
        $data['year']  ?? date('Y'),
    ]);

    http_response_code(201);
    echo json_encode(['msg' => 'Budget Added']);
}

function putBudget(PDO $pdo, int $user_id): void
{
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    if (empty($data['id']) || empty($data['category_id']) || empty($data['amount'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID, Amount, and Category are required']);
        return;
    }

    $sql = 'update budgets 
            set category_id = ?, amount = ?, month = ?, year = ?
            where id = ? AND user_id = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['category_id'],
        $data['amount'],
        $data['month'] ?? date('m'),
        $data['year']  ?? date('Y'),
        $data['id'],
        $user_id
    ]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Budget not found or no changes made']);
        return;
    }

    http_response_code(200);
    echo json_encode(['msg' => 'Budget updated']);
}

function deleteBudget(PDO $pdo,int $user_id):void{
    $budget_id = $_GET['budget_id'] ?? null;

    if (!$budget_id) {
        http_response_code(400);
        echo json_encode(['error' => 'Id is Required']);
        return;
    }

    $sql = 'delete from budgets
            where id = ? and user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$budget_id, $user_id]);

    if ($stmt->rowCount() == 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Budget not found']);
        return;
    }

    http_response_code(200);
    echo json_encode(['msg' => 'Budget Deleted']);
}
  