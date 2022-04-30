<?php
class Person{

    protected $id;
    protected $mysqli;
    protected $name;
    protected $surname;
    protected $date_of_birth;
    protected $gender;
    protected $place_of_birth;

    /**
     * @param $id
     * @param $name
     * @param $surname
     * @param $date_of_birth
     * @param $gender
     * @param $place_of_birth
     */
    public function __construct($name, $surname, $date_of_birth, $gender, $place_of_birth)
    {
        $this->mysqli = new mysqli("localhost", "root", "", "users");
        $this->name = $name;
        $this->surname = $surname;
        $this->date_of_birth = $date_of_birth;
        $this->gender = $gender;
        $this->place_of_birth = $place_of_birth;
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function save(){
        $query = "INSERT INTO person (name, surname, date_of_birth, gender, place_of_birth) VALUES ('$this->name', '$this->surname', '$this->date_of_birth', '$this->gender', '$this->place_of_birth')";
        $result = $this->mysqli->query($query);
        if ($result) {
            $this->id = $this->mysqli->insert_id;
        }
        return $result;
    }

    public function deleteById(){
        $query = "DELETE FROM person WHERE id = $this->id";
        return $this->mysqli->query($query);
    }

    public static function getFullYears($person) {
        return date_diff(date_create($person->date_of_birth), date_create('now'))->y;
    }

    public static function getGender($person) {
        return $person->gender ? 'male' : 'female';
    }

    protected function create(){

    }

    protected function getById(){
        $query = "SELECT * FROM person WHERE id = $this->id";
        return $this->mysqli->query($query);
    }
}