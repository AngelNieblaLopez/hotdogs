
INSERT INTO user (name, last_name, second_last_name, password, email, status) values ("App", "", "", "123456", "app@gmail.com", 1);
INSERT INTO seller (user_id, status) values (1, 1);

INSERT INTO user (name, last_name, second_last_name, password, email, status) values ("Admin", "", "", "123456", "admin@gmail.com", 1);
INSERT INTO seller (user_id, status) values (2, 1);

INSERT INTO config (app_seller_id, status) values (1, 1);


INSERT INTO product (`key`, price, status) values ("h1", 60, 1);
INSERT INTO product (`key`, price, status) values ("h2", 65 , 1);
INSERT INTO product (`key`, price, status) values ("h3", 50, 1);
INSERT INTO product (`key`, price, status) values ("h4", 60, 1);

INSERT INTO product (`key`, price, status) values ("hm1", 100, 1);
INSERT INTO product (`key`, price, status) values ("hm2", 90, 1);
INSERT INTO product (`key`, price, status) values ("hm3", 95, 1);
INSERT INTO product (`key`, price, status) values ("hm4", 80, 1);