<?php

/**
 * Class MyImport
 * Imports zip code data that have downloaded from https://www.geonames.org/
 * and puts them in an SQLite database. One database for each countryCode.
 * Example: http://download.geonames.org/export/zip/SE.zip
 * Trigger this import with: http://local.labs.se/svg-maps2/import.php?countryCode=SE
 * or any country code you have data for
 * @since 2020-03-15
 */
class GeoNamesImport {

    const DATA_PATH = 'data/raw';

    protected $fields = array();

    /**
     * Import data from GeoNames by two character country code
     * Example: SE or DE
     * @param string $countryCode
     * @return array
     */
    public function import($countryCode = 'SE'): array
    {
        $out = array(
            'answer' => 'false',
            'message' => '',
            'country_code' => $countryCode,
            'db_name' => '',
            'rows_stored' => 0,
            'rows_duplicate' => 0
        );

        if (empty($countryCode)) {
            $out['message'] = 'Please provide a country code. Example: SE';
            goto leave;
        }

        $fullPath = $this->getFullPath($countryCode, 'txt');

        $fileHandler = fopen($fullPath , "r");
        if (!$fileHandler) {
            $out['message'] = 'Could not open any file for that country code';
            goto leave;
        }

        $dbName = 'data/' . strtolower($countryCode) . '.sqlite';
        $out['db_name'] = $dbName;

        $response = $this->openDatabase($dbName);
        if ($response['answer'] === 'false') {
            $out['message'] = $response['answer'];
            goto leave;
        }

        if (empty($this->fields)) {
            $fields = $this->readFields($countryCode);
            $this->fields = $fields;
        }

        $connection = $response['connection'];

        while (($row = fgets($fileHandler)) !== false)
        {
            $row = str_replace("\n", '', $row);
            $data = explode("\t", $row);

            $dataWithFieldNames = $this->getDataWithFieldNames($data);

            $key = $dataWithFieldNames['postal_code'];
            if (empty($key)) {
                continue;
            }

            $response = $this->storeOnePostInTheDatabase($connection, $key, $dataWithFieldNames);
            if ($response['answer'] === 'false') {
                $out['message'] = $response['message'];

                $uniqueKeyError = strpos($response['message'], 'UNIQUE') > 0;

                if ($uniqueKeyError) {
                    $out['rows_duplicate']++;
                    continue;
                }
            }

            $out['rows_stored']++;
        }

        fclose($fileHandler);

        $out['answer'] = 'true';
        $out['message'] = 'SUCCESS, importing the file';

        leave:
        return $out;
    }

    /**
     * Get the full path to the file we will import, or to any support file around that file
     * @param string $countryCode
     * @param string $suffix
     * @return string
     */
    protected function getFullPath(string $countryCode = 'SE', string $suffix = 'txt'): string
    {
        $countryCode = strtoupper($countryCode);
        $suffix = strtolower($suffix);

        $path = $countryCode . '/' . $countryCode . '.' . $suffix;
        $fullPath = self::DATA_PATH . '/' . $path;

        return $fullPath;
    }

    /**
     * Read the fields definition in the SE.json file
     * @param string $countryCode
     * @return array
     */
    protected function readFields($countryCode = 'SE'): array
    {
        $fullPath = $this->getFullPath($countryCode, 'json');

        $dataInFile = file_get_contents($fullPath);
        $dataArray = json_decode($dataInFile, true);

        $fields = array();

        foreach ($dataArray['fields'] as $fieldName => $data) {
            $fields[] = $fieldName;
        }

        return $fields;
    }

    /**
     * Give data in an array. Get data in an array where the key is the field name.
     * @param array $data
     * @return array
     */
    protected function getDataWithFieldNames(array $data = array()): array
    {
        $dataWithFieldName = array();

        for ($nr = 0; $nr < count($this->fields); $nr = $nr + 1)
        {
            $fieldName = '';
            if (isset($this->fields[$nr]) === true) {
                $fieldName = $this->fields[$nr];
            } else {
                goto leave;
            }

            $dataItem = '';
            if (isset($data[$nr]) === true) {
                $dataItem = $data[$nr];
            } else {
                goto leave;
            }

            $dataWithFieldName[$fieldName] = $dataItem;
        }

        leave:
        return $dataWithFieldName;
    }

