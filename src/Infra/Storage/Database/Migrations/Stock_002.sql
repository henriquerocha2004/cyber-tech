create table stock(
    id BIGINT UNSIGNED AUTO_INCREMENT,
    movement_type enum('IN', 'OUT') NOT NULL DEFAULT 'IN',
    invoice VARCHAR(255),
    date DATE NOT NULL,
    supplier_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (id)
) ENGINE = innodb;

create table suppliers (
    id BIGINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(255),
    document VARCHAR(255),
    address VARCHAR(255),
    neighborhood VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(5),
    PRIMARY KEY (id)
) ENGINE = innodb;


ALTER TABLE stock ADD CONSTRAINT fk_stock_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers (id);
ALTER TABLE stock ADD CONSTRAINT fk_stock_product FOREIGN KEY (product_id) REFERENCES products (id);