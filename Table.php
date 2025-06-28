<?php
include 'Databaseconnect.php';

class DatabaseUpdate extends DatabaseConnect {
    public function createOrUpdateTables() {
        $this->connection = $this->getConnection();

        $createQueries = array(
            // userinputs table
            "CREATE TABLE IF NOT EXISTS userinputs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                question_id VARCHAR(255) NOT NULL,
                correctAnswer VARCHAR(255) NOT NULL,
                course VARCHAR(255) NOT NULL,
                userAnswer VARCHAR(255) NOT NULL
            )",
            // cbt table
            "CREATE TABLE IF NOT EXISTS cbt (
                id INT AUTO_INCREMENT PRIMARY KEY,
                QuestionText VARCHAR(255) NOT NULL,
                Course VARCHAR(255) NOT NULL,
                Option1 VARCHAR(255) NOT NULL,
                Option2 VARCHAR(255) NOT NULL,
                Option3 VARCHAR(255) NOT NULL,
                Option4 VARCHAR(255) NOT NULL,
                CorrectAnswer VARCHAR(255) NOT NULL
            )"
        );

        foreach ($createQueries as $query) {
            if ($this->connection->query($query) === TRUE) {
                echo "Table created successfully.<br>";
            } else {
                echo "Error creating table: " . $this->connection->error . "<br>";
            }
        }

        //  update queries if needed in future:
        $updateQueries = array(
            // Example: "ALTER TABLE cbt ADD COLUMN difficulty VARCHAR(50)"
        );

        foreach ($updateQueries as $query) {
            if ($this->connection->query($query) === TRUE) {
                echo "Table updated successfully.<br>";
            } else {
                echo "Error updating table: " . $this->connection->error . "<br>";
            }
        }
    }
}

// Initialize the connection
$db = new DatabaseUpdate('localhost', 'Ifeolayeni', 'Iyanuoluwa', 'test');

// Run the table creation/updating
$db->createOrUpdateTables();
?>
