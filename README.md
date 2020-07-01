# local-rest-sensors

This project runs a quick PHP script that will scrape some things I'm interested in.  I then plug this into my Home Assistant with:

```
# sensors.yaml

- platform: rest
  name: Water Sensors
  json_attributes:
    - snake_river_temp
    - lake_washington_temp
  resource: http://sensors.funwhilelost.com/water.php
  value_template: '{{ value_json.snake_river_temp }}'

- platform: template
  sensors:
    # Snake River from the scraper
    snake_river_temp:
      friendly_name: 'Snake River Temperature'
      value_template: '{{ states.sensor.water_sensors.attributes["snake_river_temp"] }}'
      icon_template: mdi:waves
      unit_of_measurement: '°F'

    # Lake Washington from the scraper
    lake_washington_temp:
      friendly_name: 'Lake Washington Temperature'
      value_template: '{{ states.sensor.water_sensors.attributes["lake_washington_temp"] }}'
      icon_template: mdi:waves
      unit_of_measurement: '°F'
```
