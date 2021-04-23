
# Zadanie rekrutacyjne
W repozytorium znajduje się konfiguracja środowiska deweloperskiego. **Jeżeli nie potrzebujesz to po prostu skopiuj 
zawartość katalogu `html` gdzie są pliki aplikacji.** Samo środowisko stawiam za pomocą docker-compose, a główna 
konfiguracja znajduje się w pliku `docker-compose.yml`. Załączyłem także konfigurację php-fpm z Xdedug (wraz z 
konfiguracją pod VSC), mariadb oraz Adminera bo zwykle tak pracuję.

Link do repozytorium [https://github.com/TomaszMadera/rekrutacja](https://github.com/TomaszMadera/rekrutacja)

Do aplikacji możesz dostać się z http://localhost

Adminer: http://localhost:8080

## Uruchomienie środowiska

Projekt pobierasz z GitHuba:

```
mkdir rekrutacja
cd rekrutacja
git clone https://github.com/TomaszMadera/rekrutacja .
```

Jeżeli chcesz uruchmić całe środowisko to:

```
docker-compose up -d
```

Jeżeli nie to jak pisałem wcześniej kopiujesz zawartość katalogu html na swoją maszynę i tworzysz bazę, dodajesz użytkownika bazy i nadajesz przywileje:
```
CREATE DATABASE `db`; 
USE `db`;
CREATE USER 'dbuser'@'%' IDENTIFIED BY 'dbpass';
GRANT ALL PRIVILEGES ON *.* TO 'dbuser'@'%';
FLUSH PRIVILEGES;
```

Importujesz skrypt SQL z pliku `db.sql` gdzie są tabele i domyślne dane w nich.

## Jeżeli coś nie zadziała

Uzupełnić ręcznie konfugiracje w pliku config.php, linijki:
```
define('BASE_DIR', getcwd() . '/');
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/');
```

## Jeżeli miałbym więcej czasu zrobiłbym

- Ustawił dokładnie kodowanie znaków przy tworzeniu tabeli
- Pozakładałbym klucze obce na tabele z relacjami
- Bootstrapa zaciągnąłbym Composerem (chociaż miało nie być bibliotek PHP ;)), wtedy zmieniłbym też strukturę 
katalogów żeby composer nie był w katalogu html, a jednocześnie widziany przez serwis `webserver`, coś w stylu 
app > html, app > composer.phar, app > vendor i analogicznie uaktualnienie konfiguracji środowiska
- Załączyłbym konfigurację użytkowników i uprawnień MySQL, bo w tym momencie jest generowana automatycznie 
- Uściśliłbym uprawnienia użytkownika MySQL zarządzającego aplikacją
- Zadbałbym żeby w serwisie php były moduły które często się przydają typu gd, mbstring, xml, json itp...
- Przejrzałbym .htaccess w kierunku zabezpieczenia systemu plików jak i sam system plików pod tym kątem
- Ulepszyłbym autoloader
- Ulepszyłbym ustalanie BASE_DIR i BASE_URL bo w różnych środowiskach można działać różnie
- Ulepszyłbym klasę Core/Db żeby nie tworzyła za każdym razem połączenia z bazą (singleton lub registry)
- Ścieżki do routera pobierałbym z bazy danch lub jakiegoś pliku yml, xml...
- ...