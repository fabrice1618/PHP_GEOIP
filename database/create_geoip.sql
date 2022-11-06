CREATE TABLE geoip(
    ip_from INT UNSIGNED,
    ip_to INT UNSIGNED,
    country_code CHAR(2),
    country_name VARCHAR(64),
    region_name VARCHAR(128),
    city_name   VARCHAR(128),
    latitude    double,
    longitude   double,
    PRIMARY KEY (ip_to)
) ENGINE=innoDB DEFAULT CHARSET=utf8;

/*
+--------------+--------------+------+-----+---------+-------+
| Field        | Type         | Null | Key | Default | Extra |
+--------------+--------------+------+-----+---------+-------+
| ip_from      | int unsigned | YES  |     | NULL    |       |
| ip_to        | int unsigned | NO   | PRI | NULL    |       |
| country_code | char(2)      | YES  |     | NULL    |       |
| country_name | varchar(64)  | YES  |     | NULL    |       |
| region_name  | varchar(128) | YES  |     | NULL    |       |
| city_name    | varchar(128) | YES  |     | NULL    |       |
| latitude     | double       | YES  |     | NULL    |       |
| longitude    | double       | YES  |     | NULL    |       |
+--------------+--------------+------+-----+---------+-------+
*/
