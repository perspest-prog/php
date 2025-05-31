<?php
header('Content-Type: application/json');

function isValid($expr) {
    return preg_match('/^[0-9+\-*\/(). ]+$/', $expr);
}

function calc($expr) {
    $expr = str_replace(' ', '', $expr);
    if (!isValid($expr)) throw new Exception('Недопустимые символы');
    $brackets = 0;
    for ($i = 0; $i < strlen($expr); $i++) {
        if ($expr[$i] == '(') $brackets++;
        if ($expr[$i] == ')') $brackets--;
        if ($brackets < 0) throw new Exception('Ошибка скобок');
    }
    if ($brackets != 0) throw new Exception('Ошибка скобок');
    return evalExpr($expr);
}

function evalExpr($expr) {
    if (strpos($expr, '(') !== false) {
        $start = strrpos($expr, '(');
        $end = strpos($expr, ')', $start);
        if ($end === false) throw new Exception('Ошибка скобок');
        $in = substr($expr, $start + 1, $end - $start - 1);
        $val = evalExpr($in);
        $expr = substr($expr, 0, $start) . $val . substr($expr, $end + 1);
        return evalExpr($expr);
    }
    return evalSimple($expr);
}

function evalSimple($expr) {
    $ops = ['+', '-', '*', '/'];
    foreach(['+', '-'] as $op) {
        $pos = strrpos($expr, $op);
        if ($pos > 0) {
            $left = substr($expr, 0, $pos);
            $right = substr($expr, $pos + 1);
            if ($op == '+') return evalSimple($left) + evalSimple($right);
            if ($op == '-') return evalSimple($left) - evalSimple($right);
        }
    }
    foreach(['*', '/'] as $op) {
        $pos = strrpos($expr, $op);
        if ($pos > 0) {
            $left = substr($expr, 0, $pos);
            $right = substr($expr, $pos + 1);
            if ($op == '*') return evalSimple($left) * evalSimple($right);
            if ($op == '/') {
                if (evalSimple($right) == 0) throw new Exception('Деление на 0');
                return evalSimple($left) / evalSimple($right);
            }
        }
    }
    if (is_numeric($expr)) return $expr + 0;
    throw new Exception('Ошибка');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    try {
        $result = calc($_POST['expression']);
        echo json_encode(['result' => $result]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

echo json_encode(['error' => 'Неверный запрос']); 