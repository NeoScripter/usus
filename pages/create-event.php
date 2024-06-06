<?php require_once "header.php" ;?>
<?php 
    if ($first_name === '') {
        header("location: reg.php");
    }

    $event_errors = '';
    if (isset($_SESSION['event-error'])) {
        $event_errors = $_SESSION['event-error'];
    } elseif (isset($_SESSION['event-success'])) {
        echo '<script>alert("Мероприятие успешно создано!")</script>';
    }
    unset($_SESSION['event-error'], $_SESSION['event-success']);

    include_once "../classes/dbh.classes.php";
    include_once "../classes/dbh.handler.classes.php";

    $dbhhandler = new DbhHandler();
    $preps = $dbhhandler->fetchPreps();
;?>
        <main>
            <section class="event-form-wrapper">
                <form action="../includes/event.inc.php" class="create-event-form" method="post" id="eventForm">
                    <label for="name">Укажите название мероприятия</label>
                    <input type="text" name="name">
                    <label for="start-date">Выберите дату начала мероприятия</label>
                    <input type="date" name="start-date">
                    <label for="end-date">Выберите дату окончания мероприятия</label>
                    <input type="date" name="end-date">
                    <label for="venue">Выберите место проведения мероприятия</label>
                    <select name="venue">
                        <option value="Выездное">Выездное</option>
                        <option value="Учебный театр">Учебный театр</option>
                        <option value="Концертный зал">Концертный зал</option>
                        <option value="Холл">Холл</option>
                        <option value="137 аудитория">137 аудитория</option>
                        <option value="32 аудитория">32 аудитория</option>
                        <option value="113 аудитория">113 аудитория</option>
                        <option value="132 аудитория">132 аудитория</option>
                        <option value="50 аудитория">50 аудитория</option>
                        <option value="400 аудитория">400 аудитория</option>
                        <option value="302 аудитория">302 аудитория</option>
                    </select>
                    <label for="frequency">Выберите периодичность мероприятия</label>
                    <select name="frequency">
                        <option value="Ежегодное">Ежегодное</option>
                        <option value="Разовое">Разовое</option>
                    </select>
                    <p class="errors"><?php echo $event_errors ;?></p>
                    <button type="submit" class="event-form-btn">Создать</button>
                </form>
                <form action="../includes/prep.inc.php" class="preparation-form" method="post">
                    <div class="checkbox-group">
                        <?php foreach($preps as $prep):?>
                            <label><input type="checkbox" name="preps[]" value="<?php echo $prep['prep_name']; ?>"> <?php echo $prep['prep_name']; ?></label>
                        <?php endforeach;?>
                    </div>
                    <button type="submit" class="prep-form-btn">Скачать</button>
                </form>
            </section>
        </main>
    </div>
    <script src="../assets/js/ajax-event-hd.js"></script>
</body>
</html>