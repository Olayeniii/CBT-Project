<?php
include 'Databaseconnect.php';

// Initialize the connection
$db = new DatabaseConnect('localhost', 'Ifeolayeni', 'Iyanuoluwa', 'test');

// Initialize  courses and questions array
$courses = array(
    'Mathematics' => array(
        'What is 2 + 2?' => array(
            'Option1' => '3',
            'Option2' => '4',
            'Option3' => '5',
            'Option4' => '6',
            'CorrectAnswer' => '4'
        ),
        'What is the square root of 16?' => array(
            'Option1' => '2',
            'Option2' => '3',
            'Option3' => '4',
            'Option4' => '5',
            'CorrectAnswer' => '4'
        )
    ),

    'Science' => array(
        'What is the chemical symbol for water?' => array(
            'Option1' => 'H2O',
            'Option2' => 'CO2',
            'Option3' => 'O2',
            'Option4' => 'NaCl',
            'CorrectAnswer' => 'H2O'
        ),
        'What planet is known as the Red Planet?' => array(
            'Option1' => 'Earth',
            'Option2' => 'Mars',
            'Option3' => 'Jupiter',
            'Option4' => 'Saturn',
            'CorrectAnswer' => 'Mars'
        )
    ),

    'History' => array(
        'Who was the first President of the United States?' => array(
            'Option1' => 'George Washington',
            'Option2' => 'Thomas Jefferson',
            'Option3' => 'Abraham Lincoln',
            'Option4' => 'John Adams',
            'CorrectAnswer' => 'George Washington'
        ),
        'In which year did World War II end?' => array(
            'Option1' => '1945',
            'Option2' => '1944',
            'Option3' => '1946',
            'Option4' => '1947',
            'CorrectAnswer' => '1945'
        )
        ),
        
    // Add more courses and questions as needed
);
?>