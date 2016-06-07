CREATE TABLE user (
    email VARCHAR(256) NOT NULL PRIMARY KEY,
    screenname VARCHAR(32) NOT NULL, 
    password VARCHAR(64) NOT NULL
);

CREATE TABLE entry (
    entry_id int not null auto_increment PRIMARY KEY,
    title VARCHAR(64) NOT NULL,
    blogtext VARCHAR(4000) NOT NULL,
    num_views int,
    entry_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() 
);

CREATE TABLE picture_collection(
    entry_id int NOT NULL PRIMARY KEY,
    entry_picture_ref VARCHAR(256) NOT NULL
);
