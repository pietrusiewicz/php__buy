# execute script application after git clone
mkdir temp;
cp -R src temp
rm -r src
cd src
/usr/bin/docker compose run --rm composer create-project laravel/laravel .
cd ..
mv -f temp/* src

