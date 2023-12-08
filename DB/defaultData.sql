
INSERT INTO user (name, last_name, second_last_name, password, email) values ("App", "", "", "123456", "app@gmail.com");
INSERT INTO saler (user_id) values (1);

INSERT INTO config (app_saler_id) values (1);


INSERT INTO product (`key`, price, status) values ("h1", 110, 1);
INSERT INTO product (`key`, price, status) values ("h2", 120, 1);
INSERT INTO product (`key`, price, status) values ("h3", 130, 1);

INSERT INTO product (`key`, price, status) values ("hm1", 210, 1);
INSERT INTO product (`key`, price, status) values ("hm2", 220, 1);
INSERT INTO product (`key`, price, status) values ("hm3", 230, 1);