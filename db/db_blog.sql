
CREATE TABLE users (
                id INT AUTO_INCREMENT NOT NULL,
                login VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE posts (
                id INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT(10000) NOT NULL,
                created_date DATE NOT NULL,
                user_id INT NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE comments (
                id INT AUTO_INCREMENT NOT NULL,
                post_id INT NOT NULL,
                author VARCHAR(50) NOT NULL,
                comment TEXT NOT NULL,
                comment_date DATE NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE medias (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                file VARCHAR(255) NOT NULL,
                post_id INT NOT NULL,
                type VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
);


ALTER TABLE posts ADD CONSTRAINT users_posts_fk
FOREIGN KEY (user_id)
REFERENCES users (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE medias ADD CONSTRAINT posts_medias_fk
FOREIGN KEY (post_id)
REFERENCES posts (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE comments ADD CONSTRAINT posts_comments_fk
FOREIGN KEY (post_id)
REFERENCES posts (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
