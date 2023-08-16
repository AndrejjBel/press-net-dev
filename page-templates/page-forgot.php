<?php
/**
 * Template Name: Forgot password page
 * Template Post Type: post, page, product
 */

get_header();
?>

<main id="primary" class="site-main forgot-page container">

    <!-- Page Content
    ================================================== -->
    <div class="login-register-page">

        <div class="login-register-page__content">

            <!-- Welcome Text -->
            <div class="warning-text">
                <span class="warning mb28">The user with the specified data is not registered</span>
            </div>

            <!-- Form -->
            <form class="mb28">
                <h3>Restore password</h3>
                <span class="form-help mb28">Enter an email address. Please note that an email with a new password may end up in the "Spam" folder</span>

                <div class="input-group mb28 user-email-forgot">
                    <input type="text" class="input" name="user_email" id="user_email" placeholder="Your Email" required autocomplete="off"/>
                    <span class="warning-input">Incorrect E-mail entered</span>
                </div>
                <?php wp_nonce_field('exchange_forgot_password','exchange_forgot_password'); ?>
                <button class="button btn-primary auth-submit mb28" type="submit" form="loginform" name="forgot-password" id="forgot-password" disabled>Send</button>
                <div class="link-group-centered">
                    <a href="/login" class="forgot-password">Sign In</a>
                </div>
            </form>

            <div class="forgot-password-end mb28">
                <div class="welcome-text">
                    <p>An email has been sent to your email address with instructions to change your password</p>
                </div>
            </div>

            <a href="/" class="home">Home</a>

        </div>

    </div>

    <!-- Spacer -->
    <div class="margin-top-100"></div>
    <!-- Spacer / End-->

    <?php //get_template_part('src/template/page/forgot', 'password'); ?>

</main><!-- #main -->

<?php
get_footer();
