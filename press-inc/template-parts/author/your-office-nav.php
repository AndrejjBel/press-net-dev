<nav id="profile-nav">
    <ul>
        <li>
            <a href="#" data-tab="profile" class="active">Profile</a>
        </li>
        <li>
            <a href="#" data-tab="about">Edit profile</a>
        </li>
        <?php if ( is_user_logged_in() && press_net_current_user_type('journalist') ) { ?>
            <li>
                <a href="#" data-tab="media">Media</a>
            </li>
            <li>
                <a href="#" data-tab="journalists">My collegues</a>
            </li>
        <?php } ?>
        <?php if ( is_user_logged_in() && press_net_current_user_type('expert') ) { ?>
            <li>
                <a href="#" data-tab="companies">My companies</a>
            </li>
            <li>
                <a href="#" data-tab="speakers">My speakers</a>
            </li>
        <?php } ?>
        <li>
            <a href="#" data-tab="portfolio">Portfolio</a>
        </li>
        <li>
            <a href="#" data-tab="referer">Referral program</a>
        </li>
    </ul>
</nav>
