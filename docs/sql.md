
-user_types
  CREATE TABLE User_Types(
    id INT NOT NULL,
    label VARCHAR(150),
    PRIMARY KEY(id)
  );

-users
  CREATE TABLE users(
    id INT NOT NULL,
    type_id INT NOT NULL,
    Display VARCHAR(255),
    PRIMARY KEY(id),
    FOREIGN KEY (type_id) REFERENCES user_types(id)
  );

  INSERT INTO  users (name, email, password_hash, join_date) VALUES (:name, :email, :password_hash, CURDATE())
