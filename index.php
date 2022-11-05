<?php

# Read a current log file
exec("cat /var/log/nginx/access.log", $current_log);
# Unpack and merge old log files
exec("zcat /var/log/nginx/access.log.*.gz", $old_logs);

# Create a full report
$full_log = implode("\n", $old_logs) . "\n" . implode("\n", $current_log);
file_put_contents("access.log", $full_log);
exec("goaccess ./access.log --geoip-database ./dbip-country-lite* -o ./report.html", $res);

# Send response
if (file_exists("./report.html")) {
    $report = file_get_contents("./report.html");
    echo $report;
} else {
    echo "Report is unavailable";
}

exit();