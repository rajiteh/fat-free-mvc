<?php
abstract class Base_Model extends DB\SQL\Mapper {

    
    // Instantiate mapper
    function __construct($f3) {
        // Make sure we have a table name
        if(!isset($this->table))
            throw new LogicException(get_class($this) . ' must have a $table');
        else if (!$f3->exists('DB'))
            throw new LogicException(get_class($this) . ' needs a database variable \'DB\' in $f3');
        
        // This is where the mapper and DB structure synchronization occurs
        parent::__construct($f3->get('DB'),$this->table);
    }

}
