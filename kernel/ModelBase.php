<?php

namespace Kernel\Models;

use Kernel\Application;

class ModelBase
{
    protected $data = [];
    protected $attributes = [];
    protected $validatorRules = [];

    protected $tableName;

    protected $id;

    public function __construct(array $parameters = [])
    {
        $this->populate($parameters);
    }

    /**
     * @return array
     */
    public function getAllData()
    {
        $attributesData = [];
        foreach ($this->attributes as $attribute) {
            $attributesData[$attribute] = $this->$attribute;
        }
        return $attributesData;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @return array
     */
    public function getValidatorRules()
    {
        return $this->validatorRules;
    }

    /**
     * @param array $parameters
     */
    public function populate(array $parameters)
    {
        foreach ($parameters as $key => $value) {
            if (in_array($key, $this->attributes)) {
                $this->$key = $value;
            }
        }
    }

    public function onBeforeInsert()
    {
    }

    public function onAfterInsert()
    {
        $this->id = Application::getDatabase()->lastInsertId();
    }

    public function onBeforeUpdate()
    {
    }

    public function save()
    {
        if (is_null($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function insert()
    {
        $this->onBeforeInsert();

        $allData = $this->getAllData();
        unset($allData['id']);

        $rowsString = join(', ', array_keys($allData));
        $valuesString = join(', ', array_fill(0, count($allData), '?'));
        $query = "INSERT INTO {$this->tableName} ({$rowsString}) VALUES ({$valuesString})";

        $sth = Application::getDatabase()->prepare($query);
        $sth->execute(array_values($allData));

        $isSuccess = 0 === intval($sth->errorCode());
        if ($isSuccess) {
            $this->onAfterInsert();
        }

        return $isSuccess;
    }

    public function update()
    {
        $this->onBeforeUpdate();

        $allData = $this->getAllData();
        unset($allData['id']);

        $sets = [];
        foreach ($allData as $key => $value) {
            $sets[] = "{$key} = ?";
        }
        $query = "UPDATE {$this->tableName} SET " . join(', ', $sets) . " WHERE id = ?";

        $allData['id'] = $this->id; // add to end of list

        $sth = Application::getDatabase()->prepare($query);
        $sth->execute(array_values($allData));

        return 0 === intval($sth->errorCode());
    }
}