<?php 

    class Person {
        // properties for our class
        public $name;
        public $age;
        public $arms;

        function walk(){
            echo get_class($this) . "is Walking!";
        }
        function talk(){
            echo get_class($this) . "is Talking!";
        }
    }

    // creating a new object from the class
    $ezra = new Person();
    $nkechi = new Person();

    // setting object properties using arrow syntax
    $ezra->name = "Ezra";
    $ezra->age = 20;
    $nkechi->name = "Nkechi";
    $nkechi->age = 25;

    // Accessing object properties using arrow syntax
    echo "The Name is: " . $ezra->name . "The Age is: " . $ezra->age . "The number of arms is: " . "<br>";

    // Running methods of the class via the object using arrow syntax 
    $ezra->walk();
    $ezra->talk();
  
    $classes = get_declared_classes();
    foreach ($classes as $class) {
        echo $class . "<br>";

    }

?>