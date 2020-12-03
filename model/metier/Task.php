<?php


class Task
{
    private $titre;
    private $description;
    private $user;
    private $date;
    private $color;
    private $id;

    /**
     * Task constructor.
     * @param $titre
     * @param $description
     * @param $user
     * @param $date
     * @param $heure
     * @param $color
     * @param $id
     */
    public function __construct($titre, $description, $user, $date, $color, $id)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->user = $user;
        $this->date = $date;
        $this->color = $color;
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getDate()
    {
        return date('Y-m-d',strtotime($this->date));
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function isPublic():bool{
        return  $this->getUser()=="public";
    }

    public function isThisDay($date):bool{
        return  strtotime($date)==strtotime($this->getDate());
    }

    public function getHour(){
        return  date('h:i',strtotime($this->date));;
    }
}