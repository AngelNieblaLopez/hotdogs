USE cine_movil;
INSERT INTO `role` (name, is_worker) values ("cutomer v1", 0);
INSERT INTO `role` (name, is_worker) values ("App interna", 0);

INSERT INTO type_of_worker(name) values ("Física");
INSERT INTO type_of_worker (name) values ("App movil");

INSERT INTO auth (password) values ("123456");
INSERT INTO user (auth_id, name, last_name, second_last_name, role_id, email) values (1, "App movil", "", "", 2, "appmovil@gmail.com");
INSERT INTO worker (user_id, type_of_worker_id) values (1, 2);

INSERT INTO enviroment_server (name) values ('development');
INSERT INTO enviroment_server (name) values ('production');
INSERT INTO enviroment_server (name) values ('staging');



INSERT INTO payment_status (name) values ("En proceso");
INSERT INTO payment_status (name) values ("Rechazado");
INSERT INTO payment_status (name) values ("Pagado");


INSERT INTO movie_clasification (name, min_age) VALUES ("A", 12);
INSERT INTO movie_clasification (name, min_age) VALUES ("B", 15);
INSERT INTO movie_clasification (name, min_age) VALUES ("C", 18);

INSERT INTO category (name, description) VALUES ("Animada", "Pelicula animada");
INSERT INTO category (name, description) VALUES ("Live action", "Película live action animada");
INSERT INTO category (name, description) VALUES ("Horror", "Película de miedo");

INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("pelicula 1", "Película  de harry potter 1", 1, 1,120, "");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("pelicula 2", "Película  de harry potter 2", 2, 2, 100, "");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("pelicula 3", "Película  de harry potter 3 ", 3, 3, 200, "");

INSERT INTO function_status (name) VALUES ("Pendiente");
INSERT INTO function_status (name) VALUES ("En curso");
INSERT INTO function_status (name) VALUES ("Finalizada");
INSERT INTO function_status (name) VALUES ("Cancelada");


/* SEATS */
INSERT INTO column_of_seat (name) value ("1");
INSERT INTO column_of_seat (name) value ("2");
INSERT INTO column_of_seat (name) value ("3");
INSERT INTO column_of_seat (name) value ("4");
INSERT INTO column_of_seat (name) value ("5");
INSERT INTO column_of_seat (name) value ("6");

INSERT INTO row_of_seat (name) value ("A");
INSERT INTO row_of_seat (name) value ("B");
INSERT INTO row_of_seat (name) value ("C");
INSERT INTO row_of_seat (name) value ("D");

INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 4);

/* SEATS */