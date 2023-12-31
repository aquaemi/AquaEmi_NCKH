<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>AquaEmi - Article "Current State of Water Pollution Worldwide: WQI Data and Remedial Measures"</title>
        <meta name = "description" content = "[Description about AquaEmi]">
        <link rel = "stylesheet" type = "text/css" href = "../static/article5.css">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/b20eaf92de.js" crossorigin="anonymous"></script>
        <!-- For search bar -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
        <section>
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
            <div class = "content" id = "content">
                <img src="../static/images/article5 (headline).png" alt="AquaEmi's Article5" style = "width: 100%; height: 20%">
                <div class = "article" id = "article">
                    <div class = "article_content" id = "article_content">
                        <p style = "font-size: 2.2vw; font-weight:900; line-height: 3vw; color:#00704b">Current State of Water Pollution Worldwide: WQI Data and Remedial Measures</p>
                        <p style = "font-size: 0.9vw; margin-top: -1.5vw; line-height: 1.2vw;">Written by the AquaEmi team </p>
                        <p style = "font-weight: bold; margin-top: 1.5vw; font-size: 1vw; line-height: 1.2vw; color: #00cf8a">Share this article:</p>
                        <div class = "share_article" id = "share_article">
                            <i class="fa-solid fa-wifi fa-2xs" style="color: #00cf8a;"></i>
                            <i class="fa-brands fa-google fa-2xs" style="color: #00cf8a;"></i>
                            <i class="fa-brands fa-twitter fa-2xs" style="color: #00cf8a;"></i>
                            <i class="fa-brands fa-facebook-f fa-2xs" style="color: #00cf8a;"></i>
                            <i class="fa-brands fa-linkedin-in fa-2xs" style="color: #00cf8a;"></i>
                            <i class="fa-solid fa-envelope fa-2xs" style="color: #00cf8a;"></i>
                        </div>
                        <div class = "text_content" id = "text_content">
                            <p style = "font-size: 1vw;">Water is an invaluable resource, essential for all life forms on Earth. However, with the growth of human activities, water pollution has become a pressing global issue. The contamination of water bodies by pollutants poses significant threats to both human health and the environment. This article aims to shed light on the current state of water pollution worldwide, analyze Water Quality Index (WQI) data, and explore potential remedial measures to address this critical issue.</p>
                            <p style = "font-size: 1vw;">Water pollution is a complex problem with multiple sources, including industrial discharges, agricultural runoff, sewage, and improper waste disposal. Major pollutants include nutrients, heavy metals, pathogens, and chemical contaminants. The consequences of water pollution are far-reaching, affecting both freshwater and marine ecosystems. Additionally, the contamination of water sources directly impacts human populations, leading to various waterborne diseases and compromising access to safe drinking water.</p>
                            <p style = "font-size: 1vw; font-weight: bold;">Water Quality Index (WQI) Data Analysis</p>
                            <img src="../static/images/picture1_article5.png" alt="AquaEmi's Article5 first picture" style = "width: 80%; height: 80%; margin: 1vw 5vw">
                            <p style = "font-size: 1vw;">To gauge the severity of water pollution and its impact on human and ecological health, the Water Quality Index (WQI) has been widely used as a quantitative tool. The WQI assesses multiple parameters, including dissolved oxygen, pH, biochemical oxygen demand (BOD), total dissolved solids (TDS), and presence of heavy metals and bacteria.</p>
                            <p style = "font-size: 1vw;">According to recent WQI data analysis from various countries, the overall water quality is alarming. Many water bodies, including rivers, lakes, and coastal areas, have WQI values below acceptable standards, indicating compromised water quality. For instance, in parts of Asia, such as India and China, water pollution is widespread due to industrial and agricultural activities, leading to reduced water quality and health hazards. Similarly, in parts of Africa and South America, inadequate sanitation practices contribute to the contamination of water sources, resulting in high WQI values.</p>
                            <p style = "font-size: 1vw; font-weight: bold;">Remedial Measures</p>
                            <p style = "font-size: 1vw;">Improved Wastewater Treatment: Implementing advanced wastewater treatment technologies can significantly reduce the discharge of pollutants into water bodies. Treatment plants equipped with biological and chemical processes can efficiently remove contaminants, enhancing water quality.</p>
                            <p style = "font-size: 1vw;">Sustainable Agriculture: Promoting sustainable agricultural practices, such as reducing the use of chemical fertilizers and pesticides, can minimize agricultural runoff and nutrient pollution. Encouraging precision irrigation methods can also reduce water wastage.</p>
                            <p style = "font-size: 1vw;">Strengthening Legislation and Enforcement: Governments worldwide should enact and enforce stringent laws and regulations to prevent industrial discharge and illegal waste dumping into water bodies. Regular monitoring and penalties for non-compliance can deter polluters.</p>
                            <p style = "font-size: 1vw;">Reforestation and Wetland Restoration: Reforestation efforts can help protect watersheds and reduce soil erosion, thus preventing sediment and nutrient runoff into water sources. Wetland restoration can act as natural filters, improving water quality.</p>
                            <p style = "font-size: 1vw;">Public Awareness and Education: Raising public awareness about water pollution and its consequences is vital for encouraging responsible water usage and conservation. Educational programs can empower individuals to adopt eco-friendly practices.</p>
                            <p style = "font-size: 1vw;">Investment in Water Infrastructure: Governments and private sectors must invest in upgrading and expanding water infrastructure to meet the growing demands for clean water and effective wastewater management.</p>
                            <p style = "font-size: 1vw;">The current state of water pollution is a global challenge that demands urgent attention and collective action. The Water Quality Index (WQI) data reflects the severity of the issue, indicating compromised water quality in various regions worldwide. To safeguard our water resources and ensure a sustainable future, proactive remedial measures are essential. By adopting improved wastewater treatment, sustainable agricultural practices, and reforestation efforts, we can protect water bodies and preserve this invaluable resource for generations to come. Additionally, robust legislation, public awareness, and investments in water infrastructure are key components in combating water pollution and building a healthier planet. Together, we can overcome this environmental crisis and pave the way for a cleaner and greener world.</p>
                        </div>
                    </div>
                    <div class = "others" id = "others">
                        <p style = "font-weight: bold; color: #919191; font-size: 1vw; margin-left: 1vw">Related articles</p>
                        <div class = "related_article" id = "related_article" style = "height: 7.4vw">
                            <a href = "{{ url_for('article4_page') }}"><img src="../static/images/related article1.png" alt="AquaEmi's related articles" style = "width: 7vw; height: 7.4vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article4_page') }}"><p  class = "name" style = "font-size: 1vw; font-weight: bold;">US agency takes unprecedented action to tackle PFAS water pollution</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">2 hours ago</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 7.4vw">
                            <a href = "{{ url_for('article4_page') }}"><img src="../static/images/related article2.png" alt="AquaEmi's related articles" style = "width: 7vw; height: 7.4vw"></a>
                            <div class = "related_article_content" id = "related_article_content" style = "padding-right: 1vw">
                                <a href = "{{ url_for('article4_page') }}"><p  class = "name" style = "font-size: 1vw; font-weight: bold;">The Pacific Ocean's seabed could soon be open for deep-sea mining</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">7 hours ago</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464; margin-top: -0.3vw;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 10vw">
                            <a href = "{{ url_for('article4_page') }}"><img src="../static/images/related article3.png" alt="AquaEmi's related articles" style = "width: 7vw; height: 10vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article4_page') }}"><p class = "name" style = "font-size: 1vw; font-weight: bold;">More than 170 trillion plastic particles found in the ocean as pollution reaches ‘unprecedented’ levels</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">A day ago</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464; ">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 7.4vw">
                            <a href = "{{ url_for('article4_page') }}"><img src="../static/images/related article4.png" alt="AquaEmi's related articles" style = "width: 7vw; height: 7.4vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article4_page') }}"><p  class = "name" style = "font-size: 1vw; font-weight: bold;">Vietnam's groundwater is increasingly polluted</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">Two days ago</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class = "footer" id = "footer">
                <img src="../static/images/logo.png" alt="AquaEmi's logo" style = "width: 19vw; height: 6.5vw; margin-top: 1.3vw">
                <div class = "subjects_footer" id = "subjects_footer">
                    <div class = "first" id = "first">
                        <p>Intro</p>
                        <p>My water</p>
                    </div>
                    <div class = "second" id = "second">
                        <p>Map</p>
                        <p>Travel</p>
                    </div>
                    <div class = "third" id = "third">
                        <p>News and Rankings</p>
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