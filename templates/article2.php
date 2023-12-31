<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>AquaEmi - Article "The Pacific Ocean's seabed could soon be open for deep-sea mining"</title>
        <meta name = "description" content = "[Description about AquaEmi]">
        <link rel = "stylesheet" type = "text/css" href = "../static/article2.css">
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
                <img src="../static/images/article2 (headline).png" alt="AquaEmi's Article2" style = "width: 100%; height: 20%">
                <div class = "article" id = "article">
                    <div class = "article_content" id = "article_content">
                        <p style = "font-size: 2.2vw; font-weight:900; line-height: 3vw; color:#00704b">The Pacific Ocean's seabed could soon be open for deep-sea mining</p>
                        <p style = "font-size: 0.9vw; margin-top: -1.5vw; line-height: 1.2vw;">Posted by ABC A/P <br> 7 Jul 2023</p>
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
                            <p style = "font-size: 1vw;">The International Seabed Authority is preparing to resume negotiations that could open the world's ocean floor for mining, including for materials critical for the green energy transition.</p>
                            <p style = "font-size: 1vw;">Years-long negotiations are reaching a critical point where the authority will soon need to begin accepting mining permit applications, adding to worries over the potential impacts on sparsely researched marine ecosystems and habitats of the deep sea.</p>
                            <p style = "font-size: 1vw;">Countries and private companies can start applying for provisional licenses if the UN body fails to approve a set of rules and regulations by July 9. Experts say it's unlikely since the process will likely take several years.</p>
                            <p style = "font-size: 1vw;">Here's a look at what deep sea mining is, why some companies and countries are applying for permits to carry it out and why environmental activists are raising concerns.</p>
                            <p style = "font-size: 1.5vw; font-weight: bold;">What is deep-sea mining?</p>
                            <p style = "font-size: 1vw;">Deep-sea mining involves removing mineral deposits and metals from the ocean's seabed.</p>
                            <p style = "font-size: 1vw;">There are three types of such mining: taking deposit-rich polymetallic nodules off the ocean floor, mining massive sea floor sulphide deposits, and stripping cobalt crusts from rock.</p>
                            <p style = "font-size: 1vw;">These nodules, deposits and crusts contain materials, such as nickel, rare earths, cobalt and more, that are needed for batteries and everyday technology like mobile phones and computers.</p>
                            <p style = "font-size: 1vw;">Some companies are looking to vacuum materials from the sea floor using massive pumps, while others are developing artificial intelligence-based technology that would teach deep sea robots how to pluck nodules from the floor.</p>
                            <p style = "font-size: 1vw;">Some are looking to use advanced machines that could mine materials off the sides of huge underwater mountains and volcanoes.</p>
                            <p style = "font-size: 1vw;">Companies and governments view these as strategically important resources that will be needed as onshore reserves are depleted and demand continues to rise.</p>
                            <p style = "font-size: 1.5vw; font-weight: bold;">How is it regulated now?</p>
                            <p style = "font-size: 1vw;">Countries manage their own maritime territory and exclusive economic zones, while the high seas and the international ocean floor are governed by the United Nations Convention on the Law of the Seas.</p>
                            <p style = "font-size: 1vw;">It is considered to apply to states regardless of whether or not they have signed or ratified it.</p>
                            <p style = "font-size: 1vw;">Under the treaty, the seabed and its mineral resources are considered the "common heritage of mankind" that must be managed in a way that protects the interests of humanity through the sharing of economic benefits, support for marine scientific research, and protecting marine environments.</p>
                            <p style = "font-size: 1vw;">Mining companies interested in deep sea exploitation are partnering with countries to help them get exploration licenses.</p>
                            <p style = "font-size: 1vw;">More than 30 exploration licenses have been issued so far, with activity mostly focused in an area called the Clarion-Clipperton Fracture Zone, which spans 4.5 million square kilometres in the Pacific Ocean between Hawaii and Mexico.</p>
                            <img src="../static/images/picture1_article2.png" alt="AquaEmi's Article2 first picture" style = "width: 100%; height: 100%;">
                            <p style = "font-size: 0.8vw; font-style: italic; margin: 1vw 4vw">Mining exploration areas shown in orange in the CCZ, with Hawaii to the north-west, Kiribati in the south-west and Mexico to the east.(Supplied: Frontiers in Marine Science/Travis Washburn et al)</p>
                            <p style = "font-size: 1.5vw; font-weight: bold;">What are the environmental concerns?</p>
                            <p style = "font-size: 1vw;">Only a small part of the deep seabed has been explored and conservationists worry that ecosystems will be damaged by mining, especially without any environmental protocols.</p>
                            <p style = "font-size: 1vw;">Damage from mining can include noise, vibration and light pollution, as well as possible leaks and spills of fuels and other chemicals used in the mining process.</p>
                            <p style = "font-size: 1vw;">The full extent of implications for deep sea ecosystems is unclear, but scientists have warned that biodiversity loss is inevitable and potentially irreversible.</p>
                            <p style = "font-size: 1vw;"><a href = "https://www.abc.net.au/news/2023-04-07/pacific-fears-grow-as-deep-sea-mining-applications-set-to-open/102182066" style = "text-decoration: none; font-weight: bold; color:#00cf8a">Cook Island resident Alanna Smith said earlier this year</a> that any damage to ocean ecosystems would be devastating for her country, where the sea is central to life.</p>
                            <p style = "font-size: 1vw;">"I've always admired watching my aunties out on the reefs, getting seafood to bring home, so it's provided for us," she told Pacific Beat. </p>
                            <img src="../static/images/picture2_article2.png" alt="AquaEmi's Article2 second picture" style = "width: 90%; height: 90%; margin: 0 1.5vw">
                            <p style = "font-size: 0.8vw; font-style: italic; margin: 0.5vw 4vw">Alanna Smith says Pacific Islanders have a spiritual connection to the deep sea.(Facebook: Alanna Smith)</p>
                            <p style = "font-size: 1vw;">Ms Smith now works for an environmental NGO called Te Ipukarea Society, which advocates for protecting the ocean.</p>
                            <p style = "font-size: 1vw;">She said it was too early to consider deep-sea mining in the area.</p>
                            <p style = "font-size: 1.2vw; text-align: center;">"[It] is very concerning given there's still a lot of data and research that has to be collected," Ms Smith said.</p>
                            <p style = "font-size: 1vw;">"We're constantly finding new stuff and it's a little bit premature to start mining the deep sea when we don't really understand the biology, the environments, the ecosystems or anything else," said Christopher Kelley, a biologist with research expertise in deep-sea ecology.</p>
                            <img src="../static/images/picture3_article2.png" alt="AquaEmi's Article2 third picture" style = "width: 90%; height: 90%; margin: 0 1.5vw">
                            <p style = "font-size: 0.8vw; font-style: italic; margin: 0.5vw 4vw">Environmental advocates say not enough is known about the impacts of deep-sea mining.(Nautilus Minerals)</p>
                            <p style = "font-size: 1.5vw; font-weight: bold;">What's next?</p>
                            <p style = "font-size: 1vw;">The ISA's Legal and Technical Commission, which oversees the development of deep-sea mining regulations, will meet in early July to discuss the yet-to-be mining code draft.</p>
                            <p style = "font-size: 1vw;">The earliest that mining under ISA regulations could begin is in late 2024 or 2025. Applications for mining must be considered and environmental impact assessments need to be carried out.</p>
                            <p style = "font-size: 1vw;">In the meantime, some companies — such as Google, Samsung, BMW and others — have backed the World Wildlife Fund's call to pledge to avoid using minerals that have been mined from the planet's oceans.</p>
                            <p style = "font-size: 1vw;">More than a dozen countries—including France, Germany and several Pacific Island nations— have officially called for a ban, pause or moratorium on deep sea mining at least until environmental safeguards are in place, although it’s unclear how many other countries support such mining.</p>
                            <p style = "font-size: 1vw;">Other countries, such as Norway and the Cook Islands, are proposing opening their waters to mining.</p>
                            <p style = "font-size: 1vw;">Cook Islands Prime Minister Mark Brown <a href = "https://www.theguardian.com/world/2023/jul/07/cook-islands-deep-sea-mining?" style = "text-decoration: none; color: #00cf8a; font-weight: bold;">told The Guardian that pursuing the controversial practice was "the right thing to do for our country"</a>, and that it proceeded with caution.</p>
                        </div>
                    </div>
                    <div class = "others" id = "others">
                        <p style = "font-weight: bold; color: #919191; font-size: 1vw; margin-left: 1vw">Related articles</p>
                        <div class = "related_article" id = "related_article" style = "height: 7.6vw">
                            <a href = "{{ url_for('article1_page') }}"><img src="../static/images/related article1.png" alt="AquaEmi's related article" style = "width: 7vw; height: 7.6vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article1_page') }}" class = "name"><p style = "font-size: 1vw; font-weight: bold;">US agency takes unprecedented action to tackle PFAS water pollution</p></a>
                                <a href = "{{ url_for('article1_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">2 hours ago</p></a>
                                <a href = "{{ url_for('article1_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 9.7vw">
                            <a href = "{{ url_for('article3_page') }}"><img src="../static/images/related article3.png" alt="AquaEmi's related article" style = "width: 7vw; height: 9.7vw"></a>
                            <div class = "related_article_content" id = "related_article_content" style = "padding-right: 1vw">
                                <a href = "{{ url_for('article3_page') }}" class = "name"><p style = "font-size: 1vw; font-weight: bold;">More than 170 trillion plastic particles found in the ocean as pollution reaches ‘unprecedented’ levels</p></a>
                                <a href = "{{ url_for('article3_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">A day ago</p></a>
                                <a href = "{{ url_for('article3_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464; margin-top: -0.3vw;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 7.6vw">
                            <a href = "{{ url_for('article4_page') }}"><img src="../static/images/related article4.png" alt="AquaEmi's related article" style = "width: 7vw; height: 7.6vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article4_page') }}" class = "name"><p style = "font-size: 1vw; font-weight: bold;">Vietnam's groundwater is increasingly polluted</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">Two days ago</p></a>
                                <a href = "{{ url_for('article4_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464; ">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                        <div class = "related_article" id = "related_article" style = "height: 8.6vw">
                            <a href = "{{ url_for('article5_page') }}"><img src="../static/images/related article5.png" alt="AquaEmi's related article" style = "width: 7vw; height: 8.7vw"></a>
                            <div class = "related_article_content" id = "related_article_content">
                                <a href = "{{ url_for('article5_page') }}" class = "name"><p style = "font-size: 1vw; font-weight: bold;">Current State of Water Pollution Worldwide: WQI Data and Remedial Measures</p></a>
                                <a href = "{{ url_for('article5_page') }}"><p style = "font-size: 0.8vw; margin-top: -0.7vw;">Sat, July 29, 2023</p></a>
                                <a href = "{{ url_for('article5_page') }}"><p style = "font-size: 0.7vw; font-weight: bold; color: #646464;">READ NOW <i class="fa-solid fa-angle-right fa-2xs"></i></p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <p style = "font-size: 1vw; font-weight: bold;">Source: <a href = "https://www.abc.net.au/pacific/isa-prepares-to-resume-deep-sea-mining-negotiations/102559238" style = "text-decoration: none; color: #00A66F">ABC Pacific</a></p>
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