# PHP_GEOIP: Géolocalisation d'une adresse IP

## Fichier de géolocalisation

vous disposez du fichier geoip.csv contenant la géolocalisation en fonction de l'adresse IP (description ci-dessous).

Décompression du fichier:

```bash
$ gzip -d geoip.csv.gz
```

#### Champs du fichier de données CSV

```
Name            Type            Description
ip_from         INT (10)        First IP address show netblock.
ip_to           INT (10)        Last IP address show netblock.
country_code    CHAR(2)         Two-character country code based on ISO 3166.
country_name    VARCHAR(64)     Country name based on ISO 3166.
region_name     VARCHAR(128)    Region or state name.
city_name       VARCHAR(128)    City name.
latitude        DOUBLE          City latitude. Default to capital city latitude if city is unknown.
longitude       DOUBLE          City longitude. Default to capital city longitude if city is unknown.
```

#### Création de la table

```SQL
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
```

#### Conversion d'une adresse IP en nombre entier

une adresse sous la forme ip0.ip1.ip2.ip3 est convertie sous la forme d'un int en appliquant le calcul suivant :
ip = ip0 * 256 * 256 * 256 + ip1 * 256 * 256 + ip2 * 256 + ip3


## Exercice 1 : Création base de données

- Créer une table nommée 'geoip' permetant de charger les données du fichier geoip.csv
- Créer le ou les index nécessaires
- écrire un programme PHP en CLI permetant de charger les données du fichier csv dans la table

## Exercice 2 : fonction geolocalisation() 

écrire une fonction utilisant l'information de $_SERVER['REMOTE_ADDR'] et retournant un tableau associatif contenant les informations de géolocalisation.

- country_code
- country_name
- region_name
- city_name
- latitude
- longitude


