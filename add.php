<?php
// функция валидации email
function validate_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

// функция валидации isikukood
function validate_isikukood($isikukood) {
    if (!ctype_digit($isikukood) || strlen($isikukood) != 11) {
        return false;
    }
    return true;
}

// функция преобразования имени и фамилии
function format_name($name) {
    return ucwords(strtolower($name));
}

// функция преобразования email в lowercase
function format_email($email) {
    return strtolower($email);
}

// обработка формы
if (isset($_POST['submit'])) {
    // подключение к базе данных
    $servername = "localhost";
    $username = "users";
    $password = "12345";
    $dbname = "shoh14";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // получение данных из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $isikukood = $_POST['isikukood'];
    $grade = $_POST['grade'];
    $email = $_POST['email'];

    // проверка обязательных полей
    if (empty($last_name) || empty($first_name) || empty($isikukood) || empty($grade) || empty($email)) {
        echo "Заполните все обязательные поля!";
    } else {
        // проверка email и isikukood
        if (!validate_email($email)) {
            echo "Некорректный адрес email!";
        } elseif (!validate_isikukood($isikukood)) {
            echo "Некорректный личный код!";
        } else {
            // преобразование имени и фамилии и email
            $last_name = format_name($last_name);
            $first_name = format_name($first_name);
            $email = format_email($email);

            // добавление записи в БД
            $sql = "INSERT INTO students (last_name, first_name, isikukood, grade, email) VALUES ('$last_name', '$first_name', '$isikukood', '$grade', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "Запись успешно добавлена: $first_name $last_name добавлен в базу данных!";
            } else {
                echo "Ошибка при добавлении записи: " . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

