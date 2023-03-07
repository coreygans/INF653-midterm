CREATE TABLE quotes (
id SERIAL PRIMARY KEY NOT NULL,
quote TEXT NOT NULL, 
author_id INT NOT NULL, 
category_id INT NOT NULL
);

CREATE TABLE authors(
id SERIAL PRIMARY KEY NOT NULL,
author VARCHAR(50) NOT NULL
);


CREATE TABLE categories(
id SERIAL PRIMARY KEY NOT NULL,
category VARCHAR(50) NOT NULL
);


ALTER TABLE quotes
ADD CONSTRAINT fk_category_id
FOREIGN KEY (category_id)
REFERENCES categories (id);

ALTER TABLE quotes
ADD CONSTRAINT fk_author_id
FOREIGN KEY (author_id)
REFERENCES authors (id);