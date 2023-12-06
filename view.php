<?php
// Подключаем файл с функцией для отображения ячеек таблицы
include('table-cell.php');

// Подключаемся к базе данных
$conn = mysqli_connect('localhost', 'users', '12345', 'shoh14');

// Получаем данные из таблицы students
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

// Создаем HTML-таблицу
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Имя</th>';
echo '<th>Фамилия</th>';
echo '<th>Личный код</th>';
echo '<th>Курс</th>';
echo '<th>Email</th>';
echo '</tr>';

// Выводим данные из таблицы
while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo table_cell($row['id']);
    echo table_cell($row['first_name']);
    echo table_cell($row['last_name']);
    echo table_cell($row['isikukood']);
    echo table_cell($row['grade']);
    echo table_cell($row['email']);
    echo '</tr>';
}

echo '</table>';

// Закрываем соединение с базой данных
mysqli_close($conn);
?>

