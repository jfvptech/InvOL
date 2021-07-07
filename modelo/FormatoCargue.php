<?php
 header("Content-disposition: attachment; filename=FormatoCargue.xlsx");
        header("Content-type: application/xls");
        readfile("../css/FormatoCargue.xlsx");
?>