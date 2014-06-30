SQL Query Builder
=================

[![Build Status](https://travis-ci.org/nilportugues/sql-query-builder.png)](https://travis-ci.org/nilportugues/sql-query-builder) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/89ec1003-4227-43a2-8432-67a9fc2d3ba3/mini.png)](https://insight.sensiolabs.com/projects/89ec1003-4227-43a2-8432-67a9fc2d3ba3) [![Latest Stable Version](https://poser.pugx.org/nilportugues/sql-query-builder/v/stable.svg)](https://packagist.org/packages/nilportugues/sql-query-builder) [![Total Downloads](https://poser.pugx.org/nilportugues/sql-query-builder/downloads.svg)](https://packagist.org/packages/nilportugues/sql-query-builder) [![License](https://poser.pugx.org/nilportugues/sql-query-builder/license.svg)](https://packagist.org/packages/nilportugues/sql-query-builder)

An elegant lightweight and efficient SQL Query Builder with fluid interface SQL syntax supporting bindings and complicated query generation.
<a name="index_block"></a>

* [1. Installation](#block1)
* [2. The Builder](#block2)
	* [2.1. Generic Builder](#block2.1)     
	* [2.2. MySQL Builder](#block2.2)     
	* [2.3. Human Readable Output](#block2.3)     
* [3. Building Queries](#block3)
	* [3.1. SELECT Statement](#block3.1)     
        * [3.1.1. Basic SELECT statement](#block3.1.1) 
        * [3.1.2. Aliased SELECT statement](#block3.1.2)
        * [3.1.3. SELECT with WHERE statement](#block3.1.3)
        * [3.1.4. JOIN & LEFT/RIGHT/INNER/CROSS JOIN SELECT statements](#block3.1.4)
	* [3.2. INSERT Statement](#block3.2)
	       * [3.2.1. Basic INSERT statement](#block3.2.1) 
	* [3.3. UPDATE Statement](#block3.3)
        * [3.3.1. Basic UPDATE statement](#block3.3.1)
        * [3.3.2. Elaborated UPDATE statement](#block3.3.2)
	* [3.4. DELETE Statement](#block3.4)     
        * [3.4.1. Basic DELETE statement](#block3.4.1)
        * [3.4.2. Elaborated DELETE statement](#block3.4.2)  	
* [4. Advanced Quering](#block4)	
	* [4.1. Filtering using WHERE](#block4.1)
		* [4.1.1. Changing WHERE logical operator](#block4.2)     
		* [4.1.2. Writing complicated WHERE conditions](#block4.2)     
	* [4.3. Grouping with GROUP BY and HAVING](#block4.3)     
		* [4.3.1 Available HAVING operators](#block4.3.1)     
	* [4.4. Changing HAVING logical operator](#block4.4)     
	* [4.5. Columns as SELECT statements](#block4.5)     	
	* [4.6. Columns using FUNCTIONS](#block4.6)     		
* [5. Quality Code](#block5)
* [6. Author](#block6)
* [7. License](#block7)


<a name="block1"></a>
## 1. Installation [↑](#index_block)
The recommended way to install SQL Query Builder is through [Composer](http://getcomposer.org). Just create a ``composer.json`` file and run the ``php composer.phar install`` command to install it:

```json
    {
        "require": {
            "nilportugues/sql-query-builder": "1.0.0"
        }
    }
```

<a name="block2"></a>
## 2. The Builder [↑](#index_block)

The SQL Query Builder allows to generate complex SQL queries standard `SQL-2003` dialect and `MySQL` dialect. 

<a name="block2.1"></a>
### 2.1. Generic Builder [↑](#index_block)
The Generic Query Builder is the default builder for this class and writes standard SQL-2003.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())->setTable('user');    
$builder = new GenericBuilder();    

echo $builder->write($query);    
```
#### Output:
```sql
SELECT user.* FROM user
```

<a name="block2.2"></a>
### 2.2. MySQL Builder [↑](#index_block) 
The MySQL Query Builder has its own class, that inherits from the SQL-2003 builder. All columns will be wrapped with the tilde **`** sign.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())->setTable('user');    
$builder = new GenericBuilder();    

echo $builder->write($query);    
```
#### Output:
```sql
SELECT user.* FROM `user` 
```

<a name="block2.3"></a>
### 2.3. Human Readable Output [↑](#index_block)

Both Generic and MySQL Query Builder can write complex SQL queries. 

Every developer out there needs at some point revising the output of a complicated query, the SQL Query Builder includes a human-friendly output method, and therefore the `writeFormatted` method is there to aid the developer when need. 

Keep in mind `writeFormatted` is to be avoided at all cost in production mode as it adds unneeded overhead due to parsing and re-formatting of the generated statement.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())->setTable('user');    
$builder = new GenericBuilder();    

echo $builder->writeFormatted($query);    

```
#### Output:
```sql
SELECT 
    user.* 
FROM 
    user
```

More complicated examples can be found in the documentation.


<a name="block3"></a>
## 3. Building Queries [↑](#index_block)

<a name="block3.1"></a>
### 3.1. SELECT Statement [↑](#index_block) 



<a name="block3.1.1"></a>
### 3.1.1. Basic SELECT statement [↑](#index_block)
#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())
    ->setTable('user')
    ->setColumns(['user_id','name','email']);
    
$builder = new GenericBuilder();    
echo $builder->write($query);    
```
#### Output:
```sql
SELECT user.user_id, user.name, user.email FROM user
```

<a name="block3.1.2"></a>
### 3.1.2. Aliased SELECT statement [↑](#index_block) 

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())
    ->setTable('user')
    ->setColumns(['userId' => 'user_id', 'username' => 'name', 'email' => 'email']);
    
$builder = new GenericBuilder();    
echo $builder->write($query);    
```
#### Output:
```sql
SELECT user.user_id AS userId, user.name AS username, user.email AS email FROM user
```
<a name="block3.1.3"></a>
#### 3.1.3. SELECT with WHERE statement
#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())
    ->setTable('user')
    ->setColumns([
        'userId' => 'user_id',
        'username' => 'name',
        'email' => 'email'
    ]);
    ->where()
    ->greaterThan('user_id', 5)
    ->notLike('username', 'John');
    
$builder = new GenericBuilder();    
echo $builder->writeFormatted($query);    
```
#### Output:
```sql
SELECT 
    user.user_id AS userId,
    user.name AS username,
    user.email AS email 
FROM 
    user 
WHERE 
    (user.user_id < :v1)
    AND (user.username NOT LIKE :v2)
```

<a name="block3.1.4"></a>
#### 3.1.4. JOIN & LEFT/RIGHT/INNER/CROSS JOIN SELECT statements

Syntax for `JOIN`, `LEFT JOIN`, `RIGHT JOIN`, `INNER JOIN`, `CROSS JOIN` work the exactly same way. 

Here's an example selecting both table and joined table columns and doing sorting using columns from both the table and the joined table.

#### Usage:
```php
$query = (new Select())
    ->setTable('user')
    ->setColumns([
            'userId'   => 'user_id',
            'username' => 'name',
            'email'    => 'email',
            'created_at'
    ])
    ->orderBy('user_id', OrderBy::DESC)
    ->leftJoin(
        'news', //join table
        'user_id', //origin table field used to join
        'author_id', //join column
         ['newsTitle' => 'title', 'body', 'created_at', 'updated_at']
     )
    ->on()
    ->equals('author_id', 1); //enforcing a condition on the join column

$query
    ->where()
    ->greaterThan('user_id', 5)
    ->notLike('username', 'John');

$query
    ->orderBy('created_at', OrderBy::DESC);

$builder = new GenericBuilder();    
echo $builder->writeFormatted($query); 
```
#### Output:
```sql
SELECT 
    user.user_id AS userId,
    user.name AS username,
    user.email AS email,
    user.created_at,
    news.title AS newsTitle,
    news.body,
    news.created_at,
    news.updated_at 
FROM 
    user 
LEFT JOIN 
        news
    ON 
        (news.author_id = user.user_id) 
        AND (news.author_id = :v1)
WHERE 
    (user.user_id < :v2)
    AND (user.username NOT LIKE :v3)        
ORDER BY 
    user.user_id DESC,
    news.created_at DESC;
```

<a name="block3.2"></a>
### 3.2. INSERT Statement [↑](#index_block)

The `INSERT` statement is really straightforward.

<a name="block3.2.1"></a>
### 3.3.1 Basic INSERT statement [↑](#index_block)

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Insert;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Insert())
    ->setTable('user')
    ->setValues([
        'user_id' => 1,
        'name'    => 'Nil',
        'contact' => 'contact@nilportugues.com',
    ]);

$builder = new GenericBuilder(); 
   
$sql = $builder->writeFormatted($query);    
$values = $builder->getValues();
```

#### Output
```sql
INSERT INTO user (user.user_id, user.name, user.contact) VALUES (:v1, :v2, :v3)
```
----
```php
[':v1' => 1, ':v2' => 'Nil', ':v3' => 'contact@nilportugues.com'];
```


<a name="block3.3"></a>
### 3.3. UPDATE Statement [↑](#index_block)

The `UPDATE` statement works just like expected, set the values and the conditions to match the row and you're set. 

Examples provided below.

<a name="block3.3.2"></a>
### 3.3.1 Basic UPDATE statement [↑](#index_block)
Important including the the `where` statement is critical, or all table rows will be replaced with the provided values if the statement is executed.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Update;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Update())
    ->setTable('user')
    ->setValues([
        'user_id' => 1,
        'name' => 'Nil',
        'contact' => 'contact@nilportugues.com'
    ])
    ->where()
    ->equals('user_id', 1);
    
$builder = new GenericBuilder(); 
   
$sql = $builder->writeFormatted($query);    
$values = $builder->getValues();
```
#### Output:
```sql
UPDATE 
    user 
SET
    user.user_id = :v1,
    user.name = :v2, 
    user.contact = :v3
WHERE 
    (user.user_id = :v4)
```
```php
[':v1' => 1, ':v2' => 'Nil', ':v3' => 'contact@nilportugues.com', ':v4' => 1];
```
<a name="block3.3.2"></a>
### 3.3.2. Elaborated UPDATE statement [↑](#index_block)

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Update;
use NilPortugues\SqlQueryBuilder\Syntax\OrderBy;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Update())
    ->setTable('user')
    ->setValues([
        'name' => 'UpdatedName',
    ]);
    
$query
    ->where()
    ->like('username', '%N')
    ->between('user_id', 1, 2000);
        
$query
    ->orderBy('user_id', OrderBy::ASC)
    ->limit(1);            

$builder = new GenericBuilder(); 
   
$sql = $builder->writeFormatted($query);    
$values = $builder->getValues();
```
#### Output:
```sql
UPDATE 
    user 
SET 
    user.name = :v1
WHERE 
    (user.username LIKE :v2) 
    AND (user.user_id BETWEEN :v3 AND :v4)
ORDER BY 
    user.user_id ASC 
LIMIT :v5
```

<a name="block3.4"></a>
### 3.4. DELETE Statement [↑](#index_block)

The `DELETE` statement is used just like `UPDATE`, but no values are set. 

Examples provided below.

<a name="block3.4.1"></a>
### 3.4.1. Basic DELETE statement [↑](#index_block)
Important including the the `where` statement is critical, or all table rows will be deleted with the provided values if the statement is executed.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Delete;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Delete())
    ->setTable('user');

$query
    ->where()
    ->equals('user_id', 100);

$query
    ->limit(1);
    
$builder = new GenericBuilder(); 
   
$sql = $builder->write($query);    
$values = $builder->getValues();
```
#### Output:
```sql
DELETE FROM user WHERE (user.user_id = :v1) LIMIT :v2
```
```php
[':v1' => 100, ':v2' => 1];
```
<a name="block3.4.2"></a>
### 3.4.2. Elaborated DELETE statement [↑](#index_block) 

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Delete;
use NilPortugues\SqlQueryBuilder\Syntax\OrderBy;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Delete())
    ->setTable('user');
    
$query
    ->where()
    ->like('username', '%N')
    ->between('user_id', 1, 2000);
        
$query
    ->orderBy('user_id', OrderBy::ASC)
    ->limit(1);            

$builder = new GenericBuilder(); 
   
$sql = $builder->writeFormatted($query);    
$values = $builder->getValues();
```
#### Output:
```sql
DELETE FROM 
    user 
WHERE 
    (user.username LIKE :v1) 
    AND (user.user_id BETWEEN :v2 AND :v3)
ORDER BY 
    user.user_id ASC 
LIMIT :v4
```

<a name="block4"></a>
## 4. Advanced Quering [↑](#index_block)

<a name="block4.1"></a>
### 4.1. Filtering using WHERE [↑](#index_block)
The following operators are available for filtering using WHERE conditionals:

```php
    public function subWhere($operator = 'OR');
    public function setTable($table);
    public function eq($column, $value);
    public function equals($column, $value);
    public function compare($column, $value, $operator);
    public function notEquals($column, $value);
    public function greaterThan($column, $value);
    public function greaterThanOrEqual($column, $value);
    public function lessThan($column, $value);
    public function lessThanOrEqual($column, $value);
    public function like($column, $value);
    public function notLike($column, $value);
    public function match(array $columns, array $values);
    public function matchBoolean(array $columns, array $values);
    public function matchWithQueryExpansion(array $columns, array $values);
    public function in($column, array $values);
    public function notIn($column, array $values);
    public function between($column, $a, $b);
    public function isNull($column);
    public function isNotNull($column);
    public function addBitClause($column, $value);
    public function conjunction($operator);
```

<a name="block4.2"></a>
### 4.2. Changing WHERE logical operator [↑](#index_block)

<a name="block4.3"></a>
### 4.3. Grouping with GROUP BY and HAVING [↑](#index_block)

<a name="block4.3.1"></a>
#### 4.3.1 Available HAVING operators  [↑](#index_block)
Same operators used in the WHERE statement are available for HAVING operations.

<a name="block4.4"></a>
### 4.4. Changing HAVING logical operator [↑](#index_block)

For the time being, `HAVING` default's operator must be changed using the `setHavingOperator` method before the using the `having` method.

#### Usage:
```php
<?php
use NilPortugues\SqlQueryBuilder\Manipulation\Select;
use NilPortugues\SqlQueryBuilder\Builder\GenericBuilder;

$query = (new Select())
    ->setTable('user')
    ->setColumns([
        'userId'   => 'user_id',
        'username' => 'name',
        'email'    => 'email',
        'created_at'
    ])
    ->groupBy(['user_id', 'name'])
    ->setHavingOperator('OR')
    ->having()
    ->equals('user_id', 1);   
$builder = new GenericBuilder(); 
   
$sql = $builder->writeFormatted($query);    
$values = $builder->getValues();
```
#### Output:
```sql
SELECT 
    user.user_id AS userId,
    user.name AS username,
    user.email AS email,
    user.created_at 
FROM 
    user 
GROUP BY 
    user.user_id, user.name 
HAVING 
    (user.user_id = :v1)
    OR (user.user_id = :v2)
```

<a name="block4.5"></a>
### 4.5. Columns as SELECT statements [↑](#index_block)

<a name="block4.6"></a>
### 4.6. Columns using FUNCTIONS [↑](#index_block)


<a name="block5"></a>
## 5. Quality Code [↑](#index_block)
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.4 up to PHP 5.6 and [HHVM](http://hhvm.com/).

To run the test suite, you need [Composer](http://getcomposer.org):

```bash
    php composer.phar install --dev
    vendor/bin/phpunit
```


<a name="block6"></a>
## 6. Author [↑](#index_block)
Nil Portugués Calderó

 - <contact@nilportugues.com>
 - [http://nilportugues.com](http://nilportugues.com)


<a name="block7"></a>
## 7. License [↑](#index_block)
SQL Query Builder is licensed under the MIT license.

```
Copyright (c) 2014 Nil Portugués Calderó

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```
