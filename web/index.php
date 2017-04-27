<!DOCTYPE html>
<html>
<head>
    <title>Temperatur & Luftfeuchtigkeit</title>
</head>
<body>
    <canvas id="temp" width="400" height="80"></canvas>
    <canvas id="humidity" width="400" height="80"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.1/Chart.bundle.min.js"></script>
    <script src="data.php?type=<?php echo $_GET['type']; ?>"></script>
    <script src="js/script.js"></script>

    <form method="GET">
        Ansicht wählen:
        <select id="types" name="type" onchange="this.form.submit()">
            <option>--</option>
            <?php $types = [
                'year' => 'Jahr',
                'month' => 'Monat',
                'week' => 'Woche',
                'day' => 'Tag',
                '3hours' => '3 Stunden',
                'hour' => 'Stunde',
            ];
            foreach ($types as $type => $label): ?>
                <option
                    value="<?php echo $type; ?>"
                    <?php
                        if ($type === $_GET['type']) {
                            echo ' selected';
                        }
                    ?>
                    ><?php echo $label; ?></option>
            <?php endforeach; ?>
        </select>
    </form>
</body>
</html>
