1) GET
enter you path in Postman URL. example http://localhost/my-php-api/api/users.php

2) POST
enter you path in Postman URL. example http://localhost/my-php-api/api/users.php

The “Body” tab can be selected, and under the “Data format”, choose “Raw” that can be “JSON”.
Add the following JSON data:

{
    "name": "your_name",
    "surname": "your_surname"
}

3) PUT
enter you path in Postman URL. example http://localhost/my-php-api/api/users.php

In the “Body” tab, add the updated JSON data:\

{
    "id": your_id
    "name": "your_name",
    "surname": "your_surname"
}

4) DELETE
enter you path in Postman URL. example http://localhost/my-php-api/api/users.php

In the “Body” tab, add the updated JSON data:

{
    "id": your_id
}
