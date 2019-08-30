<?php

require_once "src/App.php";


abstract class ActiveRecord
{
    abstract protected function getData();
    abstract protected function getTable();

    public function save()
    {

        $fields = '';
        $values = '';
        $data = $this->getData();

        foreach ($data as $col => $value) {
            if (is_object($value) || is_array($value))
                continue;
            $fields .= sprintf("`%s`,", $col);
            $values .= sprintf("'%s',", $value);
        }
        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->getTable(), $fields, $values);

        App::$database->exec($sql);
    }
}