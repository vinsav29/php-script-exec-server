<html>
<head>
    <title>Web server</title>

    <style>
        .div_log {
            height: 200px; /* высота нашего блока */
            width: 400px; /* ширина нашего блока */
            background: #fff; /* цвет фона, белый */
            border: 1px solid #C1C1C1; /* размер и цвет границы блока */
            overflow-x: auto; /* прокрутка по горизонтали */
            overflow-y: auto; /* прокрутка по вертикали */
        }
    </style>

</head>

<body onload="scrollBottom()" >
<div id ="wrapper">

<h1>Linux services control</h1>

<hr />

<form action="index.php" method='post'>
    <p>NTPD</p>
    <input type="submit" name="ntpd" value="start">
    <input type="submit" name="ntpd" value="stop">
    <input type="submit" name="ntpd" value="restart">

    <?php
    $action = $_POST['ntpd'];
    if (!empty($action)) {
        switch ($action)
        {
            case 'start':
                $output = shell_exec('bash /etc/init.d/ntp start');
                break;
            case 'stop' :
                $output = shell_exec('bash /etc/init.d/ntp stop');
                break;
            case 'restart' :
                $output = shell_exec('bash /etc/init.d/ntp restart');
                break;
        }
    } else {
//        echo $ntpd_start_off;
    }
    ?>
</form>

<hr />

<form action="index.php" method="post">
    <p>GPSD</p>
    <input type="submit" name="gpsd" value="start">
    <input type="submit" name="gpsd" value="stop">
    <input type="submit" name="gpsd" value="restart">

    <?php
    $action = $_POST['gpsd'];
    if (!empty($action)) {
        unset($_POST);
        switch ($action)
        {
            case 'start':
                $output = shell_exec('bash /etc/init.d/gpsd start');
                break;
            case 'stop' :
                $output = shell_exec('bash /etc/init.d/gpsd stop');
                break;
            case 'restart' :
                $output = shell_exec('bash /etc/init.d/gpsd restart');
                break;
        }
    } else {
//    echo $gpsd_start_off;
    }

    ?>
</form>

<hr />

<form method="post">
    <p>Logs</p>
    <div id="log" class="div_log" >
        <?php
        $action = $_POST['clear'];
        if (!empty($action)) {
            $log_file = fopen("log.txt", "w");
            fclose($log_file);
            unset($_POST);
        }
        if (!empty($output)) {
            $log_file = fopen("log.txt", "a+");
            $time = date("Y-m-d H:i:s");
            fwrite($log_file, $time."\r\n".$output."\r\n");
            $log = file_get_contents("log.txt",true);
            echo "<pre>$log</pre>";
            fclose($log_file);
        }
        ?>
    </div>
    <p></p>
    <input type="submit" name="clear" value="Clear logs">
</form>

<script>
    function scrollBottom(){
        document.getElementById("log").scrollTop = document.getElementById("log").scrollHeight;
    }
</script>

</div>
</body>
</html>












