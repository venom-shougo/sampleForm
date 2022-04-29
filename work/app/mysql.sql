DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  username varchar(255),
  password varchar(255),
  name varchar(255),
  address varchar(255),
  PRIMARY KEY (id)
);

INSERT INTO users (username, password, name, address) VALUES 
('pp1', '101106', 'ShougoNisimoto', 'pp1@gmail.com');

SELECT * FROM users;

-- DELETE FROM users WHERE id = 2;
-- ALTER TABLE `users` auto_increment = 1;

/**
usersテーブル作成
*/
