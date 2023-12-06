<?php
// Подключаемся к базе данных
$servername = 'localhost';
$username = 'users';
$password = '12345';
$dbname = 'shoh14';
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Удаляем все записи из таблицы students
$sql = "DELETE FROM students";
if (mysqli_query($connection, $sql)) {
    echo "Все записи были успешно удалены из таблицы students";
} else {
    echo "Ошибка при удалении записей из таблицы students: " . mysqli_error($connection);
}

// Закрываем соединение с базой данных
mysqli_close($connection);
?>
