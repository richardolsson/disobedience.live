<?php
    $channels = array();
    foreach (array('fb', 'ig', 'tw') as $ch) {
        $url = get_field('misc_social_'.$ch, 'option');
        if (!empty($url)) {
            $channels[$ch] = $url;
        }
    }
?>
            <div class="footer">
                <div class="footer-info">
                    Initiated by Troja Scenkonst |
                    <a href="http://trojascenkonst.se">trojascenkonst.se</a> |
                    <a href="mailto:info@trojascenkonst.se">info@trojascenkonst.se</a>
                </div>
                <div class="footer-social">
                    <ul class="social-list">
                        <?php foreach ($channels as $ch => $url):?>
                        <li class="social-item">
                            <a href="<?php echo $url;?>"><img
                                src="<?php echo get_template_directory_uri();?>/images/social-<?php echo $ch;?>.png"></a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-101447500-2', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
