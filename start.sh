mv src temp && mkdir src && cd src && docker compose run --rm composer create-project laravel/laravel . && cd .. && cp -R -f temp/* src/ && rm -r temp
