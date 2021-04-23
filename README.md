
# Zadanie rekrutacyjne
W repozytorium znajduje się konfiguracja środowiska deweloperskiego. Jeżeli nie potrzebujesz to po prostu skopiuj 
zawartość katalogu `html` gdzie są pliki aplikacji. Samo środowisko stawiam za pomocą docker-compose, a główna 
konfiguracja znajduje się w pliku `docker-compose.yml`. Załączyłem także konfigurację php-fpm z Xdedug (wraz z 
konfiguracją pod VSC), mariadb oraz Adminera bo zwykle tak pracuję.

Link do repozytorium [https://github.com/TomaszMadera/rekrutacja](https://github.com/TomaszMadera/rekrutacja)

Do aplikacji możesz dostać się z http://localhost

Adminer: http://localhost:8080

## Uruchomienie środowiska

```
mkdir rekrutacja
cd rekrutacja
git clone https://github.com/TomaszMadera/rekrutacja .
docker-compose up -d
```