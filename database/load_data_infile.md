# Chargement d'un fichier CSV

## vérification de la configuration

Se connecter à MySQL en tant que dba et autoriser le chargement de fichiers CSV du côté serveur. Vérifier aussi que l'utilisateur a le privilège de charge des fichiers "File_priv"

```SQL
mysql> show variables like "%local%";
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| local_infile  | OFF   |
+---------------+-------+

mysql> SET GLOBAL local_infile=ON;
Query OK, 0 rows affected (0,01 sec)

mysql> show variables like "%local%";
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| local_infile  | ON    |
+---------------+-------+

mysql> select user,File_priv from mysql.user;
+------------------+-----------+
| user             | File_priv |
+------------------+-----------+
| dba              | Y         |
| dba              | Y         |
| debian-sys-maint | Y         |
| geoip            | N         |
| mysql.infoschema | N         |
| mysql.session    | N         |
| mysql.sys        | N         |
| root             | Y         |
+------------------+-----------+

```

## Chargement des données

Affichage du contenu du fichier. Les fins de lignes sont CR-LF

```bash
od -A x -t x1z -v geoip.csv | more
```

Client MySQL avec autorisation chargement fichiers et affichage des warnings

```bash
mysql --local-infile=1 --show-warnings -u dba -p
```

```SQL
mysql> use geoip;

mysql> LOAD DATA LOCAL INFILE './geoip.csv' INTO TABLE geoip FIELDS OPTIONALLY ENCLOSED BY '"' TERMINATED BY "," LINES TERMINATED BY "\r\n";

mysql> select count(*) from geoip2;
+----------+
| count(*) |
+----------+
|  2969680 |
+----------+
```