    /**
     * Generic function that open an SQLite database. You get a connection back
     * Also creates a key-value data table if it does not exist.
     * @param string $dbName
     * @return array
     */
    protected function openDatabase($dbName = ''): array
    {
        $out = array(
            'answer' => 'false',
            'message' => 'Nothing to report',
            'connection' => false
        );

        if (!extension_loaded('pdo_sqlite')) {
            $out['message'] = 'PDO SQLite is not installed';
            goto leave;
        }

        try {
            $fileName = 'sqlite:' . $dbName;
            $connection = new PDO($fileName);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $out['message'] = 'Could not connect - ' . $e->getMessage();
            goto leave;
        }

        $out['connection'] = $connection;

        $sql = <<<'EOD'
CREATE TABLE IF NOT EXISTS "data" (
    "key" VARCHAR(20) PRIMARY KEY  NOT NULL  UNIQUE,
    "bubble" TEXT
)
EOD;
        $response = $this->internal_Execute(array(
            'connection' => $connection,
            'sql' => $sql,
        ));

        $out['answer'] = $response['answer'];
        $out['message'] = $response['message'];

        leave:
        return $out;
    }

    /**
     * Generic function that store data in a database
     * @param $connection
     * @param string $key
     * @param array $data
     * @return array
     */
    protected function storeOnePostInTheDatabase($connection, string $key = '', array $data = []): array
    {
        $in = array(
            'connection' => $connection,
            'sql' => 'insert into {table_name} (key, bubble) values (:key, :bubble)',
            'key' => $key,
            'bubble' => json_encode($data, JSON_PRETTY_PRINT),
            'table_name' => 'data'
        );

        $response = $this->internal_Execute($in);

        return $response;
    }

    /**
     * Run a query against the database
     * Also connects the variables in the SQL statement.
     * @param array $in
     * @return array
     */
    protected function internal_Execute(array $in = array()): array
    {
        $default = array(
            'where' => __CLASS__ . '.' . __FUNCTION__,
            'connection' => null,
            'sql' => '',
            'query' => 'false'
        );
        $in = array_merge($default, $in);

        $response = array();
        $message = 'Success running SQL';
        $answer = 'true';

        $query = $in['query'];
        if (strtolower(substr($in['sql'], 0,6)) === 'select') {
            $query = 'true';
        }

        try {
            $in['connection']->beginTransaction(); // Begin transaction
            $in['sql'] = $this->_SubstituteData($in);
            $stmt = $this->_BindData($in);
            $response = $stmt->execute();

            if ($response === false) {
                $in['connection']->rollback();
                $message = 'Failed running SQL';
                $answer = 'false';
                goto leave;
            }

            if ($query === 'true') {
                $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $response = $this->_Boolean($response);
            }

            $in['connection']->commit(); // End transaction

        } catch (PDOException $e) {
            $in['connection']->rollback();
            $message = 'Error executing SQL - ' . $e->getMessage() . '. SQL:' . substr($in['sql'],0,100);
            $answer = 'false';
        }

        leave:
        return array(
            'answer' => $answer,
            'message' => $in['where'] . ' - ' . $message,
            'data' => $response,
            'query' => $query
        );
    }

    /**
     * Used by Execute to substitute parameters in the SQL expression.
     * Example: select * from {database_name}
     * Then you provide 'database_name' => 'my_database' in the $in array.
     * @param array $in
     * @return string
     */
    final protected function _SubstituteData(array $in = array()): string
    {
        foreach ($in as $name => $newData)
        {
            if ($name === 'connection' or $name === 'sql' or $name === 'query') {
                continue;
            }

            if (is_array($newData)) {
                continue;
            }

            $replaceThis = '{' . $name . '}';
            $in['sql'] = str_replace($replaceThis, $newData, $in['sql']);
        }

        return $in['sql'];
    }

    /**
     * Bind parameters in the SQL expression.
     * Example: insert into {table_name} (key, bubble) values (:key, :bubble)
     * Would bind key and bubble with values.
     * @param array $in
     * @return mixed
     */
    final protected function _BindData(array $in = array())
    {
        $stmt = $in['connection']->prepare($in['sql']);

        foreach ($in as $name => $data)
        {
            if ($name === 'connection' or $name === 'sql' or $name === 'query') {
                continue;
            }

            $param = ':' . $name . '';
            if (strpos($in['sql'], $param) === false) {
                continue;
            }

            $stmt->bindValue($name, $data);
        }

        return $stmt;
    }

    /**
     * Convert a boolean to a string
     * @param $value
     * @return string
     */
    final protected function _Boolean(bool $value): string
    {
        return $value ? 'true' : 'false';
    }

}

$myImport = new GeoNamesImport();
$countryCode = '';
if (isset($_GET['countryCode']) === true) {
    $countryCode = $_GET['countryCode'];
}
$response = $myImport->import($countryCode);
var_dump($response);
