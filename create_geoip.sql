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