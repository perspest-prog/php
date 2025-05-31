<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css">
    <style>
        .calc-container {
            width: 320px;
            margin: 40px auto;
            background: #333;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            padding: 20px;
        }
        .calc-display {
            width: 100%;
            height: 50px;
            font-size: 24px;
            text-align: right;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            padding: 10px;
            background: #fff;
        }
        .calc-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .calc-btn {
            padding: 18px;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            background: #666;
            color: #fff;
            cursor: pointer;
            transition: background 0.2s;
        }
        .calc-btn:hover { background: #888; }
        .calc-btn.op { background: #ff9500; }
        .calc-btn.op:hover { background: #ffaa33; }
        .calc-btn.eq { background: #2196F3; }
        .calc-btn.eq:hover { background: #1976D2; }
        .calc-btn.c { background: #f44336; }
        .calc-btn.c:hover { background: #d32f2f; }
    </style>
</head>
<body>
<div class="calc-container">
    <input type="text" id="display" class="calc-display" value="0" readonly>
    <div class="calc-buttons">
        <button class="calc-btn c" onclick="clearDisplay()">C</button>
        <button class="calc-btn" onclick="backspace()">⌫</button>
        <button class="calc-btn op" onclick="appendToDisplay('(')">(</button>
        <button class="calc-btn op" onclick="appendToDisplay(')')">)</button>

        <button class="calc-btn" onclick="appendToDisplay('7')">7</button>
        <button class="calc-btn" onclick="appendToDisplay('8')">8</button>
        <button class="calc-btn" onclick="appendToDisplay('9')">9</button>
        <button class="calc-btn op" onclick="appendToDisplay('/')">/</button>

        <button class="calc-btn" onclick="appendToDisplay('4')">4</button>
        <button class="calc-btn" onclick="appendToDisplay('5')">5</button>
        <button class="calc-btn" onclick="appendToDisplay('6')">6</button>
        <button class="calc-btn op" onclick="appendToDisplay('*')">*</button>

        <button class="calc-btn" onclick="appendToDisplay('1')">1</button>
        <button class="calc-btn" onclick="appendToDisplay('2')">2</button>
        <button class="calc-btn" onclick="appendToDisplay('3')">3</button>
        <button class="calc-btn op" onclick="appendToDisplay('-')">-</button>

        <button class="calc-btn" onclick="appendToDisplay('0')">0</button>
        <button class="calc-btn" onclick="appendToDisplay('.')">.</button>
        <button class="calc-btn eq" onclick="calculate()">=</button>
        <button class="calc-btn op" onclick="appendToDisplay('+')">+</button>
    </div>
</div>
<script src="index.js"></script>
</body>
</html>
