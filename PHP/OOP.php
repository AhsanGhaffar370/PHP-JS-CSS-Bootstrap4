<?php

// Almost all concepts of OPP are defined here


class Fruit extends abstract_class
{
    // public - the property or method can be accessed from everywhere. This is default
    // protected - the property or method can be accessed within the class and by classes derived from that class
    // private - the property or method can ONLY be accessed within the class
    private $name;

    function __construct($name) {
    $this->name = $name;
    }

    function set_name($name) {
    $this->name = $name;
    }
    function get_name() {
    return $this->name;
    }



    function show() {
        echo "<br>The fruit is {$this->name}.";
    }
    
    function intro() : string{
        return "<br>my name is ahsan";
    }

    // function __destruct() {
    // echo "The fruit is {$this->name}.";
    // }
}


// Strawberry is inherited from Fruit
class Strawberry extends Fruit
{
    function message() {
      echo "<br><br>Am I a fruit or a berry? ";
      $this->show();
    }
}


// Abstract Class
abstract class abstract_class{
    function __construct(){
    }

    abstract public function intro() : string;
}

class satic_property {
    
    public static $static_val = 3.14159;

    // static method
    public static function welcome() {
        echo "<br>The static value is: ",self::$static_val;
        }
}
  



$object_apple = new Fruit("Apple");

$object_apple->show();

echo $object_apple->intro();

$object_strawberry = new Strawberry("strawberry");

//Due to inheritance, strawberry class can call methods of class Fruit
$object_strawberry->show();

$object_strawberry->message();

  // Get static property
  echo "<br>",satic_property::$static_val;

  // get static method
  satic_property::welcome();

?>