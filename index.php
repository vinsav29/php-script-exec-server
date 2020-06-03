<html>
<head>
    <title>Personalized Greeting Form</title>
</head>
<body>
<?php if(!empty($_POST['name'])) {
    echo "Greetings, {$_POST['name']}, and welcome.";
} ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Enter your name: <input type="text" name="name" />
    <input type="submit" />
</form>

<form method='post'>
    <p>NTPD</p>
    <?php
    $ntpd_start_off = '
        <input type="submit" name="ntpd" value="start" disabled>
        <input type="submit" name="ntpd" value="stop">
        <input type="submit" name="ntpd" value="restart">
    ';
    $ntpd_stop_off = '
        <input type="submit" name="ntpd" value="start">
        <input type="submit" name="ntpd" value="stop" disabled>
        <input type="submit" name="ntpd" value="restart">
    ';
    $action = $_POST['ntpd'];
    if (!empty($action)) {
        switch ($action)
        {
            case 'start':
                echo $ntpd_start_off;
                echo 'ntpd.service start';
                shell_exec('bash /etc/init.d/ntp start');
                break;
            case 'stop' :
                echo $ntpd_stop_off;
                echo 'ntpd.service stop';
                shell_exec('bash /etc/init.d/ntp stop');
                break;
            case 'restart' :
                echo $ntpd_start_off;
                echo 'ntpd.service restart';
                shell_exec('bash /etc/init.d/ntp restart');
                break;
        }
    } else {
        echo $ntpd_start_off;
    }
    ?>
</form>




<form action="index.php" method="get">
    <p>GPSD</p>
    <?php
    $gpsd_start_off = '
        <input type="submit" name="gpsd" value="start" disabled>
        <input type="submit" name="gpsd" value="stop">
        <input type="submit" name="gpsd" value="restart">
    ';
    $gpsd_stop_off = '
        <input type="submit" name="gpsd" value="start">
        <input type="submit" name="gpsd" value="stop" disabled>
        <input type="submit" name="gpsd" value="restart">
    ';
    if (!empty($_GET['gpsd'])) {
        switch ($_GET['gpsd'])
        {
            case 'start':  shell_exec('bash /tmp/script');
            echo $gpsd_start_off;
            echo 'gpsd.service start';
            break;
            case 'stop' :
            echo $gpsd_stop_off;
            echo 'gpsd.service stop';
            break;
            case 'restart' :
                echo $gpsd_start_off;
                break;
        }
    } else {
    echo $gpsd_start_off;
    }
    ?>
</form>



</body>
</html>










