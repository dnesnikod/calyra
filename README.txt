1, create database
2, copy files to folders
3, done
4, enjoy!


CREATE DATABASE url_shortener_db;
USE name_of_your_db;
CREATE TABLE url_store (
    id INT AUTO_INCREMENT PRIMARY KEY,
    short_url_key VARCHAR(20) NOT NULL UNIQUE,
    long_url TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
