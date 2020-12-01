<?php

function Create($table, array $data, $insertId = false) {
    $table = DB_PREFIX . '_' . $table;
    $data = Escape($data);

    $fields = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $query = "insert into {$table} ( {$fields} ) values ( {$values} )";

    return Execute($query, $insertId);
}

function Read($table, $params = null, $fields = '*') {
    $table = DB_PREFIX . '_' . $table;
    $params = ($params) ? " {$params}" : null;

    $query = "select {$fields} from {$table}{$params}";
    $result = Execute($query);

    if (!mysqli_num_rows($result)) {
        return false;
    } else {
        while ($res = mysqli_fetch_assoc($result)) {
            $data[] = $res;
        }
        return $data;
    }
}

function ReadSpecificFields($table, $params = null, $fields) {
    $table = DB_PREFIX . '_' . $table;
    $params = ($params) ? " {$params}" : null;

    $query = "SELECT {$fields} FROM {$table}{$params}";
    $result = Execute($query);

    if (!mysqli_num_rows($result))
        return false;
    else {
        while ($res = mysqli_fetch_assoc($result)) {
            $data[] = $res;
        }

        return $data;
    }
}

function Update($table, array $data, $where = null, $insertId = false) {
    foreach ($data as $key => $value) {
        $fields[] = "{$key} = '{$value}'";
    }

    $fields = implode(', ', $fields);

    $table = DB_PREFIX . "_" . $table;
    $where = ($where) ? " where {$where}" : null;

    $query = "update {$table} set {$fields}{$where}";
    return Execute($query, $insertId);
}

function Delete($table, $where = null) {
    $table = DB_PREFIX . '_' . $table;
    $where = ($where) ? "where {$where}" : null;

    $query = "delete from {$table}{$where}";
    return Execute($query);
}

function Execute($query, $insertId = false) {
    $link = Connect();
    $result = @mysqli_query($link, $query) or die(mysqli_error($link));

    if ($insertId) {
        $result = mysqli_insert_id($link);
    }
    Close($link);
    return $result;
}

function Escape($data) {
    $link = Connect();

    if (!is_array($data)) {
        $data = mysqli_real_escape_string($link, $data);
    } else {
        $arr = $data;

        foreach ($arr as $key => $value) {
            $key = Escape($key);
            $value = Escape($value);

            $data[$key] = $value;
        }
    }
    Close($link);
    return $data;
}

function Close($link) {
    @mysqli_close($link) or die(mysqli_error($link));
}

function Connect() {
    $link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSOWRD, DB_DATABASE) or die(mysqli_connect_error());
    mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));

    return $link;
}
