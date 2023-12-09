
INSERT INTO user (name, last_name, second_last_name, password, email, status) values ("App", "", "", "123456", "app@gmail.com", 1);
INSERT INTO seller (user_id, status) values (1, status);

INSERT INTO config (app_seller_id, status) values (1, 1);


INSERT INTO product (`key`, price, status) values ("h1", 110, 1);
INSERT INTO product (`key`, price, status) values ("h2", 120, 1);
INSERT INTO product (`key`, price, status) values ("h3", 130, 1);

INSERT INTO product (`key`, price, status) values ("hm1", 210, 1);
INSERT INTO product (`key`, price, status) values ("hm2", 220, 1);
INSERT INTO product (`key`, price, status) values ("hm3", 230, 1);