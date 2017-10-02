data = {};

$.post('ajax/getMapData.php', {}, function(resp) {
    data = resp;
});

function OpenMap() {
    var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";

    var planeSVG = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";

    var places = ["india", "china", "russia", "malaysia", "russiakomi", "southafrica", "argentina", "brazil", "california", "alabama", "uk"];
    var place_names = ["India", "China", "Russia", "Malaysia", "Russia Komi-republic", "South Africa", "Argentina", "Brazil", "California", "Alabama", "UK"];
    var lat = [11, 36.79, 63.66, 3.27, 64.23, -27.54, -44.0, -7.25, 39.72, 34.68, 51.42];
    var long = [77, 111, 116.53, 102.8, 52.52, 24.2, -70.5, -66.97, -120.412, -86.31, -1.5];
    var zoomlat = [11, 18.59, 33.1712, 9.1712, 21.1712, -5.0, -9.1712, 9.1712, 25.1712, 25.1712, 25.1712];
    var zoomlong = [77, 111.1341, 52.1341, 50.1341, 0.1341, 37, 0.1341, 0.1341, -40.1341, 0.1341, -1.5];
    var level_completed = [];
    var current_level = 0;
    var location_targets = [];
    var lines = [];
    var flights = [6, 7, 8, 9, 11];

    var jsonData = JSON.parse(data);
    var out_places = jsonData["content"];
    for (var i = 0; i < out_places.length; i++) {
        level_completed.push(parseInt(out_places[i]) - 1);
    }
    current_level = parseInt(jsonData["level"]) - 1;



    var put = [];
    var implement = [];

    var open_places = jsonData["open"];
    for (var i = 0; i < open_places.length; i++) {
        var postves = parseInt(open_places[i]) - 1
        if (postves >= 0)
            implement.push(postves);
    }

    for (var i = 0; i < places.length; i++) {
        if (current_level == i || level_completed.includes(i) || !(implement.includes(i))) {
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

    //console.log(implement);

    for (var i = 0; i < places.length; i++) {
        var putName = place_names[i];
        var select = true;
        if (i != current_level) {
            put = [];
        }
        if (!implement.includes(i)) {
            level_color = "#ffff00";
            putName = 'Level not unlocked!';
            select = false;
        } else if (level_completed.includes(i)) {
            level_color = "#4a9e12";
            putName = 'Level Completed';
            select = false;
        } else if (i == current_level) {
            put = lines;
            level_color = "#5f635c";
        } else if (flights.includes(i) && i != 7) {
            level_color = "#ff0000";
        } else {
            level_color = "#0000ff";
        }
        insert_this = {
            "id": places[i],
            "color": level_color,
            "svgPath": targetSVG,
            "title": putName,
            "latitude": lat[i],
            "longitude": long[i],
            "scale": 1.3,
            "zoomLevel": 0.75,
            "zoomLongitude": zoomlong[i],
            "zoomLatitude": zoomlat[i],
            "lines": put,
            "selectable": select
        };
        location_targets.push(insert_this);
    }

    map = AmCharts.makeChart("chartdiv", {
        "type": "map",
        "theme": "none",

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

        "legend": {
            "width": 400,
            "backgroundAlpha": 1,
            "backgroundColor": "#fff",
            "borderAlpha": 1,
            "bottom": 15,
            "right": 15,
            "horizontalGap": 10,
            "data": [{
                "title": "Completed",
                "color": "#4a9e12",
                "markerType": "circle"
            }, {
                "title": "Current",
                "color": "#5f635c",
                "markerType": "circle"
            }, {
                "title": "Remaining",
                "color": "#0000ff",
                "markerType": "circle"
            }, {
                "title": "Important",
                "color": "#ff0000",
                "markerType": "circle"
            }, {
                "title": "Unopened",
                "color": "#ffff00",
                "markerType": "circle"
            }]
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
        var index = places.indexOf(event.mapObject.id);
        var level = (index + 1).toString();
        if (level != 0 && event.mapObject.selectable)
            window.location = "level.php?level=" + level;
    });
}

function OpenPhone() {
    phone=$('.wrap, #pop_mobile');
    if(phone.hasClass('active')){
        phone.removeClass('active');
        document.querySelector('body').onkeydown=null;
    }
    else{
        phone.addClass('active');
        document.querySelector('body').onkeydown=function(e){if(e.keyCode == 27){OpenPhone();}};
    }
}

$('#pop_mobile')
    .on('click', function() {
        OpenPhone();
    });
