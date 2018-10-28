<?php
print "env is: ".$_ENV["USER"]."\n";
print "(doing: putenv fred)\n";
putenv("USER=fred");
print "env is: ".$_ENV["USER"]."\n";
print "getenv is: ".getenv("USER")."\n";
print "(doing: set _env barney)\n";
$_ENV["USER"]="barney";
print "getenv is: ".getenv("USER")."\n";
print "env is: ".$_ENV["USER"]."\n";
phpinfo(INFO_ENVIRONMENT);
?>
