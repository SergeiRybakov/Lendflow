
API usage:
````
http://lendflow/api/1/nyt/best-sellers?&isbn[0]=9781451662436&isbn[1]=9....
http://lendflow/api/1/nyt/best-sellers?author=Tolkien
http://lendflow/api/1/nyt/best-sellers?author=b&offset=20
http://lendflow/api/1/nyt/best-sellers?title=peace&isbn[0]=9780375760129
````

Tests:
````
php vendor/phpunit/phpunit/phpunit tests/unit
php vendor/phpunit/phpunit/phpunit tests/feature/NewYorkTimesControllerTest.php
