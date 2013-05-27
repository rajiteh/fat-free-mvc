<?php 



class Developer {

    function create_db($f3) {
        $script = file_get_contents('create_db.sql');
        $lines = explode(';',$script);
        $f3->get('DB')->exec($lines);
    }

}