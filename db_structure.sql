CREATE DATABASE IF NOT EXISTS aetherphp;

# --

CREATE TABLE IF NOT EXISTS users (
    uid              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(250),
    email           VARCHAR(250),
    password_hash   VARCHAR(500),
    perms     		TEXT
);

INSERT INTO users (username, email, password_hash, perms) VALUES (
'Admin', 'admin@gmail.com',
'$argon2id$v=19$m=65536,t=4,p=1$b2l2WUdHRTFlNTJmSnJuNg$ZZUxJ7HlKniGZpj8itDieq8ML9EUzgn0352tFr6AR1o',
""
);

