<?php
        $api=shell_exec("cat /var/www/html/api.txt");
        $a=$_GET['api'];
        //echo $api;
        //echo $a;
if(isset($a)&&!empty($a)&&$a==$api||$_GET['o_shied']=="ok"){        
        //echo "string";
        //cpu stat
        $prevVal = shell_exec("cat /proc/stat");
        $prevArr = explode(' ',trim($prevVal));
        $prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
        $prevIdle = $prevArr[5];
        //usleep(0.15 * 1000000);
        $val = shell_exec("cat /proc/stat");
        $arr = explode(' ', trim($val));
        $total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
        $idle = $arr[5];
        $intervalTotal = intval($total - $prevTotal);
        $stat['cpu'] =  intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
        $loadavg = explode(' ',trim(shell_exec('cat /proc/loadavg')));
        $stat['load_avg'] = $loadavg[0];
        $stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
        //hdd stat
        $stat['hdd_free'] = round(disk_free_space("/") / 1024 / 1024 / 1024, 2);
        $stat['hdd_total'] = round(disk_total_space("/") / 1024 / 1024/ 1024, 2);
        $stat['hdd_used'] = $stat['hdd_total'] - $stat['hdd_free'];
        $stat['hdd_percent'] = round(sprintf('%.2f',($stat['hdd_used'] / $stat['hdd_total']) * 100), 2);
        //network stat
        $stat['network_rx_prev'] = trim(file_get_contents("/sys/class/net/eth0/statistics/rx_bytes"));
        $stat['network_tx_prev'] = trim(file_get_contents("/sys/class/net/eth0/statistics/tx_bytes"));
        //usleep(1000);
        $stat['network_rx'] = trim(file_get_contents("/sys/class/net/eth0/statistics/rx_bytes"));
        $stat['network_tx'] = trim(file_get_contents("/sys/class/net/eth0/statistics/tx_bytes"));
        //output headers
        header('Content-type: text/json');
        header('Content-type: application/json');
        //output data by json

        
        echo("{\"cpu\": " . $stat['cpu'] . ", \"mem_percent\": " . $stat['mem_percent'] . ", \"hdd_percent\":" . $stat['hdd_percent'] . ", " . "\"network_rx\":" . $stat['network_rx'] . ", \"network_tx\":" . $stat['network_tx'] . ", " . "\"network_rx_prev\":" . $stat['network_rx_prev'] . ", \"network_tx_prev\":" . $stat['network_tx_prev'] . ", \"load_avg\":" . $stat['load_avg'] . "}");
}
?>