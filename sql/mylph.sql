CREATE TABLE locations (
  loc_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  loctype_typ_id INTEGER UNSIGNED NOT NULL,
  loc_name VARCHAR(255) NULL,
  loc_adr VARCHAR(255) NULL,
  loc_cp INTEGER UNSIGNED NULL,
  loc_city VARCHAR(25) NULL,
  loc_desc VARCHAR(255) NULL,
  loc_img BLOB NULL,
  loc_x FLOAT(32) NULL,
  loc_y FLOAT(32) NULL,
  PRIMARY KEY(loc_id),
  INDEX locations_FKIndex1(loctype_typ_id)
);

CREATE TABLE loctype (
  typ_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  typ_name VARCHAR(25) NULL,
  PRIMARY KEY(typ_id)
);

CREATE TABLE roles (
  roles_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  roles_name VARCHAR(25) NULL,
  PRIMARY KEY(roles_id)
);

CREATE TABLE users (
  usr_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  roles_id INTEGER UNSIGNED NOT NULL,
  usr_email VARCHAR(25) NULL,
  usr_pwd VARCHAR(25) NULL,
  usr_nick VARCHAR(25) NULL,
  PRIMARY KEY(usr_id),
  INDEX users_FKIndex1(roles_id)
);

CREATE TABLE vote (
  users_usr_id INTEGER UNSIGNED NOT NULL,
  locations_loc_id INTEGER UNSIGNED NOT NULL,
  vote_rating TINYINT UNSIGNED NOT NULL DEFAULT 0,
  vote_like BOOL NULL,
  vote_comment VARCHAR(500) NULL,
  PRIMARY KEY(users_usr_id, locations_loc_id),
  INDEX users_has_locations_FKIndex1(users_usr_id),
  INDEX users_has_locations_FKIndex2(locations_loc_id)
);


