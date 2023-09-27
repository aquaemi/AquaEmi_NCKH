<?php

    include 'connectdb.php';

    session_start();

    $logged = $_SESSION['logged'];
    $id = $_SESSION['id'];

    if(!isset($logged)){
        header('location:login.php');
    };

    if(isset($_GET['sign_out'])){
        unset($logged);
        unset($id);
        session_destroy();
        header('location:login.php');
    }

    if (isset($_POST['save_profile'])) {
        $update_name = mysqli_real_escape_string($conn, $_POST['edit_essential_info_name']);
        $update_username = mysqli_real_escape_string($conn, $_POST['edit_essential_info_username']);
        $update_bio = mysqli_real_escape_string($conn, $_POST['edit_essential_info_bio']);
     
        mysqli_query($conn, "UPDATE `user_profile` SET full_name = '$update_name', username = '$update_username', user_bio = '$update_bio' WHERE id = '$id'") or die('query failed');
    }
?>
<!DOCTYPE html>
<html lang = "eng">
    <head>
        <title>AquaEmi - Profile</title>
        <meta name = "description" content = "AquaEmi is a groundbreaking project aiming to revolutionize water pollution control through the use of geolocation technology.">
        <link rel = "stylesheet" type = "text/css" href = "../static/profile.css">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/b20eaf92de.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
        <script>
            $(document).ready(function() {
                $("#essential_edit_info").hide();
                $("#edit_other_info").hide();
                $("#overlay_search").hide();
                $("#search_engine").click(function() { 
                    $("#overlay_search").toggle();
                });
                $("#search_back").click(function() { 
                    $("#overlay_search").toggle();
                });
                $("#edit_profile").click(function() { 
                    $("#essential_info").hide();
                    $("#other_info").hide();
                    $("#edit_other_info").show();
                    $("#essential_edit_info").show();
                });
                $("#save_profile").click(function() { 
                    $("#edit_other_info").hide();
                    $("#essential_info").show();
                    $("#other_info").show();
                    $("#essential_edit_info").hide();
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
                    <img src="../static/images/logo.png" alt="AquaEmi's logo" style = "width: 12.5vw; height: 4.5vw;">
                    <div class = "navigation_keys" id = "navigation_keys">
                        <div class = "subjects" id = "subjects">
                            <p><a href = "index" title = "My water" style = "text-decoration: none; color: #00A66F;">My water</a></p>
                            <p><a href = "map" title = "Map" style = "text-decoration: none; color: #00A66F;">Map</a></p>
                            <p><a href = "travel" title = "Travel" style = "text-decoration: none; color: #00A66F;">Travel</a></p>
                            <p><a href = "news" title = "News & Rankings" style = "text-decoration: none; color: #00A66F;">News & Rankings</a></p>
                            <p><a href = "info" title = "Info" style = "text-decoration: none; color: #00A66F;">Info</a></p>
                        </div>
                        <div class = "tools" id = "tools">
                            <img src = "../static/images/search.png" alt="AquaEmi's search icon" style = "width: 2vw" id = "search_engine">
                            <a href = "index"><img src = "../static/images/notifications.PNG" alt="AquaEmi's notifications icon" style = "width: 1.75vw"></a>
                            <a href = "profile"><img src = "../static/images/profile.PNG" alt="AquaEmi's profile icon" style = "width: 1.7vw;"></a>
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
                        <img src = "../static/images/location.PNG" style = "width: 1vw; height: 1.3vw;">
                        <p style = "font-size: 1vw; color: #616161; margin: 0.2vw 0 0 0.7vw; ">Sai Gon river, Ho Chi Minh city, Vietnam</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin: 0.3vw 0 0 0.7vw;">2.1M followers</p>
                        <div class = "wqi_search_result" id = "wqi_search_result">50</div>
                    </div>
                    <div class = "search_result" id = "search_result">
                        <img src = "../static/images/location.PNG" style = "width: 1vw; height: 1.3vw;">
                        <p style = "font-size: 1vw; color: #616161; margin: 0.2vw 0 0 0.7vw; ">Sai Gon river, Ho Chi Minh city, Vietnam</p>
                        <p style = "font-size: 0.8vw; font-weight: bold; margin: 0.3vw 0 0 0.7vw;">2.1M followers</p>
                        <div class = "wqi_search_result" id = "wqi_search_result">50</div>
                    </div>
                </div>
            </div>
            <div class = "content" id = "content">
                <div class = "essential_info" id = "essential_info">
                    <div class = "avatar" id = "avatar">
                        <img src = "../static/images/default_avatar.png" style = "width: 22vw; height: 22vw;">
                    </div>
                    <div class = "essential_info_box" id = "essential_info_box">
                        <div class = "essential_info_name_box" id = "essential_info_name_box">
                            <?php
                                $select = mysqli_query($conn, "SELECT * FROM `user_profile` WHERE id = '$id'") or die('query failed');
                                if(mysqli_num_rows($select) > 0){
                                    $fetch = mysqli_fetch_assoc($select);
                                } echo '<p class = "essential_info_name" id = "essential_info_name">'.$fetch['full_name'].'</p>';
                            ?>
                            <?php 
                                echo '<p class = "essential_info_username" id = "essential_info_username">(@'.$fetch['username'].')</p>'
                            ?>
                            <button class = "edit_profile" id = "edit_profile">Edit profile</button>
                        </div>
                        <p class = "essential_info_type" id = "essential_info_type">Individual</p>
                        <p class = "essential_info_join" id = "essential_info_join">Joined 2 days ago</p>
                        <?php 
                                echo '<div id = "essential_info_bio" class = "essential_info_bio">Bio: '.$fetch['user_bio'].'</div>'
                        ?>
                    </div>
                </div> 
                <div class = "other_info" id = "other_info">
                    <div class = "social_places_info" id = "social_places_info">
                        <div class = "social_info" id = "social_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold; margin-top: 0.3vw;">Social media:</p>
                            <div class = "social_info_box" id = "social_info_box">
                                <div class = "social_info_details_box" id = "social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "social_info_details">linhadora@gmail.com</p>
                                </div>
                                <div class = "social_info_details_box" id = "social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "social_info_details">linhadora@gmail.com</p>
                                </div>
                                <div class = "social_info_details_box" id = "social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "social_info_details">linhadora@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class = "places_info" id = "places_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold;">Places:</p>
                            <div class = "places_info_box" id = "places_info_box">
                                <div class = "places_info_details_box" id = "places_info_details_box">
                                    <img src = "../static/images/places_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "places_info_details">Ho Chi Minh city, Vietnam</p>
                                </div>
                                <div class = "places_info_details_box" id = "places_info_details_box">
                                    <img src = "../static/images/places_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "places_info_details">Ho Chi Minh city, Vietnam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "community_volunteer_info" id = "community_volunteer_info">
                        <div class = "community_info" id = "community_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold; margin-top: 0.3vw;">Community:</p>
                            <div class = "community_info_box" id = "community_info_box">
                                <div class = "community_info_details_box" id = "community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                                <div class = "community_info_details_box" id = "community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                                <div class = "community_info_details_box" id = "community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                            </div>
                        </div>
                        <div class = "volunteer_info" id = "volunteer_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold;">Places:</p>
                            <div class = "volunteer_info_box" id = "volunteer_info_box">
                                <div class = "volunteer_info_details_box" id = "volunteer_info_details_box">
                                    <img src = "../static/images/volunteer_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "volunteer_info_details">Participated in <a href = "" style = "color: #009966; text-decoration: none;">Beach trash cleaning</a></p>
                                </div>
                                <div class = "volunteer_info_details_box" id = "volunteer_info_details_box">
                                    <img src = "../static/images/volunteer_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "volunteer_info_details">Participated in <a href = "" style = "color: #009966; text-decoration: none;">Beach trash cleaning</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "essential_edit_info" id = "essential_edit_info">
                    <div class = "edit_avatar" id = "edit_avatar">
                        <div class = "edit_avatar_upload">
                            <input type ='file' id = "edit_avatar_upload_file" class = "edit_avatar_upload_file" accept=".png, .jpg, .jpeg" />
                            <label for = "edit_avatar_upload_file"></label>
                        </div>
                        <div class="edit_avatar_preview">
                            <div class = "edit_avatar_preview_file" id = "edit_avatar_preview_file" style = "background-image: url('imgs/default_avatar.png');"></div>
                        </div>
                    </div>
                    <div class = "edit_essential_info_box" id = "edit_essential_info_box">
                        <form action = "" method = "post" enctype="multipart/form-data">
                            <div class = "edit_essential_info_name_box" id = "edit_essential_info_name_box">
                                <input type = "text" class = "edit_essential_info_name" id = "edit_essential_info_name" name = "edit_essential_info_name" value = "<?php echo $fetch['full_name'] ?>">
                                <input type = "text" class = "edit_essential_info_username" id = "edit_essential_info_username" name = "edit_essential_info_username" value = "@<?php echo $fetch['username'] ?>">
                                <button type = "submit" class = "save_profile" id = "save_profile" name = "save_profile">Update profile</button>
                            </div>
                            <p class = "essential_info_type" id = "essential_info_type">Individual</p>
                            <p class = "essential_info_join" id = "essential_info_join">Joined 2 days ago</p>
                            <textarea id = "edit_essential_info_bio" class = "edit_essential_info_bio" name = "edit_essential_info_bio" maxlength = "101" placeholder = "Bio: <?php echo $fetch['user_bio']; ?>"></textarea>
                        </form>
                    </div>
                </div>
                <div class = "edit_other_info" id = "edit_other_info">
                    <div class = "edit_social_places_info" id = "edit_social_places_info">
                        <div class = "edit_social_info" id = "edit_social_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold; margin-top: 0.3vw;">Social media:</p>
                            <div class = "edit_social_info_box" id = "edit_social_info_box">
                                <div class = "edit_social_info_details_box" id = "edit_social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <input style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw; outline: none; border-bottom: 0.1vw solid #969696; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif;" id = "edit_social_info_details" value = "linhadora@gmail.com">
                                </div>
                                <div class = "edit_social_info_details_box" id = "edit_social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <input style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw; outline: none; border-bottom: 0.1vw solid #969696; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif;" id = "edit_social_info_details" value = "linhadora@gmail.com">
                                </div>
                                <div class = "edit_social_info_details_box" id = "edit_social_info_details_box">
                                    <img src = "../static/images/social_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <input style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw; outline: none; border-bottom: 0.1vw solid #969696; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif;" id = "edit_social_info_details" value = "linhadora@gmail.com">
                                </div>
                            </div>
                        </div>
                        <div class = "edit_places_info" id = "edit_places_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold;">Places:</p>
                            <div class = "edit_places_info_box" id = "edit_places_info_box">
                                <div class = "edit_places_info_details_box" id = "edit_places_info_details_box">
                                    <img src = "../static/images/places_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <input style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw; outline: none; border-bottom: 0.1vw solid #969696; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif;" id = "edit_social_info_details" value = "Ho Chi Minh city">
                                </div>
                                <div class = "edit_places_info_details_box" id = "edit_places_info_details_box">
                                    <img src = "../static/images/places_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <input style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw; outline: none; border-bottom: 0.1vw solid #969696; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif;" id = "edit_social_info_details" value = "Ho Chi Minh city">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "edit_community_volunteer_info" id = "edit_community_volunteer_info">
                        <div class = "edit_community_info" id = "edit_community_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold; margin-top: 0.3vw;">Community:</p>
                            <div class = "edit_community_info_box" id = "edit_community_info_box">
                                <div class = "edit_community_info_details_box" id = "edit_community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "edit_community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                                <div class = "edit_community_info_details_box" id = "edit_community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "edit_community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                                <div class = "edit_community_info_details_box" id = "edit_community_info_details_box">
                                    <img src = "../static/images/community_profile.PNG" style = "width: 1.8vw; height: 1.8vw;">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "edit_community_info_details"><a href = "" style = "color: #009966; text-decoration: none;">Finding volunteer in riverside cleaning</a></p>
                                </div>
                            </div>
                        </div>
                        <div class = "edit_volunteer_info" id = "edit_volunteer_info">
                            <p style = "font-family: 'Inter', sans-serif; font-size: 1vw; font-weight: bold;">Places:</p>
                            <div class = "edit_volunteer_info_box" id = "edit_volunteer_info_box">
                                <div class = "edit_volunteer_info_details_box" id = "edit_volunteer_info_details_box">
                                    <img src = "../static/images/volunteer_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "edit_volunteer_info_details">Participated in <a href = "" style = "color: #009966; text-decoration: none;">Beach trash cleaning</a></p>
                                </div>
                                <div class = "edit_volunteer_info_details_box" id = "edit_volunteer_info_details_box">
                                    <img src = "../static/images/volunteer_profile.PNG" style = "width: 1.6vw; height: 1.8vw">
                                    <p style = "font-size: 1vw; margin: 0.1vw 0 0 0.3vw;" id = "edit_volunteer_info_details">Participated in <a href = "" style = "color: #009966; text-decoration: none;">Beach trash cleaning</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action = "" method = "get">
                    <button type = "submit" name = "sign_out" class = "edit_profile" id = "sign_out" style = "margin: 1vw 0 1vw 2vw; width: 9vw;">Sign out</button>
                </form>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_avatar_preview_file').css('background-image', 'url('+e.target.result +')');
                    $('#edit_avatar_preview_file').hide();
                    $('#edit_avatar_preview_file').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#edit_avatar_upload_file").change(function() {
            readURL(this);
        });
    </script>
</html>