### Запуск проекта

Требования:

    php >= 8.0 

Склонируйте проект с GitHub

    git clone https://github.com/Rukavichnicov/testDogsy.git

Перейдите в папку с проектом

    cd ./testDogsy   
    
Запустите установку зависимостей

    php composer.phar install

Запуск скриптов доступен с помощью комманд

    php yii user-text semicolon countAverageLineCount
    php yii user-text comma countAverageLineCount
    php yii user-text semicolon replaceDates
    php yii user-text comma replaceDates

Файлы хранятся по следующим путям:

    ./files/people.csv
    ./files/text
    ./files/output_text