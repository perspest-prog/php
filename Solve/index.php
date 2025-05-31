<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <?php
      $equation = "4 * X = 36";
      $array = explode(" ", $equation);

      $first = $array[0];
      $second = $array[2];
      $result = $array[4];
      $answer = '';

      switch($array[1]) { // operator
      case '*':
        if ($first === 'X') {
          global $answer;
          $answer = intval($result) / intval($second);
        }
        else if ($second === 'X') {
          global $answer;
          $answer = intval($result) / intval($first);
        }
      break;
      case '/':
        if ($first === 'X') {
          global $answer;
          $answer = intval($result) * intval($second);
        }
        else if ($second === 'X') {
          global $answer;
          $answer = intval($result) * intval($first);
        }
      break;
      case '+':
        if ($first === 'X') {
          global $answer;
          $answer = intval($result) - intval($second);
        }
        else if ($second === 'X') {
          global $answer;
          $answer = intval($result) - intval($first);
        }
      break;
      case '-':
        if ($first === 'X') {
          global $answer;
          $answer = intval($result) + intval($second);
        }
        else if($second === 'X') {
          global $answer;
          $answer = intval($first) - intval($result);
        }
    }
    echo '<p>Ответ: '.$answer.'</p>';
    ?>
  </body>
</html>