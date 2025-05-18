<?php
include 'Databaseconnect.php';

class DatabaseUpdate extends DatabaseConnect {
    public function createOrUpdateTables() {

        $this->connection = $this->getConnection();

        $createQueries = array(
            //  users table
            "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                email VARCHAR(255) NOT NULL,
                contact_address TEXT NOT NULL,
                password VARCHAR(255) NOT NULL,
                role ENUM('business_owner', 'end_user') NOT NULL,
                business_name VARCHAR(255),
                business_address TEXT,
                business_email VARCHAR(255),
                business_location VARCHAR(255),
                api_key VARCHAR(255) NOT NULL,
                created_at VARCHAR(255) NOT NULL
            )",
            // Email verifications table
            "CREATE TABLE IF NOT EXISTS email_verifications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(255) NOT NULL,
                verification_code VARCHAR(255) NOT NULL,
                created_at VARCHAR(255) NOT NULL,
                confirm_code VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                expires_at VARCHAR(255) NOT NULL
            )",
           //login sessions table
            "CREATE TABLE IF NOT EXISTS user_sessions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(255),
                session_token VARCHAR(255) NOT NULL,
                created_at VARCHAR(255),
                expires_at VARCHAR(255),
            )",
            // Available products table
            "CREATE TABLE IF NOT EXISTS available_products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(255),
                name VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                image_url VARCHAR(255),
                price DECIMAL(10, 2) NOT NULL,
                status ENUM('available', 'unavailable') NOT NULL,
                created_at VARCHAR(255),
            )",
            // Sponsored posts table
            "CREATE TABLE IF NOT EXISTS sponsored_posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(255),
                product_id VARCHAR(255),
                title VARCHAR(255) NOT NULL,
                content VARCHAR(255) NOT NULL,
                image_path VARCHAR(255) NOT NULL,
                created_at VARCHAR(255) NOT NULL,
            )"
        );

        foreach ($createQueries as $query) {
            if ($this->connection->query($query) === TRUE) {
                echo "Table created successfully.<br>";
            } else {
                echo "Error creating table: " . $this->connection->error . "<br>";
            }
        }

         $updateQueries = array(
                "ALTER TABLE users ADD COLUMN image VARCHAR(255)",
             "ALTER TABLE users ADD COLUMN business_type VARCHAR(255)",
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
$db = new DatabaseUpdate('localhost', 'fochauxo_Int', 'testYin23487@', 'fochauxo_vail');

// Create or update tables
$db->createOrUpdateTables();




?>