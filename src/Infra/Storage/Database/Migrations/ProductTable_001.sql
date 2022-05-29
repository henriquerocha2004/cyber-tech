use cybertech;

create table products (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL ,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    min_quantity INT,
    cost_price DECIMAL(10,2) NOT NULL ,
    sale_price DECIMAL(10,2),
    available BOOL NOT NULL DEFAULT true,
    category_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (id)
) ENGINE = innodb;

create table categories(
  id BIGINT UNSIGNED AUTO_INCREMENT,
  description VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE products ADD CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES categories (id);