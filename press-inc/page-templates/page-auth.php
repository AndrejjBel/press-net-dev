<?php
/**
 * Template Name: Auth page
 * Template Post Type: post, page, product
 */

get_header();

if ( is_user_logged_in() ) { ?>
  <script type="text/javascript">
    document.location.href = '/';
  </script>
<?php } ?>

<main id="primary" class="site-main auth-page">

  <!-- Page Content
  ================================================== -->
  <div class="container margin-top-100">
  	<div class="row">
  		<div class="col-xl-5 offset-xl-3">


  			<div class="login-register-page">
  				<!-- Welcome Text -->
  				<div class="welcome-text">
            <?php if ($_REQUEST['login'] == 'failed') { ?>
              <h4 class="warning-login">Вы указали неверные логин или пароль</h4>
            <?php } elseif ($_REQUEST['user_identified'] == 'failed') { ?>
              <h4 class="warning-login">Необходимо подтвердить E-mail</h4>
            <?php } ?>
  					<h3>Мы рады видеть вас снова!</h3>
  					<span>У вас нет аккаунта? <a href="/registration">Зарегистрироваться!</a></span>
  				</div>

  				<!-- Form -->
  				<form name="loginform" id="loginform" action="/wp-login.php" method="post">
  					<div class="input-with-icon-left">
  						<i class="icon-material-baseline-mail-outline"></i>
  						<input type="text" class="input-text with-border" name="log" id="user_login" placeholder="Логин или Email" required autocomplete="off"/>
  					</div>

  					<div class="input-with-icon-left">
  						<i class="icon-material-outline-lock"></i>
  						<input type="password" class="input-text with-border" name="pwd" id="user_pass" placeholder="Пароль" required autocomplete="new-password"/>
  					</div>

            <div class="checkbox">
      				<input type="checkbox" name="rememberme" id="rememberme" value="forever"/>
      				<label for="rememberme"><span class="checkbox-icon"></span> Запомнить меня</label>
      			</div>

            <div class="input-with-icon-left">
  					  <a href="/forgot" class="forgot-password">Забыли пароль?</a>
            </div>

            <button class="button full-width ripple-effect margin-top-10 auth-submit" type="submit" form="loginform" name="wp-submit" id="wp-submit" disabled>Авторизоваться <i class="icon-material-outline-arrow-right-alt"></i></button>
  				</form>
  			</div>

  		</div>
  	</div>
  </div>

  <!-- Spacer -->
  <div class="margin-top-100"></div>
  <!-- Spacer / End-->

    <?php //get_template_part('src/template/page/auth', 'page'); ?>

</main><!-- #main -->

<?php
get_footer();
