# Upgrade to 2.5

A new method was added to `Doctrine\DBAL\Driver` interface that you need to implement
if your project contains custom drivers.

```php
/**
 * @param \Exception $exception
 *
 * @return int
 */
public function convertExceptionCode(\Exception $exception);
```

The most basic implementation for this method just returns 0:

```php
/**
 * @param \Exception $exception
 *
 * @return int
 */
public function convertExceptionCode(\Exception $exception)
{
    return 0;
}
```

You can see the MySQL, SQLite and PostgreSQL drivers for sample implementations with
the new feature and take a look at `tests/Doctrine/Tests/DBAL/Functional/ExceptionTest.php`
for testing this functionality.

# Upgrade to 2.4

## Doctrine\DBAL\Schema\Constraint

If you have custom classes that implement the constraint interface, you have to implement
an additional method ``getQuotedColumns`` now. This method is used to build proper constraint
SQL for columns that need to be quoted, like keywords reserved by the specific platform used.
The method has to return the same values as ``getColumns`` only that those column names that
need quotation have to be returned quoted for the given platform.

# Upgrade to 2.3

## Oracle Session Init now sets Numeric Character

Before 2.3 the Oracle Session Init did not care about the numeric character of the Session.
This could lead to problems on non english locale systems that required a comma as a floating
point seperator in Oracle. Since 2.3, using the Oracle Session Init on connection start the
client session will be altered to set the numeric character to ".,":

    ALTER SESSION SET NLS_NUMERIC_CHARACTERS = '.,'

See [DBAL-345](http://www.doctrine-project.org/jira/browse/DBAL-345) for more details.

## Doctrine\DBAL\Connection and Doctrine\DBAL\Statement

The query related methods including but not limited to executeQuery, exec, query, and executeUpdate
now wrap the driver exceptions such as PDOException with DBALException to add more debugging
information such as the executed SQL statement, and any bound parameters.

If you want to retrieve the driver specific exception, you can retrieve it by calling the
``getPrevious()`` method on DBALException.

Before:

    catch(\PDOException $ex) {
        // ...
    }

After:

    catch(\Doctrine\DBAL\DBALException $ex) {
        $pdoException = $ex->getPrevious();
        // ...
    }

## Doctrine\DBAL\Connection#setCharsetSQL() removed

This method only worked on MySQL and it is considered unsafe on MySQL to use SET NAMES UTF-8 instead
of setting the charset directly on connection already. Replace this behavior with the
connection charset option:

Before:

    $conn = DriverManager::getConnection(array(..));
    $conn->setCharset('UTF8');

After:

    $conn = DriverManager::getConnection(array('charset' => 'UTF8', ..));

## Doctrine\DBAL\Schema\Table#renameColumn() removed

Doctrine\DBAL\Schema\Table#renameColumn() was removed, because it drops and recreates
the column instead. There is no fix available, because a schema diff
cannot reliably detect if a column was renamed or one column was created
and another one dropped.

You should use explicit SQL ALTER TABLE statements to change columns names.

## Schema Filter paths

The Filter Schema assets expression is not wrapped in () anymore for the regexp automatically.

Before:

    $config->setFilterSchemaAssetsExpression('foo');

After:

    $config->setFilterSchemaAssetsExpression('(foo)');

## Creating MySQL Tables now defaults to UTF-8

If you are creating a new MySQL Table through the Doctrine API, charset/collate are
now set to 'utf8'/'utf8_unicode_ci' by default. Previously the MySQL server defaults were used.

# Upgrade to 2.2

## Doctrine\DBAL\Connection#insert and Doctrine\DBAL\Connection#update

Both methods now accept an optional last parameter $types with binding types of the values passed.
This can potentially break child classes that have overwritten one of these methods.

## Doctrine\DBAL\Connection#executeQuery

Doctrine\DBAL\Connection#executeQuery() got a new last parameter "QueryCacheProfile $qcp"

## Doctrine\DBAL\Driver\Statement split

The Driver statement was split into a ResultStatement and the normal statement extending from it.
This separates the configuration and the retrieval API from a statement.

## MsSql Platform/SchemaManager renamed

The MsSqlPlatform was renamed to SQLServerPlatform, the MsSqlSchemaManager was renamed
to SQLServerSchemaManager.

## Cleanup SQLServer Platform version mess

DBAL 2.1 and before were actually only compatible to SQL Server 2008, not earlier versions.
Still other parts of the platform did use old features instead of newly introduced datatypes
in SQL Server 2005. Starting with DBAL 2.2 you can pick the Doctrine abstraction exactly
matching your SQL Server version.

The PDO SqlSrv driver now uses the new `SQLServer2008Platform` as default platform.
This platform uses new features of SQL Server as of version 2008. This also includes a switch
in the used fields for "text" and "blob" field types to:

    "text" => "VARCHAR(MAX)"
    "blob" => "VARBINARY(MAX)"

Additionally `SQLServerPlatform` in DBAL 2.1 and before used "DATE", "TIME" and "DATETIME2" for dates.
This types are only available since version 2008 and the introduction of an explicit
SQLServer 2008 platform makes this dependency explicit.

An `SQLServer2005Platform` was also introduced to differentiate the features between
versions 2003, earlier and 2005.

With this change the `SQLServerPlatform` now throws an exception for using limit queries
with an offset, since SQLServer 2003 and lower do not support this feature.

To use the old SQL Server Platform, because you are using SQL Server 2003 and below use
the following configuration code:

    use Doctrine\DBAL\DriverManager;
    use Doctrine\DBAL\Platforms\SQLServerPlatform;
    use Doctrine\DBAL\Platforms\SQLServer2005Platform;

    // You are using SQL Server 2003 or earlier
    $conn = DriverManager::getConnection(array(
        'driver' => 'pdo_sqlsrv',
        'platform' => new SQLServerPlatform()
        // .. additional parameters
    ));

    // You are using SQL Server 2005
    $conn = DriverManager::getConnection(array(
        'driver' => 'pdo_sqlsrv',
        'platform' => new SQLServer2005Platform()
        // .. additional parameters
    ));

    // You are using SQL Server 2008
    $conn = DriverManager::getConnection(array(
        'driver' => 'pdo_sqlsrv',
        // 2008 is default platform
        // .. additional parameters
    ));
