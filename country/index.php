<?php

function render($templateName, array $data = array())
{
    ob_start();
    extract($data);
    include($templateName);
    return ob_get_clean();
}

function get_records()
{
    header('Content-Type: text/html; charset=utf-8');
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=task', $user, $pass);
    $sqlCountry = 'SELECT Country_ID, Country_Name FROM Classificator_Country ORDER BY Country_Name';
    $sqlRegion = 'SELECT Region_Name FROM Classificator_Region';
    $data = array();
    foreach ($dbh->query($sqlCountry) as $row) {
        $data['country'] .= "<option value=" . $row['Country_ID'] . ">" . $row['Country_Name'] . "</option>";
    }
    foreach ($dbh->query($sqlRegion) as $row) {
        $data['city'] .= "<option>" . $row['Region_Name'] . "</option>";
    }
    return $data;
}

echo render('templates/index.html', get_records());