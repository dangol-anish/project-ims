<?php

$localhost = "localhost";
$user = "root";
$password = "";
$dbName = "project_ims_example";

// Establishing database connection
$connection = mysqli_connect($localhost, $user, $password);

function query()
{
return
"CREATE TABLE ims_enroll_student(
    enroll_student_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    course_enroll_id INT,
    user_id INT,
    is_removed TINYINT DEFAULT 0,
    is_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_updated_at DATETIME NULL,
    is_removed_at DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES ims_user(user_id),
    FOREIGN KEY (course_enroll_id) REFERENCES ims_course_enroll(course_enroll_id)
);

";
}

function connectDB($localhost, $user, $password, $dbName)
{
    $imsCon = mysqli_connect($localhost, $user, $password, $dbName);
    return $imsCon;
}

// Building database create SQL query as a string
if ($connection) {
    try{
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";

    // Executing SQL query with the connection object
    $response = mysqli_query($connection, $sql);
    }catch(exception $e){
        echo "Database already exists";
    }

    if ($response) {
        echo "Database created successfully";

        // Connect to the created database
        $imsCon = connectDB($localhost, $user, $password, $dbName);

        if ($imsCon) {
            // Create the table using the query function
            $utSql = query();
            $utCreate = mysqli_query($imsCon, $utSql);
            try{
            if ($utCreate) {
                echo "Table created successfully";
            } 
            } catch (Exception $e){
                echo $e->getMessage();
            }
         
        } 
    } 
} 

?>
