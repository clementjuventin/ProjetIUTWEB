<?php


class Liste
{
    private $label;
    private $taskArray;
    private $id;
    private $user;

    /**
     * Liste constructor.
     * @param $label
     * @param $taskArray
     * @param $id
     * @param $user
     */
    public function __construct($label, $taskArray, $id, $user)
    {
        $this->label = $label;
        $this->taskArray = $taskArray;
        $this->id = $id;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getTaskArray()
    {
        return $this->taskArray;
    }

    /**
     * @param mixed $taskArray
     */
    public function setTaskArray($taskArray)
    {
        $this->taskArray = $taskArray;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return intval($this->id);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function isPublic(){
        return true;//A changer
    }

    public function addToList($task){
        foreach ($task as $t){
            $this->taskArray[]=$t;
        }
    }
}