<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<style>
    #cimg {
        max-width: 50%;
        object-fit: contain;
    }
</style>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title"><?php echo isset($id) ? "Manage" : "Создать" ?> пользователя</h5>
</div>

        <body>
        <form method="post" action="">
            <input name="firstname" type="text" placeholder="Имя">
            <input name="lastname" type="text" placeholder="Ф">
            <input type="submit" value="Внести">
        </form>
        </body>
    </div>

        <?php
        if (isset($_POST['firstname']) && isset($_POST['lastname'])){
            // Переменные с формы
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];

            // Параметры для подключения
            $db_host = "localhost";
            $db_user = "root"; // Логин БД
            $db_password = ""; // Пароль БД
            $db_base = 'company_website_db'; // Имя БД
            $db_table = "users"; // Имя Таблицы БД

            try {
                // Подключение к базе данных
                $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
                // Устанавливаем корректную кодировку
                $db->exec("set names utf8");
                // Собираем данные для запроса
                $data = array( 'firstname' => $firstname, 'lastname' => $lastname );
                // Подготавливаем SQL-запрос
                $query = $db->prepare("INSERT INTO $db_table (firstname, lastname) values (:firstname, :lastname)");
                // Выполняем запрос с данными
                $query->execute($data);
                // Запишим в переменую, что запрос отрабтал
                $result = true;
            } catch (PDOException $e) {
                // Если есть ошибка соединения или выполнения запроса, выводим её
                print "Ошибка!: " . $e->getMessage() . "<--br/>";
            }

            if ($result) {
                echo "Успех. Информация занесена в базу данных";
            }
        }
        ?>