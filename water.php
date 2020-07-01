<?php

// Lower Granite Dam temp in celcius
// https://waterdata.usgs.gov/nwis/uv?cb_00010=on&format=rdb&site_no=13343595&period=1&begin_date=2020-03-25&end_date=2020-04-01

function get_snake_river_temp() {
  $data = file_get_contents('https://waterdata.usgs.gov/nwis/uv?cb_00010=on&format=rdb&site_no=13343595&period=1&begin_date=2020-03-25&end_date=2020-04-01');
  preg_match_all('/USGS.*\t(.+)\tP$/', $data, $matches);
  $last_temp_c = floatval($matches[1][0]);
  $last_temp_f = 32 + (9/5 * $last_temp_c);
  return round($last_temp_f, 2);
}

function get_lk_wash_temp() {
  $data = file_get_contents('https://www.watertemperature.net/united-states/lake-washington-water-temperature.html');
  preg_match_all('/The current water temperature.*?(\d+\.\d)/', $data, $matches);
  $last_temp_f = floatval($matches[1][0]);
  return round($last_temp_f, 2);
}

header('Content-Type: application/json');

$result = (object) [
  'snake_river_temp' => get_snake_river_temp(),
  'lake_washington_temp' => get_lk_wash_temp(),
];

echo json_encode($result);
?>
