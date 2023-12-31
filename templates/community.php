<!DOCTYPE html>
<html lang = "eng">
    <head>
        <title>AquaEmi - Community</title>
        <meta name = "description" content = "AquaEmi is a groundbreaking project aiming to revolutionize water pollution control through the use of geolocation technology.">
        <link rel = "stylesheet" type = "text/css" href = "../static/community.css">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/b20eaf92de.js" crossorigin="anonymous"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<!-- For search bar -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </head>
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
                    <img src = "../static/images/search_back.PNG" style = "width: 1.5vw; height: 0.5w; margin-bottom: -0.15vw;" id = "search_back">
                    <input type = "text" id = "search_content" name = "search_content" placeholder = "Enter your location..." style = "font-size: 1vw;">
                    <i class="fa-solid fa-x fa-2xs" style="color: #00a56f;" id = "clear_search" onclick = "document.getElementById('search_content').value = ''"></i>
                </div>
                <div class = "search_result_box" id = "search_result_box">
                    <div class = "search_result" id = "search_result">
                        <img src = "imgs/location.PNG" style = "width: 1vw; height: 1.3vw;">
                        <p style = "font-size: 1vw; color: #616161; margin: 0.2vw 0 0 0.7vw; ">Sai Gon river, Ho Chi Minh city, Vietnam</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin: 0.3vw 0 0 0.7vw;">2.1M followers</p>
                        <div class = "wqi_search_result" id = "wqi_search_result">50</div>
                    </div>
                    <div class = "search_result" id = "search_result">
                        <img src = "imgs/location.PNG" style = "width: 1vw; height: 1.3vw;">
                        <p style = "font-size: 1vw; color: #616161; margin: 0.2vw 0 0 0.7vw; ">Sai Gon river, Ho Chi Minh city, Vietnam</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin: 0.3vw 0 0 0.7vw;">2.1M followers</p>
                        <div class = "wqi_search_result" id = "wqi_search_result">50</div>
                    </div>
                </div>
            </div>
            <div class = "content" id = "content">
                <div class = "search_forum" id = "search_forum">
                    <img src="../static/images/info_background.jpeg" alt="AquaEmi's background" style = "width: 100%; height: 9vw">
                    <div class = "search_forum_bar" id = "search_forum_bar">
                        <input type = "text" id = "search_forum_content" name = "search_forum_content" placeholder = "Search posts...">
                        <img src = "../static/images/search_forum.PNG" class = "search_forum_button" id = "search_forum_button" style = "width: 3.5vw; height: 3.5vw;">
                    </div>
                </div>
                <div class = "forum_headline" id = "forum_headline">
                    <p style = "font-size: 0.9vw; font-weight: bold; color: #00A66F; margin: 0 71vw 0 3vw;">AquaEmi community forums</p>
                    <p style = "font-size: 0.9vw; color: #7D7D7D; margin: 0vw;">Updated September 1, 2023</p>
                </div>
                <div class = "forum_content" id = "forum_content">
                    <div class = "forum_main_content" id = "main_content">
                        <div class = "forum_write_post">
                            <i class="fa-solid fa-x fa-2xs" style="color: #00a56f;"></i>
                            <div class = "forum_write_post_content" id = "forum_write_post_content">
                                <div class = "forum_write_post_title" id = "forum_write_post_title">
                                    <input type = "text" id = "forum_new_post_title" name = "forum_new_post_title" placeholder = "Title" maxlength = "62">
                                    <span class = "count_title" id = "count_title">0</span><span style = "font-size: 1vw; color: #808080;">/62</span>
                                </div>
                                <div class = "forum_write_post_message" id = "forum_write_post_message">
                                    <textarea id = "forum_new_post_message" name = "forum_new_post_message" placeholder = "Enter a message..." maxlength = "1001"></textarea>
                                    <span class = "count_message" id = "count_message">0</span><span style = "font-size: 1vw; color: #808080;">/1001</span>
                                </div>
                                <div class = "forum_write_post_tags" id = "forum_write_post_tags">
                                    <i class="fa-regular fa-bookmark fa-sm" style="color: #00a56f;"></i>
                                    <div class = "forum_write_post_tags_content" id = "forum_write_post_tags_content">✨ Volunteer</div>
                                    <div class = "forum_write_post_tags_content" id = "forum_write_post_tags_content">✨ Volunteer</div>
                                    <div class = "forum_write_post_tags_content" id = "forum_write_post_tags_content">✨ Volunteer</div>
                                </div>
                                <button class = "forum_write_post_submit" id = "forum_write_post_submit">Post</button>
                            </div>
                        </div>
                        <p style = "font-size: 1vw; font-weight: bold; font-family: 'Karma', serif;">Recent activity</p>
                        <div class = "forum_feeds" id = "forum_feeds">
                            <div class = "forum_feeds_post" id = "forum_feeds_post">
                                <div class = "forum_feeds_post_tags" id = "forum_feeds_post_tags">
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">✨ Volunteer</div>
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">🔍 Recuitment</div>
                                </div>
                                <p style = "font-weight: 500 ;font-size: 1.5vw; font-family: 'Karma', serif; margin-top: 1vw;">Finding volunteer for riverside trash cleaning 🚮 </p>
                                <p style = "margin-top: -1.5vw; font-size: 0.9vw;">HappyWater: Hello everyone! We are looking for volunteers to pick up trash in the Mekong riverside. You blah blah blah blah blah blah blah blah blah blah blah blah... </p>
                                <div class = "forum_feeds_post_reacts" id = "forum_feeds_post_reacts">
                                    <img src="../static/images/heart.PNG" style = "width: 1.1vw; height: 1vw">
                                    <p id = "forum_feeds_post_hearts" style = "font-size: 0.9vw; margin: 0 0.5vw;">18</p>
                                    <img src="../static/images/comments.PNG" style = "width: 1.2vw; height: 1.1vw">
                                    <p id = "forum_feeds_post_comments" style = "font-size: 0.9vw; margin: 0 0.5vw;">9</p>
                                    <p style = "font-size: 0.9vw; color: #7D7D7D; margin: 0 0 0 52vw;">Posted a day ago</p>
                                </div>
                            </div>
                            <div class = "forum_feeds_post" id = "forum_feeds_post">
                                <div class = "forum_feeds_post_tags" id = "forum_feeds_post_tags">
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">✨ Volunteer</div>
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">🔍 Recuitment</div>
                                </div>
                                <p style = "font-weight: 500 ;font-size: 1.5vw; font-family: 'Karma', serif; margin-top: 1vw;">Finding volunteer for riverside trash cleaning 🚮 </p>
                                <p style = "margin-top: -1.5vw; font-size: 0.9vw;">HappyWater: Hello everyone! We are looking for volunteers to pick up trash in the Mekong riverside. You blah blah blah blah blah blah blah blah blah blah blah blah... </p>
                                <div class = "forum_feeds_post_reacts" id = "forum_feeds_post_reacts">
                                    <img src="../static/images/heart.PNG" style = "width: 1.1vw; height: 1vw">
                                    <p id = "forum_feeds_post_hearts" style = "font-size: 0.9vw; margin: 0 0.5vw;">18</p>
                                    <img src="../static/images/comments.PNG" style = "width: 1.2vw; height: 1.1vw">
                                    <p id = "forum_feeds_post_comments" style = "font-size: 0.9vw; margin: 0 0.5vw;">9</p>
                                    <p style = "font-size: 0.9vw; color: #7D7D7D; margin: 0 0 0 52vw;">Posted a day ago</p>
                                </div>
                            </div>
                            <div class = "forum_feeds_post" id = "forum_feeds_post">
                                <div class = "forum_feeds_post_tags" id = "forum_feeds_post_tags">
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">✨ Volunteer</div>
                                    <div class = "forum_feeds_post_tags_content" id = "forum_feeds_post_tags_content">🔍 Recuitment</div>
                                </div>
                                <p style = "font-weight: 500 ;font-size: 1.5vw; font-family: 'Karma', serif; margin-top: 1vw;">Finding volunteer for riverside trash cleaning 🚮 </p>
                                <p style = "margin-top: -1.5vw; font-size: 0.9vw;">HappyWater: Hello everyone! We are looking for volunteers to pick up trash in the Mekong riverside. You blah blah blah blah blah blah blah blah blah blah blah blah... </p>
                                <div class = "forum_feeds_post_reacts" id = "forum_feeds_post_reacts">
                                    <img src="../static/images/heart.PNG" style = "width: 1.1vw; height: 1vw">
                                    <p id = "forum_feeds_post_hearts" style = "font-size: 0.9vw; margin: 0 0.5vw;">18</p>
                                    <img src="../static/images/comments.PNG" style = "width: 1.2vw; height: 1.1vw">
                                    <p id = "forum_feeds_post_comments" style = "font-size: 0.9vw; margin: 0 0.5vw;">9</p>
                                    <p style = "font-size: 0.9vw; color: #7D7D7D; margin: 0 0 0 52vw;">Posted a day ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "forum_other_content" id = "forum_other_content">
                        <div class = "forum_tags" id = "forum_tags">
                            <p style = "font-size: 1.5vw; font-weight: bold; font-family: 'Karma', serif;">Tags</p>
                            <div class = "forum_tags_box" id = "forum_tags_box">
                                <div class = "forum_tags_content" id = "forum_tags_content">
                                    <p style = "font-size: 0.8vw; margin-top: 0.3vw;">🌱 Environmental</p>
                                </div>
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
                        <p>Community</p>
                    </div>
                    <div class = "second" id = "second">
                        <p>Map</p>
                        <p>Travel</p>
                        <p>Report</p>
                    </div>
                    <div class = "third" id = "third">
                        <p>News and Rankings</p>
                        <p>Profile & notifications</p>
                    </div>
                </div>
                <div class = "mailing_list" id = "mailing_list">
                    <p style = "font-size: 1.2vw; font-weight: bold; color: #008A5C">JOIN OUR MAILING LIST!</p>
                    <input type = "email" class = "email_mailing" id = "email" name = "email" placeholder="Email address">
                    <i class="fa-solid fa-arrow-right fa-sm" style="color: #008A5C;"></i><br>
                    <div class = "social_media" id = "social_media">
                        <i class="fa-brands fa-square-instagram fa-sm" style="color: #008A5C; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-pinterest fa-sm" style="color: #008A5C; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-twitter fa-sm" style="color: #008A5C; margin: 0 0.1vw"></i>
                        <i class="fa-brands fa-facebook fa-sm" style="color: #008A5C; margin: 0 0.1vw"></i>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script id = "rendered-js" >
        (() => {
          const counter = (() => {
            const input = document.getElementById("forum_new_post_title"),
            display = document.getElementById("count_title"),
            changeEvent = evt => display.innerHTML = evt.target.value.length,
            getInput = () => input.value,
            countEvent = () => input.addEventListener('keyup', changeEvent),
            init = () => countEvent();
        
            return {
              init: init };
        
        
          })();
        
          counter.init();
        
        })();

        (() => {
          const counter = (() => {
            const input = document.getElementById("forum_new_post_message"),
            display = document.getElementById("count_message"),
            changeEvent = evt => display.innerHTML = evt.target.value.length,
            getInput = () => input.value,
            countEvent = () => input.addEventListener('keyup', changeEvent),
            init = () => countEvent();
        
            return {
              init: init };
        
        
          })();
        
          counter.init();
        
        })();
    </script>        
</html>