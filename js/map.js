$('#pop_mobile').on('click', function() {
    $('.wrap, #pop_mobile').toggleClass('active');

    var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

    var planeSVG = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";

    var places = ["tamilnadu", "china", "russia", "malaysia", "russiakomi", "southafrica", "argentina", "brazil", "california", "alabama", "uk", "australia"];
    var lat = [11, 36.79, 63.66, 3.27, 64.23, -27.54, -44.0, -7.25, 39.72, 34.68, 51.42, -28.03];
    var long = [77, 111, 116.53, 102.8, 52.52, 24.2, -70.5, -66.97, -120.412, -86.31, -1.5, 129.9];
    var zoomlat = [11, 18.59, 33.1712, 9.1712, 21.1712, -5.0, -9.1712, 9.1712, 25.1712, 25.1712, 25.1712, -22.1712];
    var zoomlong = [77, 111.1341, 52.1341, 50.1341, 0.1341, 37, 0.1341, 0.1341, -40.1341, 0.1341, -1.5, 130.1341];
    var level_completed = [2, 4];
    var current_level = 11;
    var location_targets = [];
    var lines = [];
    var flights = [6, 7, 8, 9, 11];

    for (var i = 0; i < places.length; i++) {
        if (current_level == i || level_completed.includes(i)) {
            continue;
        }

        insert_line = {
            "latitudes": [lat[current_level], lat[i]],
            "longitudes": [long[current_level], long[i]]
        };

        if (flights.includes(current_level)) {
            if (!(([6, 7].includes(i) && [6, 7].includes(current_level)) || ([8, 9].includes(i) && [8, 9].includes(current_level)))) {
                insert_line["arc"] = -0.85;
            }
        } else if (flights.includes(i)) {
            insert_line["arc"] = -0.85;
        }
        lines.push(insert_line);
    }

    for (var i = 0; i < places.length; i++) {
        if (i != current_level) {
            put = [];
        }
        if (level_completed.includes(i)) {
            level_color = "#4a9e12";
        } else if (i == current_level) {
            put = lines;
            level_color = "#5f635c";
        } else if (flights.includes(i) && i != 7) {
            level_color = "#ff0000";
        } else {
            level_color = "#000000";
        }
        insert_this = {
            "id": places[i],
            "color": level_color,
            "svgPath": targetSVG,
            "title": places[i],
            "latitude": lat[i],
            "longitude": long[i],
            "scale": 1.3,
            "zoomLevel": 0.75,
            "zoomLongitude": zoomlong[i],
            "zoomLatitude": zoomlat[i],
            "lines": put
        };
        location_targets.push(insert_this);
    }

    map = AmCharts.makeChart("chartdiv", {
        "type": "map",
        "theme": "none",

        "lines": [{
            "id": "line1",
            "arc": -0.85,
            "alpha": 0.3,
            "latitudes": [48.8567, 43.8163],
            "longitudes": [2.3510, -79.4287]
        }, {
            "id": "line2",
            "alpha": 0,
            "color": "#000000",
            "latitudes": [48.8567, 43.8163],
            "longitudes": [2.3510, -79.4287]
        }],

        "dataProvider": {
            "map": "worldLow",
            "zoomLevel": 1.5,
            "zoomLatitude": 36.79,
            "zoomLongitude": 111,
            "linkToObject": places[current_level],

            "images": location_targets

        },

        "areasSettings": {
            "unlistedAreasColor": "#8dd9ef"
        },

        "imagesSettings": {
            "color": "#585869",
            "rollOverColor": "#585869",
            "selectedColor": "#585869",
            "pauseDuration": 0.2,
            "animationDuration": 2.5,
            "adjustAnimationSpeed": true
        },

        "linesSettings": {
            "color": "#585869",
            "alpha": 0.4
        },

        "balloon": {
            "drop": true
        },

        "backgroundZoomsToTop": true,
        "linesAboveImages": true,

        "export": {
            "enabled": false
        }
    });

    map.addListener("clickMapObject", function(event) {
        console.log('Clicked ID: ' + event.mapObject.id + ' (' + event.mapObject.title + ')');
    });
});