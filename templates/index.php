<?php
	include 'connectdb.php';
    session_start();
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>AquaEmi - My water</title>
        <meta name = "description" content = "[Description about AquaEmi]">
        <link rel = "stylesheet" type = "text/css" href = "../static/style.css">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/b20eaf92de.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <!-- Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        
        <link rel="stylesheet" href="../static/dist/MarkerCluster.css">
        <link rel="stylesheet" href="../static/dist/MarkerCluster.Default.css">
        <script src="../static/dist/leaflet.markercluster-src.js"></script>
        
        <!-- Leaflet heatmap plugin: https://github.com/Leaflet/Leaflet.heat -->
        <script src="../static/leaflet-heat.js"></script>

        <!-- For search bar -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $("#overlay_search").hide();
                $("#search_engine").click(function() { 
                    $("#overlay_search").toggle();
                });
                $("#search_back").click(function() { 
                    $("#overlay_search").toggle();
                });
            });
        </script>

        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('.search_result').each(function() {
                    $(this).attr('data_search_term', $(this).attr('data_search_term').toLowerCase());
                });
                $('#search_content').on('change keydown paste input', function() {
                    var searchTerm = $(this).val().toLowerCase();
                    console.log(searchTerm);
                    $('.search_result').each(function() {
                        console.log($(this).filter('[data_search_term *= ' + searchTerm + ']'));
                        if ($(this).filter('[data_search_term *= ' + searchTerm + ']').length > 0) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <section class = "navigation" id = "navigation">
            <nav>
                <div class = "navigation_bar" id = "navigation_bar">
                    <img src="../static/images/logo.png" alt="AquaEmi's logo" style = "width: 12.5vw; height: 4.5vw;" onclick="location.href='{{url_for('home_page')}}';">
                    <div class = "navigation_keys" id = "navigation_keys">
                        <div class = "subjects" id = "subjects">
                            <p><a href = "index" title = "My water" style = "text-decoration: none; color: #00A66F;">My water</a></p>
                            <p><a href = "map" title = "Map" style = "text-decoration: none; color: #00A66F;">Map</a></p>
                            <p><a href = "travel" title = "Travel" style = "text-decoration: none; color: #00A66F;">Travel</a></p>
                            <p><a href = "news" title = "News & Rankings" style = "text-decoration: none; color: #00A66F;">News & Rankings</a></p>
                            <p><a href = "info" title = "Info" style = "text-decoration: none; color: #00A66F;">Info</a></p>
                        </div>
                        <div class = "tools" id = "tools">
                            <img src = "../static/images/search.png" alt="AquaEmi's search icon" style = "width: 2vw" id = "search_engine"></a>
                            <a href = "index"><img src = "../static/images/notifications.png" alt="AquaEmi's notifications icon" style = "width: 1.75vw"></a>
                            <a href = "profile"><img src = "../static/images/profile.png" alt="AquaEmi's profile icon" style = "width: 1.7vw;"></a>
                        </div>
                    </div>
                </div>
            </nav>
        </section>
        <div class = "overlay_search" id = "overlay_search">
            <div class = "search_bar" id = "search_bar">
                <img src = "../static/images/search_back.png" style = "width: 1.5vw; height: 0.5w; margin-bottom: -0.15vw;" id = "search_back">
                <input type = "text" id = "search_content" name = "search_content" placeholder = "Enter your location..." style = "font-size: 1vw;">
                <i class="fa-solid fa-x fa-2xs" style="color: #00a56f;" id = "clear_search" onclick = "document.getElementById('search_content').value = ''"></i>
            </div>
            <div class = "search_result_box" id = "search_result_box">
                {% for watersource in watersources_data %}
                    <div class = "search_result" id = "search_result" data_search_term="{{watersource.name}}" style="display: none;" onclick="location.href='{{url_for('detail_page', rivername=watersource.name)}}';">
                        <img src = "../static/images/location.png" style = "width: 1vw; height: 1.3vw;">
                        <p style = "font-size: 1vw; color: #616161; margin: 0.2vw 0 0 0.7vw; ">{{watersource.name}}</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin: 0.3vw 0 0 0.7vw;">{{watersource.followers}}</p>
                        <div class = "wqi_search_result" id = "wqi_search_result">{{watersource.quality}}</div>
                    </div>
                {% endfor %}
            </div>
        </div>
        <section>
            <div id = "map" style="width: 100%; height: 35vw"></div>
            <script>
                var map = L.map('map', {
                    center: [51.505, -0.09],
                    zoom: 3
                });
                    
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                var data = {{ data | safe }};

                // var heat = L.heatLayer(data, {radius: 25, minOpacity: 0.4, gradient: {0.4: 'blue', 0.65: 'lime', 1: 'red'}}).addTo(map);

                var markers = L.markerClusterGroup({
                    iconCreateFunction: function (cluster) {
                        var markers = cluster.getAllChildMarkers();
                        var n = 0;
                        for (var i = 0; i < markers.length; i++) {
                            console.log(markers[i])
                            n += markers[i].number;
                        }
                        n /= Math.max(1, markers.length);
                        n = Math.floor(n);
                        if (n <= 100) {
                            return L.divIcon({ html: '<div><span>' + n + '</span></div>', className: 'marker-cluster marker-cluster-small', /*iconSize: L.point(40, 40)*/ });
                        } else if (n <= 200) {
                            return L.divIcon({ html: '<div><span>' + n + '</span></div>', className: 'marker-cluster marker-cluster-medium', /*iconSize: L.point(40, 40)*/ });
                        } else {
                            return L.divIcon({ html: '<div><span>' + n + '</span></div>', className: 'marker-cluster marker-cluster-large', /*iconSize: L.point(40, 40)*/ });
                        }
                    },
                    spiderfyOnMaxZoom: false, 
                    showCoverageOnHover: false, 
                    zoomToBoundsOnClick: false,
                });

                for (var i = 0; i < data.length; i++) {
                    var a = data[i];
                    var title = a[2];
                    var marker = L.marker(new L.LatLng(a[0], a[1]), {title: title});
                    marker.number = a[2];
                    marker.bindPopup(title);
                    markers.addLayer(marker);

                    // add two nearby marker so it doesn't actually show the marker
                    var title1 = a[2];
                    var marker1 = L.marker(new L.LatLng(a[0], a[1]), {title: title1});
                    marker1.number = a[2];
                    markers.addLayer(marker1);
                }

                map.addLayer(markers);
            </script>
            <div class = "quality" id = "quality" onclick="location.href='details/{{ current.name | safe }}';">
                <div class = "location" id = "location">
                    <p style = "font-size: 2vw; font-weight: bolder; margin-top: 1.2vw;">{{ current.display_name }}</p>
                    <p style = "font-size: 1vw; font-weight: light; margin-top: -2.0vw;">{{ current.country }}</p>
                </div>
                {% if current.quality <= 100 %}
                <div class = "quality_box_content" id = "quality_box_content" style="border: 0.15vw solid #6cbe00;">
                    <div class = "quality_box" id = "quality_box" style="background-color: #A8E05F;">
                        <div class = "image_quality" id = "image_quality" style="background-color: #6cbe00;">
                            <img src = "../static/images/good.png" style = "width: 6vw; height: 6vw;">
                        </div>
                        <div class = "quality_content" id = "quality_content">
                            <div class = "quality_wqi" id = "quality_wqi">
                                <div class = "wqi" id = "wqi" style="color: #3E821F;">
                                    <p style = "font-size: 2.5vw; margin-top: 2.7vw"> {{ current.quality }}</p>
                                    <p style = "margin-top: -2.5vw; font-size: 0.9vw; margin-left: -0.8vw">WQI</p>
                                </div>
                                <div class = "water_quality" id = "water_quality" style="color: #3E821F;">
                                    <p style = "font-size: 1.5vw; font-weight: bold; margin-top: 1vw">GOOD</p>
                                    <p style = "font-size: 0.85vw; margin-top: -1.3vw">Healthy for fish and people</p>
                                </div>
                            </div>
                            <div class = "others" id = "others">
                                <p style = "font-size: 0.9vw;">pH: {{current.ph}}, nồng độ oxi tan: {{current.DO}} ppm </p>
                            </div>
                        </div>
                    </div>
                    <div class = "weather" id = "weather">
                        <div class = "temperature" id = "temperature">
                            <img src = "../static/images/temperature4.png" style = "width: 2vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #94D53F"> {{ current.temperature }} °C </p> 
                        </div>
                        <div class = "wind" id = "wind">
                            <img src = "../static/images/wind3.png" style = "width: 1.8vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #94D53F"> {{ current.flow }} m3/s </p> 
                        </div>
                        <div class = "wet" id = "wet">
                            <img src = "../static/images/wet2.png" style = "margin-top: 0.12vw; width: 1.15vw; height: 1.4vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #94D53F"> {{ current.turbidity }} NTU </p> 
                        </div>
                    </div>
                </div>
                {% elif current_quality <= 200 %}
                <div class = "quality_box_content" id = "quality_box_content" style="border: 0.15vw solid #ff6600;">
                    <div class = "quality_box" id = "quality_box" style="background-color: #fcb07e;">
                        <div class = "image_quality" id = "image_quality" style="background-color: #F6956C;">
                            <img src = "../static/images/moderate.png" style = "width: 6vw; height: 6vw;">
                        </div>
                        <div class = "quality_content" id = "quality_content">
                            <div class = "quality_wqi" id = "quality_wqi">
                                <div class = "wqi" id = "wqi" style="color: #ff6600;">
                                    <p style = "font-size: 2.5vw; margin-top: 2.7vw"> {{ current.quality }}</p>
                                    <p style = "margin-top: -2.5vw; font-size: 0.9vw; margin-left: -0.8vw">WQI</p>
                                </div>
                                <div class = "water_quality" id = "water_quality" style="color: #ff6600;">
                                    <p style = "font-size: 1.5vw; font-weight: bold; margin-top: 1vw">MODERATE</p>
                                    <p style = "font-size: 0.85vw; margin-top: -1.3vw">Unhealthy for sensitive groups of fish and people</p>
                                </div>
                            </div>
                            <div class = "others" id = "others">
                                <p style = "font-size: 0.9vw;">pH: {{current.ph}}, nồng độ oxi tan: {{current.DO}} ppm </p>
                            </div>
                        </div>
                    </div>
                    <div class = "weather" id = "weather">
                        <div class = "temperature" id = "temperature">
                            <img src = "../static/images/temperature5.png" style = "width: 2vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #ff9249"> {{ current.temperature }} °C </p> 
                        </div>
                        <div class = "wind" id = "wind">
                            <img src = "../static/images/wind4.png" style = "width: 1.8vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #ff9249"> {{ current.flow }} m3/s </p> 
                        </div>
                        <div class = "wet" id = "wet">
                            <img src = "../static/images/wet4.png" style = "margin-top: 0.12vw; width: 1.15vw; height: 1.4vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #ff9249"> {{ current.turbidity }} NTU </p> 
                        </div>
                    </div>
                </div>
                {% else %}
                <div class = "quality_box_content" id = "quality_box_content">
                    <div class = "quality_box" id = "quality_box">
                        <div class = "image_quality" id = "image_quality">
                            <img src = "../static/images/alarm.png" style = "width: 6vw; height: 6vw;">
                        </div>
                        <div class = "quality_content" id = "quality_content">
                            <div class = "quality_wqi" id = "quality_wqi">
                                <div class = "wqi" id = "wqi">
                                    <p style = "font-size: 2.5vw; margin-top: 2.7vw"> {{ current.quality }}</p>
                                    <p style = "margin-top: -2.5vw; font-size: 0.9vw; margin-left: -0.8vw">WQI</p>
                                </div>
                                <div class = "water_quality" id = "water_quality">
                                    <p style = "font-size: 1.5vw; font-weight: bold; margin-top: 1vw">ALARM</p>
                                    <p style = "font-size: 0.85vw; margin-top: -1.3vw">Unhealthy for fish and human</p>
                                </div>
                            </div>
                            <div class = "others" id = "others">
                                <p style = "font-size: 0.9vw;">pH: {{current.ph}}, nồng độ oxi tan: {{current.DO}} ppm </p>
                            </div>
                        </div>
                    </div>
                    <div class = "weather" id = "weather">
                        <div class = "temperature" id = "temperature">
                            <img src = "../static/images/temperature.png" style = "width: 2vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #F63E3E"> {{ current.temperature }} °C </p> 
                        </div>
                        <div class = "wind" id = "wind">
                            <img src = "../static/images/wind.png" style = "width: 1.8vw; height: 1.8vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #F63E3E"> {{ current.flow }} m3/s </p> 
                        </div>
                        <div class = "wet" id = "wet">
                            <img src = "../static/images/wet.png" style = "margin-top: 0.12vw; width: 1.15vw; height: 1.4vw">
                            <p style = "margin: 0.25vw 0.5vw; font-size: 1vw; font-weight: bold; color: #F63E3E"> {{ current.turbidity }} NTU </p> 
                        </div>
                    </div>
                </div>
                {% endif %}

                <p style = "font-size: 0.8vw;">Last updated 16:28</p>
                <div class = "data_provided" id = "data_provided">
                    <div class = "logo" id = "logo">
                        <img src="../static/images/logo.png" alt="AquaEmi's logo" style = "width: 6vw; height: 2vw;">
                    </div>
                    <div class = "text" id = "text">
                        <p style = "font-size: 0.8vw">Data provided by</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin-top: -0.5vw;">WQI modeled using satellite data</p>
                    </div>
                    <div class = "more" id = "more">
                        <img src="../static/images/more.png" alt="More information" style = "width: 1vw; height: 1.2vw;">
                    </div>
                </div>
            </div>
            <div class = "earth_map" id = "earth_map">
                <img src = "../static/images/earth.jpg" alt="AquaEmi's logo" style = "width: 8.5vw; height: 6.4vw; cursor: pointer;" onclick = "location.href='map_earth';">
            </div>
            <div class = "influential" id = "influential">
                <img src = "../static/images/total.png" style = "border-radius: 0.3vw; width: 9vw; height: 6.4vw;">
            </div>
        </section>
        <section>
            <div class = "content">
                <div class = "forecast" id = "forecast">
                    <p style = "color: #00A66E; font-weight: bold;">Forecast in {{ current.name }}, {{ current.country }}</p>
                    <div class = "forecast_screen" id = "forecast-screen">
                        {% for prediction in predictions %}
                        <div class = "forecast_box" id = "forecast_box_2days_ago">
                            <div class = "date" id = "date">{{prediction[0].date}}</div>
                            <div class = "time_frames" id = "time_frames">
                                <div class = "time_frame_box" id = "time_frame_box">
                                    <p style = "font-weight: bold; color:#d60000; font-size: 1.25vw;">16:00</p>
                                    <div class = "quality_forecast" id = "quality_forecast"> {{prediction[0].quality}}</div>
                                    <img src = "../static/images/temperaturenew.png" style = "width: 3.5vw; height: 3vw; margin-top: 1vw;">
                                    <p style = "font-weight: bold; font-size: 1.2vw; margin: 0.8vw 0 0.8vw 0; color: rgb(155, 155, 155)">{{prediction[0].temperature}} °C</p>
                                    <img src = "../static/images/drop.png" style = "width: 3vw; height: 3vw;">
                                    <p style = "font-weight: bold; font-size: 1vw; margin: 0.8vw 0 0.8vw 0; color: rgb(155, 155, 155)">{{prediction[0].ph}} pH</p>
                                </div>
                                <div class = "time_frame_box" id = "time_frame_box">
                                    <p style = "font-weight: bold; color:#d60000; font-size: 1.25vw;">18:00</p>
                                    <div class = "quality_forecast" id = "quality_forecast">{{prediction[1].quality}}</div>
                                    <img src = "../static/images/temperaturenew.png" style = "width: 3.5vw; height: 3vw; margin-top: 1vw;">
                                    <p style = "font-weight: bold; font-size: 1.2vw; margin: 0.8vw 0 0.8vw 0; color: rgb(155, 155, 155)">{{prediction[1].temperature}} °C</p>
                                    <img src = "../static/images/drop.png" style = "width: 3vw; height: 3vw;">
                                    <p style = "font-weight: bold; font-size: 1vw; margin: 0.8vw 0 0.8vw 0; color: rgb(155, 155, 155)">{{prediction[1].ph}} pH</p>
                                </div>
                            </div>
                        </div>
                        {% endfor %}
                    </div>
                    <button class = "week_forecast" onclick="location.href='details/{{ current.name | safe }}';">7 DAY FORECAST</button><br>
                    <i class="fa-solid fa-angle-up fa-lg" style = "color: #00A66F; margin: 1.5vw 0 0 47vw;"></i>
                </div>
                <!-- <div class = "other_places" id = "other_places">
                    <div class = "settings">
                        <div class = "add_place_manage" id = "add_place" style = "margin-left: 31.5vw;">Add Place</div>
                        <div class = "add_place_manage" id = "manage">Manage</div>
                    </div>
                    <div class = "other_places_" id = "other_places_">
                        <div class = "other_places_box" id = "other_places_box" style = "margin-right: 4vw;" onclick="location.href='details/{{ current.name | safe }}';">
                            <div class = "other_places_image" id = "other_places_image">
                                <div class = "other_places_temperature" id = "other_places_temperature">
                                    <img src = "../static/images/temperature3.png" style = "width: 3.5vw; height: 3vw;">
                                    <p style = "font-size: 1.7vw; color: #fff; margin: 0.5vw 0 0 9.5vw;">23</p>
                                </div>
                                <p style = "color: #730000; font-weight: bold; font-size: 2vw; margin-top: 1.5vw">MODERATE</p>
                                <img src = "../static/images/moderate.png" style = "width: 11.5vw; height: 12vw; margin-top: -1vw">
                                <p style = "color: #730000; font-size: 2.5vw; margin: 0">51</p>
                            </div>
                            <div class = "other_places_info" id = "other_places_info">
                                <p style = "font-size: 1.8vw; font-weight: bold;">Mekong River</p>
                                <p style = "font-size: 1.2vw; margin-top: -1.5vw">Thailand</p>
                                <div class = "other_places_forecast" id = "other_places_forecast">
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Sat.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Sun.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Mon.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                </div>
                                <div class = "more_info" id = "more_info">
                                    <p style = "font-weight: bold; font-size: 1vw;">18:00 (local time)</p>
                                    <i class="fa-solid fa-angle-up fa-xs" style = "transform: rotate(180deg)"></i>
                                </div>
                            </div>
                        </div>
                        <div class = "other_places_box" id = "other_places_box">
                            <div class = "other_places_image" id = "other_places_image">
                                <div class = "other_places_temperature" id = "other_places_temperature">
                                    <img src = "../static/images/temperature3.png" style = "width: 3.5vw; height: 3vw;">
                                    <p style = "font-size: 1.7vw; color: #fff; margin: 0.5vw 0 0 9.5vw;">23</p>
                                </div>
                                <p style = "color: #730000; font-weight: bold; font-size: 2vw; margin-top: 1.5vw">MODERATE</p>
                                <img src = "../static/images/moderate.png" style = "width: 11.5vw; height: 12vw; margin-top: -1vw">
                                <p style = "color: #730000; font-size: 2.5vw; margin: 0">51</p>
                            </div>
                            <div class = "other_places_info" id = "other_places_info">
                                <p style = "font-size: 1.8vw; font-weight: bold;">Mekong River</p>
                                <p style = "font-size: 1.2vw; margin-top: -1.5vw">Thailand</p>
                                <div class = "other_places_forecast" id = "other_places_forecast">
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Sat.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Sun.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                    <div class = "other_places_forecast_box" id = "other_places_forecast_box">
                                        <p style = "font-weight: bold; font-size: 1.2vw;">Mon.</p>
                                        <div class = "other_places_forecast_quality" id = "other_places_forecast_quality">51 - 100</div>
                                        <div class = "other_places_forecast_wind" id = "other_places_forecast_wind">
                                            <img src = "../static/images/drop.png" style = "width: 2vw; height: 2vw;">
                                            <p style = "color: #979797; font-size: 1.2vw;">14.8 km/h</p>
                                        </div>
                                    </div>
                                </div>
                                <div class = "more_info" id = "more_info">
                                    <p style = "font-weight: bold; font-size: 1vw;">18:00 (local time)</p>
                                    <i class="fa-solid fa-angle-up fa-xs" style = "transform: rotate(180deg)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <p style = "color: #00A66E; font-weight: bold; margin-top: 5vw">News and ranking</p>
                <div class = "news_and_ranking" id = "news_and_ranking">
                    <div class = "ranking" id = "ranking">
                        <p style = "color: #000; font-weight: bold; font-size: 1.7vw; margin-top: -0.5vw;">Live city ranking</p>
                        <p style = "color: #4d4d4d; font-size: 0.8vw; margin-top: -1vw">Based on the water quality information (WQI)</p>
                        <div class = "ranking_board" id = "ranking_board">
                            <div class = "ranking_info">
                                <p style = "margin-right: 2vw;">#</p>
                                <p style = "margin-right: 16vw;">MAJOR CITY</p>
                                <p>WQI</p>
                            </div>
                            
                            {% for country in countries_data %}
                                <div class = "ranking_tops" id = "ranking_top{{ country.id }}">
                                    <p style = "margin-right: 2.1vw;"> {{ country.id }} </p>
                                    <img src = "https://flagsapi.com/{{ country.country_code }}/flat/64.png" style = "width: 1.5vw; height: 1vw; margin: 1.2vw 0.4vw 0 0;">
                                    <p style = "margin-right: 11vw;"><a class = "details"> {{ country.name }} </a></p>
                                    <div class = "wqi_rank"> {{ country.quality }} </div>
                                </div>
                            {% endfor %}
                        </div>
                        <p style = "font-size: 0.7vw; color: #505050; margin-left: 12vw; margin-top: 2vw;">9:00, August 4</p>
                        <button class = "full_ranking" id = "full_ranking" onclick="location.href='{{url_for('rank_page')}}';">SEE FULL RANKING</button>
                    </div>
                    <div class = "news" id = "news">
                        <div class = "headline" id = "headline">
                            <a href = "{{url_for('article1_page')}}"><img src = "../static/images/article1.png" style = "width: 38vw; height: 27vw;"></a>
                            <a href = "{{url_for('article1_page')}}"><p style = "font-size: 1.5vw; font-weight: bold; margin-left: 0.5vw; margin-top: 1vw; color: #000;">US agency takes unprecedented action to tackle PFAS water pollution</p></a>
                            <a href = "{{url_for('article1_page')}}"><p style = "font-size: 1vw; margin-top: -1vw; margin-left: 0.5vw; font-style: italic; color: #000">"The US Environmental Protection Agency is taking unprecedented enforcement action over PFAS water pollution by ordering..."</p></a>
                            <a href = "{{url_for('article1_page')}}"><p style = "font-size: 1vw; color: #00A66F; margin-left: 0.5vw">2 hours ago</p></a>
                        </div>
                        <div class = "news_others" id = "news_others">
                            <div class = "news_other_articles" id = "news_other_articles">
                                <a href = "{{url_for('article2_page')}}"><p style = "font-size: 1vw; font-weight: bold; margin-left: 0.5vw; margin-top: 1vw; color: #000;">The Pacific Ocean's seabed could soon be open for deep-sea mining</p></a>
                                <a href = "{{url_for('article2_page')}}"><p style = "font-size: 0.8vw; margin-top: -1vw; margin-left: 0.5vw; font-style: italic; color: #000">"The world's ocean are polluted by a “plastic smog” made up of an estimated 171 trillion plastic particles that if..."</p></a>
                                <a href = "{{url_for('article2_page')}}"><p style = "font-size: 0.5vw; color: #00A66F; margin-left: 0.5vw">7 hours ago</p></a>
                            </div>
                            <div class = "news_other_articles" id = "news_other_articles">
                                <a href = "{{url_for('article3_page')}}"><p style = "font-size: 1vw; font-weight: bold; margin-left: 0.5vw; margin-top: 1vw; color: #000;">More than 170 trillion plastic particles found in the ocean as pollution reaches ‘unprecedented’ levels</p></a>
                                <a href = "{{url_for('article3_page')}}"><p style = "font-size: 0.8vw; margin-top: -1vw; margin-left: 0.5vw; font-style: italic; color: #000">"The US Environmental Protection Agency is taking unprecedented enforcement action over PFAS water pollution by ordering..."</p></a>
                                <a href = "{{url_for('article3_page')}}"><p style = "font-size: 0.5vw; color: #00A66F; margin-left: 0.5vw">A day ago</p></a>
                            </div>
                            <div class = "news_other_articles" id = "news_other_articles">
                                <a href = "{{url_for('article4_page')}}"><p style = "font-size: 1vw; font-weight: bold; margin-left: 0.5vw; margin-top: 1vw; color: #000;">Vietnam's groundwater is increasingly polluted</p></a>
                                <a href = "{{url_for('article4_page')}}"><p style = "font-size: 0.8vw; margin-top: -1vw; margin-left: 0.5vw; font-style: italic; color: #000">"Professor Harry explained through examples such as producing 1 sheet of A4 paper requires 10 liters..."</p></a>
                                <a href = "{{url_for('article4_page')}}"><p style = "font-size: 0.5vw; color: #00A66F; margin-left: 0.5vw">Two days ago</p></a>
                            </div>
                            <div class = "news_other_articles" id = "news_other_articles">
                                <a href = "{{url_for('article5_page')}}"><p style = "font-size: 1vw; font-weight: bold; margin-left: 0.5vw; margin-top: 1vw; color: #000;">Current State of Water Pollution Worldwide: WQI Data and Remedial Measures</p></a>
                                <a href = "{{url_for('article5_page')}}"><p style = "font-size: 0.8vw; margin-top: -1vw; margin-left: 0.5vw; font-style: italic; color: #000">"Water is an invaluable resource, essential for all life forms on Earth. However, with the growth of ..."</p></a>
                                <a href = "{{url_for('article5_page')}}"><p style = "font-size: 0.5vw; color: #00A66F; margin-left: 0.5vw">Sat, July 29, 2023</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class = "footer" id = "footer">
                <img src="../static/images/logo.png" alt="AquaEmi's logo" style = "width: 19vw; height: 6.5vw; margin-top: 1.3vw" onclick="location.href='{{url_for('home_page')}}';">
                <div class = "subjects_footer" id = "subjects_footer">
                    <div class = "first" id = "first">
                        <a href = "{{url_for('info_page')}}" style="text-decoration: none;"><p>Info</p></a>
                        <a href = "{{url_for('home_page')}}" style="text-decoration: none;"><p>My water</p></a>
                    </div>
                    <div class = "second" id = "second">
                        <a href = "{{url_for('map_page')}}" style="text-decoration: none;"><p>Map</p></a>
                        <a href = "{{url_for('travel_page')}}" style="text-decoration: none;"><p>Travel</p></a>
                    </div>
                    <div class = "third" id = "third">
                        <a href = "{{url_for('rank_page')}}" style="text-decoration: none;"><p>News and Rankings</p></a>
                        <p>Profile and notifications</p>
                    </div>
                </div>
                <div class = "mailing_list" id = "mailing_list">
                    <p style = "font-size: 1.2vw; font-weight: bold; color: #008A5C">JOIN OUR MAILING LIST!</p>
                    <input type = "email" class = "email_mailing" id = "email" name = "email" placeholder="Email address">
                    <i class="fa-solid fa-arrow-right fa-sm" style="color: #008a5c;"></i><br>
                    <div class = "social_media" id = "social_media">
                        <i class="fa-brands fa-square-instagram fa-sm" style="color: #01a26d; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-pinterest fa-sm" style="color: #01a26d; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-twitter fa-sm" style="color: #01a26d; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-facebook fa-sm" style="color: #01a26d; margin: 0 0.1vw"></i>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>