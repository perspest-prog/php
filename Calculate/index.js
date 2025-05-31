let display = document.getElementById('display');
let current = '';
function appendToDisplay(val) {
    if (display.value === '0' && val !== '.') {
        current = val;
    } else {
        current += val;
    }
    display.value = current;
}
function clearDisplay() {
    current = '';
    display.value = '0';
}
function backspace() {
    if (current.length > 1) {
        current = current.slice(0, -1);
        display.value = current;
    } else {
        current = '';
        display.value = '0';
    }
}
function calculate() {
    if (!current) return;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'backend.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const res = JSON.parse(xhr.responseText);
                if (res.result !== undefined) {
                    display.value = res.result;
                    current = res.result;
                } else if (res.error) {
                    display.value = res.error;
                    current = '';
                }
            } catch (e) {
                display.value = 'Ошибка';
                current = '';
            }
        }
    };
    xhr.send('expression=' + encodeURIComponent(current));
}
document.addEventListener('keydown', function(e) {
    if (e.key >= '0' && e.key <= '9') appendToDisplay(e.key);
    if (["+","-","*","/","(",")","."].includes(e.key)) appendToDisplay(e.key);
    if (e.key === 'Enter') calculate();
    if (e.key === 'Escape') clearDisplay();
    if (e.key === 'Backspace') backspace();
}); 