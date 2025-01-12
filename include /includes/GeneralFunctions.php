function getPlanets($USER)
{
    if(isset($USER['PLANETS']))
        return $USER['PLANETS'];

    $order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

    $sql = "SELECT id, name, galaxy, system, planet, planet_type, image, b_building, b_building_id
            FROM %%PLANETS%% WHERE id_owner = :userId AND destruyed = :destruyed ORDER BY ";

    switch($USER['planet_sort'])
    {
        case 0:
            $sql .= 'id '.$order;
            break;
        case 1:
            $sql .= 'galaxy, system, planet, planet_type '.$order;
            break;
        case 2:
            $sql .= 'name '.$order;
            break;
    }

    $planetsResult = Database::get()->select($sql, array(
        ':userId' => $USER['id'],
        ':destruyed' => 0
    ));
    
    $planetsList = array();

    foreach($planetsResult as $planetRow) {
        $planetsList[$planetRow['id']] = $planetRow;
    }

    return $planetsList;
}
