<?php
/**
 * Template Name: Reg page
 * Template Post Type: post, page, product
 */

get_header();

if ( is_user_logged_in() ) { ?>
  <script type="text/javascript">
    document.location.href = '/';
  </script>
<?php } ?>

<main id="primary" class="site-main reg-page container">

    <!-- Page Content
    ================================================== -->
    <div id="register-page" class="login-register-page">

        <div class="login-register-page__content">

            <!-- Form -->
            <form method="post" id="register-account-form">
                <h3>Let's create your account</h3>
                <p class="mb20">Do you already have an account? <a href="/login">Login</a></p>

                <div class="input-group-two mb20">
                    <button type="button" class="toggle-button active" id="expert">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.6392 10.8663C15.588 10.88 15.5347 10.8835 15.4821 10.8766C15.4296 10.8697 15.379 10.8525 15.3331 10.826C15.2872 10.7995 15.247 10.7643 15.2148 10.7223C15.1825 10.6802 15.1589 10.6323 15.1451 10.5811C15.1314 10.5299 15.1279 10.4766 15.1348 10.4241C15.1417 10.3716 15.1589 10.3209 15.1854 10.275C15.2119 10.2292 15.2471 10.1889 15.2891 10.1567C15.3312 10.1244 15.3791 10.1008 15.4303 10.0871L16.9887 9.66963C17.0919 9.64204 17.2019 9.65657 17.2945 9.71003C17.3871 9.7635 17.4546 9.85153 17.4823 9.95477L17.9006 11.5136C17.9283 11.6169 17.9138 11.727 17.8603 11.8196C17.8338 11.8655 17.7986 11.9057 17.7566 11.938C17.7145 11.9702 17.6666 11.9939 17.6154 12.0076C17.5121 12.0353 17.402 12.0208 17.3093 11.9674C17.2167 11.9139 17.1491 11.8258 17.1214 11.7225L16.9681 11.1498C15.59 13.5487 14.1752 14.0556 11.0382 13.0098C8.8035 12.2649 7.04628 12.9921 5.66212 15.2571C5.6348 15.3028 5.59868 15.3427 5.55585 15.3745C5.51301 15.4062 5.46432 15.4291 5.41258 15.4419C5.36084 15.4547 5.30708 15.4571 5.2544 15.449C5.20173 15.4408 5.15118 15.4224 5.10569 15.3946C5.0602 15.3668 5.02066 15.3303 4.98937 15.2872C4.95807 15.244 4.93564 15.1951 4.92336 15.1432C4.91108 15.0914 4.90921 15.0376 4.91784 14.985C4.92648 14.9324 4.94545 14.8821 4.97367 14.8368C6.54658 12.2621 8.68815 11.3764 11.2935 12.2444C14.0586 13.1663 15.1109 12.8179 16.3043 10.6888L15.6396 10.8667L15.6392 10.8663ZM2.89743 2.94727H19.8364C20.1573 2.94727 20.4651 3.07474 20.692 3.30165C20.9189 3.52855 21.0464 3.8363 21.0464 4.15719V18.6763C21.0464 18.9972 20.9189 19.305 20.692 19.5319C20.4651 19.7588 20.1573 19.8863 19.8364 19.8863H2.89743C2.57654 19.8863 2.26879 19.7588 2.04188 19.5319C1.81497 19.305 1.6875 18.9972 1.6875 18.6763V4.15719C1.6875 3.8363 1.81497 3.52855 2.04188 3.30165C2.26879 3.07474 2.57654 2.94727 2.89743 2.94727ZM2.89743 3.75389C2.79046 3.75389 2.68788 3.79638 2.61225 3.87201C2.53661 3.94765 2.49412 4.05023 2.49412 4.15719V18.6763C2.49412 18.7833 2.53661 18.8859 2.61225 18.9615C2.68788 19.0372 2.79046 19.0797 2.89743 19.0797H19.8364C19.9434 19.0797 20.046 19.0372 20.1216 18.9615C20.1973 18.8859 20.2397 18.7833 20.2397 18.6763V4.15719C20.2397 4.05023 20.1973 3.94765 20.1216 3.87201C20.046 3.79638 19.9434 3.75389 19.8364 3.75389H2.89743ZM3.70405 20.6929H7.73715C7.84411 20.6929 7.94669 20.7354 8.02233 20.811C8.09796 20.8867 8.14046 20.9892 8.14046 21.0962C8.14046 21.2032 8.09796 21.3057 8.02233 21.3814C7.94669 21.457 7.84411 21.4995 7.73715 21.4995H3.70405C3.59708 21.4995 3.4945 21.457 3.41887 21.3814C3.34323 21.3057 3.30074 21.2032 3.30074 21.0962C3.30074 20.9892 3.34323 20.8867 3.41887 20.811C3.4945 20.7354 3.59708 20.6929 3.70405 20.6929ZM14.9967 20.6929H19.0298C19.1368 20.6929 19.2394 20.7354 19.315 20.811C19.3906 20.8867 19.4331 20.9892 19.4331 21.0962C19.4331 21.2032 19.3906 21.3057 19.315 21.3814C19.2394 21.457 19.1368 21.4995 19.0298 21.4995H14.9967C14.8898 21.4995 14.7872 21.457 14.7115 21.3814C14.6359 21.3057 14.5934 21.2032 14.5934 21.0962C14.5934 20.9892 14.6359 20.8867 14.7115 20.811C14.7872 20.7354 14.8898 20.6929 14.9967 20.6929ZM3.70405 4.5605H19.0298C19.1368 4.5605 19.2394 4.603 19.315 4.67863C19.3906 4.75427 19.4331 4.85685 19.4331 4.96381C19.4331 5.07078 19.3906 5.17336 19.315 5.249C19.2394 5.32463 19.1368 5.36712 19.0298 5.36712H3.70405C3.59708 5.36712 3.4945 5.32463 3.41887 5.249C3.34323 5.17336 3.30074 5.07078 3.30074 4.96381C3.30074 4.85685 3.34323 4.75427 3.41887 4.67863C3.4945 4.603 3.59708 4.5605 3.70405 4.5605Z" fill="#8490A5"></path>
                        </svg>
                        <span>I am an expert</span>
                        <span class="role-popover-wrapper" style="display: none">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 12.25C9.8995 12.25 12.25 9.8995 12.25 7C12.25 4.1005 9.8995 1.75 7 1.75C4.1005 1.75 1.75 4.1005 1.75 7C1.75 9.8995 4.1005 12.25 7 12.25Z" fill="#BFCCEE"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M7 2.1875C4.34213 2.1875 2.1875 4.34213 2.1875 7C2.1875 9.65787 4.34213 11.8125 7 11.8125C9.65787 11.8125 11.8125 9.65787 11.8125 7C11.8125 4.34213 9.65787 2.1875 7 2.1875ZM1.3125 7C1.3125 3.85888 3.85888 1.3125 7 1.3125C10.1411 1.3125 12.6875 3.85888 12.6875 7C12.6875 10.1411 10.1411 12.6875 7 12.6875C3.85888 12.6875 1.3125 10.1411 1.3125 7Z" fill="#BFCCEE"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7 9.47949C7.24162 9.47949 7.4375 9.67537 7.4375 9.91699V9.92283C7.4375 10.1645 7.24162 10.3603 7 10.3603C6.75838 10.3603 6.5625 10.1645 6.5625 9.92283V9.91699C6.5625 9.67537 6.75838 9.47949 7 9.47949Z" fill="white"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.17562 3.83159C6.44671 3.69746 6.74524 3.62807 7.0477 3.62891C7.35015 3.62975 7.64829 3.70079 7.91863 3.83643C8.18897 3.97207 8.42413 4.16861 8.60561 4.41057C8.78708 4.65254 8.90992 4.93333 8.96443 5.23084C9.01895 5.52834 9.00367 5.83444 8.91979 6.12503C8.8359 6.41563 8.68571 6.68279 8.48103 6.90547C8.27636 7.12816 8.02278 7.30029 7.74028 7.40833L7.72914 7.41242C7.63967 7.44388 7.56285 7.50355 7.51025 7.58246C7.45764 7.66137 7.4321 7.75523 7.43747 7.84992C7.45116 8.09115 7.26669 8.29781 7.02545 8.31149C6.78421 8.32517 6.57756 8.1407 6.56388 7.89946C6.54777 7.61541 6.62439 7.33382 6.7822 7.0971C6.93872 6.86233 7.16669 6.6843 7.43225 6.58931C7.58645 6.52955 7.72487 6.43514 7.83681 6.31335C7.94984 6.19038 8.03279 6.04284 8.07911 5.88236C8.12543 5.72189 8.13387 5.55285 8.10377 5.38855C8.07366 5.22426 8.00583 5.0692 7.90561 4.93557C7.80539 4.80195 7.67552 4.69341 7.52623 4.61851C7.37694 4.5436 7.2123 4.50437 7.04527 4.50391C6.87824 4.50345 6.71338 4.54176 6.56368 4.61584C6.41397 4.68991 6.2835 4.79773 6.18255 4.93079C6.0365 5.12329 5.76206 5.16094 5.56957 5.01489C5.37708 4.86885 5.33943 4.59441 5.48547 4.40192C5.66828 4.16096 5.90454 3.96573 6.17562 3.83159Z" fill="white"></path>
                            </svg>
                            <div class="role-popover">Specialists in various fields, company representatives who are ready to share their opinions and knowledge with the media</div>
                        </span>
                    </button>

                    <button type="button" class="toggle-button" id="journalist">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5279 5.3565L12.0365 6.84787C11.957 6.92509 11.8504 6.96808 11.7396 6.96761C11.6288 6.96714 11.5225 6.92324 11.4437 6.84534C11.4042 6.8068 11.3728 6.76079 11.3513 6.71C11.3297 6.6592 11.3185 6.60462 11.3183 6.54945C11.3181 6.49428 11.3288 6.43961 11.3499 6.38863C11.371 6.33765 11.402 6.29138 11.4412 6.2525L14.7186 2.97461C15.3742 2.31903 16.4428 2.31692 17.0951 2.96913L19.4879 5.36198C20.1431 6.01713 20.1355 7.08534 19.4824 7.7384L9.16116 18.0597L5.54643 18.5759C4.53043 18.7211 3.7359 17.927 3.88116 16.9085L4.39737 13.2959L9.66011 8.03398C9.73961 7.95675 9.84622 7.91376 9.95705 7.91424C10.0679 7.91471 10.1741 7.9586 10.253 8.0365C10.2924 8.07504 10.3238 8.12105 10.3454 8.17185C10.3669 8.22265 10.3781 8.27722 10.3783 8.33239C10.3786 8.38756 10.3678 8.44223 10.3467 8.49321C10.3256 8.54419 10.2946 8.59047 10.2555 8.62934L5.78685 13.0976L7.27569 14.586L15.0163 6.84534L13.5279 5.3565ZM14.1233 4.76113L17.6959 8.33376L18.8871 7.14303C19.2113 6.8184 19.2184 6.28324 18.8925 5.95734L16.4997 3.5645C16.178 3.24324 15.6433 3.24113 15.3144 3.56998L14.1233 4.76113ZM17.1005 8.92955L15.6121 7.44071L7.87106 15.1818L9.35948 16.6702L17.1005 8.92913V8.92955ZM5.19148 13.6929L4.71485 17.0277C4.64874 17.4912 4.96832 17.8079 5.42727 17.7426L8.76411 17.2656L5.19148 13.6929ZM1.60074 20.6319C1.48907 20.6319 1.38197 20.5875 1.30301 20.5085C1.22405 20.4296 1.17969 20.3225 1.17969 20.2108C1.17969 20.0991 1.22405 19.9921 1.30301 19.9131C1.38197 19.8341 1.48907 19.7898 1.60074 19.7898H22.6576C22.7693 19.7898 22.8764 19.8341 22.9553 19.9131C23.0343 19.9921 23.0786 20.0991 23.0786 20.2108C23.0786 20.3225 23.0343 20.4296 22.9553 20.5085C22.8764 20.5875 22.7693 20.6319 22.6576 20.6319H1.60074Z" fill="#8490A5"></path>
                        </svg>
                        <span>I am a journalist</span>
                        <span class="role-popover-wrapper" style="display: none">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 12.25C9.8995 12.25 12.25 9.8995 12.25 7C12.25 4.1005 9.8995 1.75 7 1.75C4.1005 1.75 1.75 4.1005 1.75 7C1.75 9.8995 4.1005 12.25 7 12.25Z" fill="#BFCCEE"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M7 2.1875C4.34213 2.1875 2.1875 4.34213 2.1875 7C2.1875 9.65787 4.34213 11.8125 7 11.8125C9.65787 11.8125 11.8125 9.65787 11.8125 7C11.8125 4.34213 9.65787 2.1875 7 2.1875ZM1.3125 7C1.3125 3.85888 3.85888 1.3125 7 1.3125C10.1411 1.3125 12.6875 3.85888 12.6875 7C12.6875 10.1411 10.1411 12.6875 7 12.6875C3.85888 12.6875 1.3125 10.1411 1.3125 7Z" fill="#BFCCEE"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7 9.47949C7.24162 9.47949 7.4375 9.67537 7.4375 9.91699V9.92283C7.4375 10.1645 7.24162 10.3603 7 10.3603C6.75838 10.3603 6.5625 10.1645 6.5625 9.92283V9.91699C6.5625 9.67537 6.75838 9.47949 7 9.47949Z" fill="white"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M6.17562 3.83159C6.44671 3.69746 6.74524 3.62807 7.0477 3.62891C7.35015 3.62975 7.64829 3.70079 7.91863 3.83643C8.18897 3.97207 8.42413 4.16861 8.60561 4.41057C8.78708 4.65254 8.90992 4.93333 8.96443 5.23084C9.01895 5.52834 9.00367 5.83444 8.91979 6.12503C8.8359 6.41563 8.68571 6.68279 8.48103 6.90547C8.27636 7.12816 8.02278 7.30029 7.74028 7.40833L7.72914 7.41242C7.63967 7.44388 7.56285 7.50355 7.51025 7.58246C7.45764 7.66137 7.4321 7.75523 7.43747 7.84992C7.45116 8.09115 7.26669 8.29781 7.02545 8.31149C6.78421 8.32517 6.57756 8.1407 6.56388 7.89946C6.54777 7.61541 6.62439 7.33382 6.7822 7.0971C6.93872 6.86233 7.16669 6.6843 7.43225 6.58931C7.58645 6.52955 7.72487 6.43514 7.83681 6.31335C7.94984 6.19038 8.03279 6.04284 8.07911 5.88236C8.12543 5.72189 8.13387 5.55285 8.10377 5.38855C8.07366 5.22426 8.00583 5.0692 7.90561 4.93557C7.80539 4.80195 7.67552 4.69341 7.52623 4.61851C7.37694 4.5436 7.2123 4.50437 7.04527 4.50391C6.87824 4.50345 6.71338 4.54176 6.56368 4.61584C6.41397 4.68991 6.2835 4.79773 6.18255 4.93079C6.0365 5.12329 5.76206 5.16094 5.56957 5.01489C5.37708 4.86885 5.33943 4.59441 5.48547 4.40192C5.66828 4.16096 5.90454 3.96573 6.17562 3.83159Z" fill="white"></path>
                            </svg>
                            <div class="role-popover">Journalists are looking for texture, filming locations, products for reviews, characters and more. To do this, they leave requests on Pressfeed.</div>
                        </span>
                    </button>
                    <input type="hidden" name="account_type" id="account_type" value="expert">
                </div>

                <div id="form-expert" class="account-type-form mb24 active">
                    <div class="field-group-two mb20">
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>Company</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group field-select">
                                <input type="text" class="input" name="company_name" id="company_name" placeholder="Company" value="" required autocomplete="off" />
                                <div class="field-select__options options-company">
                                    <?php //press_net_user_media_parent_list('company'); ?>
                                </div>
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                            <span class="field-group__warning-input">Must be selected from the list</span>
                            <input type="text" name="company_id" id="company_id" value="" class="input-hidden" required />
                        </div>

                        <div class="checkbox mb14">
                            <div class="field-group__title mb14">
                                <span>New company</span>
                            </div>
                            <label for="new_company" class="checkbox__label">
                                <span class="checkbox__label__icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="checkbox__label__text">New company</span>
                            </label>
                            <input type="checkbox" name="new_company" id="new_company" class="checkbox__input" />
                            <span class="checkbox-privacy-text-warning">Field is required</span>
                        </div>
                    </div>
                    <div class="new-company-form">
                        <div class="field-group-two mb14">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Company name</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="company_title" id="company_title" placeholder="Company name" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Job title</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="company_job_title" id="company_job_title" placeholder="Job title" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                        </div>

                        <div class="field-group-two mb14">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Website</span>
                                    <!-- <span class="field-group__title__required">*</span> -->
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="company_website" id="company_website" placeholder="Website" value="" />
                                </div>
                                <!-- <span class="field-group__warning-input">Field is required</span> -->
                            </div>
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>City</span>
                                    <!-- <span class="field-group__title__required">*</span> -->
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="company_city" id="company_city" placeholder="City" value="" />
                                </div>
                                <!-- <span class="field-group__warning-input">Field is required</span> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div id="form-journalist" class="account-type-form mb24">
                    <div class="field-group-two mb20">
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>Choose existing Media</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group field-select">
                                <input type="text" class="input" name="media_name" id="media_name" placeholder="Media" value="" autocomplete="off" />
                                <div class="field-select__options options-media">
                                    <?php //press_net_user_media_parent_list(); ?>
                                </div>
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                            <span class="field-group__warning-input">Must be selected from the list</span>
                            <input type="hidden" name="media_id" id="media_id" value="" />
                        </div>

                        <div class="checkbox mb14">
                            <div class="field-group__title mb14">
                                <span>Creade new Media</span>
                            </div>
                            <label for="new_media" class="checkbox__label">
                                <span class="checkbox__label__icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="checkbox__label__text">Creade new Media</span>
                            </label>
                            <input type="checkbox" name="new_media" id="new_media" class="checkbox__input" />
                            <span class="checkbox-privacy-text-warning">Field is required</span>
                        </div>
                    </div>
                    <div class="new-media-form">
                        <div class="field-group-two mb14">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Media name</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="media_title" id="media_title" placeholder="Media name" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Job title</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="media_job_title" id="media_job_title" placeholder="Job title" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                        </div>

                        <div class="field-group-two mb14">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Website</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="media_website" id="media_website" placeholder="Website" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>City</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input" name="media_city" id="media_city" placeholder="City" value="" data-required="required" />
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                        </div>

                        <div class="field-group-two mb24">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Subject</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group field-select">
                                    <input type="text" class="input" name="subject" id="subject" placeholder="Subject" value="" data-required="required" readonly />
                                    <div class="field-select__options">
                                        <?php press_net_tax_list('mass-media-cat', '', '', false, '<span>', '</span>');?>
                                    </div>
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Format</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group field-select">
                                    <input type="text" class="input" name="format" id="format" placeholder="Format" value="" data-required="required" readonly />
                                    <div class="field-select__options">
                                        <span>Newspaper</span>
                                        <span>Magazine</span>
                                        <span>Online media</span>
                                        <span>Radio</span>
                                        <span>TV</span>
                                        <span>Youtube</span>
                                        <span>Social Media</span>
                                        <span>Other</span>
                                    </div>
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group-two razdelit-form mb20">
                    <div class="input-group user-first-name">
                        <div class="field-group__title">
                            <span>First Name</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <input type="text" class="input" name="first_name" id="first_name" placeholder="First Name" required autocomplete="off"/>
                        <span class="warning-input">Field is required</span>
                    </div>
                    <div class="input-group user-last-name">
                        <div class="field-group__title">
                            <span>Last Name</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <input type="text" class="input" name="last_name" id="last_name" placeholder="Last Name" required autocomplete="off"/>
                        <span class="warning-input">Field is required</span>
                    </div>
                </div>

                <div class="input-group-two mb14">
                    <div class="input-group user-email-register">
                        <div class="field-group__title">
                            <span>Your Email</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <input type="text" class="input" name="email_register" id="email_register" placeholder="Your Email" required autocomplete="off"/>
                        <span class="warning-input">Incorrect E-mail entered</span>
                    </div>

                    <div class="input-group input-with-icon">
                        <div class="field-group__title">
                            <span>Password</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <input type="password" class="input" name="password_register" id="password_register" placeholder="Password" required autocomplete="new-password"/>
                        <svg class="eye-yes is-title active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.57441 12.7075C2.39492 12.4296 2.25003 12.1889 2.14074 12C2.25003 11.8111 2.39492 11.5704 2.57441 11.2925C3.03543 10.5787 3.71817 9.6294 4.60454 8.68394C6.39552 6.77356 8.89951 5 12 5C15.1005 5 17.6045 6.77356 19.3955 8.68394C20.2818 9.6294 20.9646 10.5787 21.4256 11.2925C21.6051 11.5704 21.75 11.8111 21.8593 12C21.75 12.1889 21.6051 12.4296 21.4256 12.7075C20.9646 13.4213 20.2818 14.3706 19.3955 15.3161C17.6045 17.2264 15.1005 19 12 19C8.89951 19 6.39552 17.2264 4.60454 15.3161C3.71817 14.3706 3.03543 13.4213 2.57441 12.7075ZM23 12C23.8944 11.5528 23.8943 11.5524 23.8941 11.5521L23 12ZM23.8941 11.5521C24.0348 11.8336 24.0352 12.1657 23.8944 12.4472L23 12C23.8944 12.4472 23.8938 12.4484 23.8936 12.4488L23.8925 12.4511L23.889 12.458L23.8777 12.4802C23.8681 12.4987 23.8546 12.5247 23.8372 12.5576C23.8025 12.6233 23.752 12.7168 23.686 12.834C23.5542 13.0684 23.3601 13.3985 23.1057 13.7925C22.5979 14.5787 21.8432 15.6294 20.8545 16.6839C18.8955 18.7736 15.8995 21 12 21C8.10049 21 5.10448 18.7736 3.14546 16.6839C2.15683 15.6294 1.40207 14.5787 0.894336 13.7925C0.63985 13.3985 0.445792 13.0684 0.313971 12.834C0.248023 12.7168 0.19754 12.6233 0.162753 12.5576C0.145357 12.5247 0.131875 12.4987 0.122338 12.4802L0.11099 12.458L0.107539 12.4511L0.105573 12.4472L0.999491 12.0003C0.111724 12.4441 0.105434 12.4468 0.105569 12.4472L0.105573 12.4472C-0.0351909 12.1657 -0.0351909 11.8343 0.105573 11.5528L1 12C0.105573 11.5528 0.106186 11.5516 0.10637 11.5512L0.107539 11.5489L0.11099 11.542L0.122338 11.5198C0.131875 11.5013 0.145357 11.4753 0.162753 11.4424C0.19754 11.3767 0.248023 11.2832 0.313971 11.166C0.445792 10.9316 0.63985 10.6015 0.894336 10.2075C1.40207 9.42131 2.15683 8.3706 3.14546 7.31606C5.10448 5.22644 8.10049 3 12 3C15.8995 3 18.8955 5.22644 20.8545 7.31606C21.8432 8.3706 22.5979 9.42131 23.1057 10.2075C23.3601 10.6015 23.5542 10.9316 23.686 11.166C23.752 11.2832 23.8025 11.3767 23.8372 11.4424C23.8546 11.4753 23.8681 11.5013 23.8777 11.5198L23.889 11.542L23.8925 11.5489L23.8941 11.5521ZM10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12ZM12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8Z" fill="black"/>
                        </svg>
                        <svg class="eye-no is-title" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_324_10684)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L4.56849 5.9827C2.7597 7.53968 1.25036 9.41852 0.118844 11.5272C-0.0347895 11.8135 -0.0397387 12.1566 0.105573 12.4472L1 12C0.105573 12.4472 0.106186 12.4485 0.10637 12.4488L0.107539 12.4512L0.11099 12.458L0.122338 12.4802C0.131875 12.4988 0.145357 12.5247 0.162753 12.5576C0.19754 12.6233 0.248023 12.7168 0.313971 12.834C0.445792 13.0684 0.63985 13.3985 0.894336 13.7926C1.40207 14.5787 2.15683 15.6294 3.14546 16.684C5.10448 18.7736 8.10049 21 12 21L12.0163 20.9999C14.0848 20.9661 16.0962 20.3536 17.8261 19.2403L22.2929 23.7071C22.6834 24.0976 23.3166 24.0976 23.7071 23.7071C24.0976 23.3166 24.0976 22.6834 23.7071 22.2929L18.6471 17.2329L14.8311 13.4169L14.824 13.4098L10.5901 9.17595L10.5832 9.16899L6.76711 5.35292L1.70711 0.292893ZM16.3714 17.7856L14.0497 15.464C13.891 15.5635 13.7251 15.652 13.5531 15.7286C13.0625 15.9472 12.5328 16.0648 11.9957 16.0742C11.4586 16.0837 10.9252 15.9849 10.4271 15.7837C9.92902 15.5826 9.47657 15.2831 9.09674 14.9033C8.71691 14.5235 8.41747 14.071 8.21629 13.5729C8.01511 13.0749 7.91631 12.5414 7.92579 12.0043C7.93527 11.4672 8.05282 10.9375 8.27145 10.4469C8.34805 10.2749 8.43652 10.109 8.53604 9.95028L5.9871 7.40134C4.45031 8.7014 3.14935 10.2582 2.14257 12.0032C2.25165 12.1916 2.39592 12.4311 2.57441 12.7075C3.03543 13.4213 3.71817 14.3706 4.60454 15.3161C6.39395 17.2248 8.89512 18.9969 11.9918 19C13.5373 18.9734 15.0437 18.5524 16.3714 17.7856ZM10.0279 11.4421C9.96372 11.6346 9.92907 11.836 9.92548 12.0396C9.92074 12.3081 9.97014 12.5749 10.0707 12.8239C10.1713 13.0729 10.321 13.2992 10.511 13.4891C10.7009 13.679 10.9271 13.8287 11.1761 13.9293C11.4252 14.0299 11.6919 14.0793 11.9604 14.0745C12.164 14.071 12.3655 14.0363 12.5579 13.9721L10.0279 11.4421ZM20.7526 13.6877L12.0732 5.00035C15.1399 5.02799 17.6186 6.78864 19.3955 8.68397C20.2818 9.62943 20.9646 10.5787 21.4256 11.2926C21.6044 11.5694 21.7488 11.8093 21.858 11.9978C21.5223 12.582 21.1532 13.1462 20.7526 13.6877ZM23 12L23.8944 11.5528C23.8946 11.5532 23.8944 11.5528 23 12ZM23.8819 12.4714C24.0348 12.1854 24.0395 11.8429 23.8944 11.5528L23.8925 11.5489L23.889 11.5421L23.8777 11.5198C23.8681 11.5013 23.8546 11.4753 23.8372 11.4425C23.8025 11.3767 23.752 11.2833 23.686 11.166C23.5542 10.9317 23.3601 10.6015 23.1057 10.2075C22.5979 9.42134 21.8432 8.37062 20.8545 7.31608C18.8957 5.22667 15.9001 3.00046 12.0012 3.00003C11.2171 2.99828 10.4355 3.08765 9.67209 3.26634C9.31876 3.34905 9.03796 3.61668 8.93838 3.96563C8.83881 4.31458 8.93609 4.69009 9.19257 4.94681L20.1326 15.8968C20.3306 16.095 20.6027 16.2011 20.8827 16.1891C21.1627 16.1771 21.4247 16.0483 21.6052 15.8339C22.479 14.7953 23.2421 13.6684 23.8819 12.4714ZM12.0012 3.00003L12 3.00003V4.00003L12.0023 3.00003L12.0012 3.00003Z" fill="black"/>
                            </g>
                        </svg>
                        <span id="pass-reg-span-regex" class="warning-input">The password must contain special characters, numbers, lowercase and uppercase letters of the Latin alphabet, from 8 to 16 characters</span>
                    </div>
                </div>

                <!-- <div class="input-group input-with-icon mb24">
                    <input type="password" class="input" name="password-repeat-register" id="password-repeat-register" placeholder="New password again" required autocomplete="new-password"/>
                    <svg class="eye-yes active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.57441 12.7075C2.39492 12.4296 2.25003 12.1889 2.14074 12C2.25003 11.8111 2.39492 11.5704 2.57441 11.2925C3.03543 10.5787 3.71817 9.6294 4.60454 8.68394C6.39552 6.77356 8.89951 5 12 5C15.1005 5 17.6045 6.77356 19.3955 8.68394C20.2818 9.6294 20.9646 10.5787 21.4256 11.2925C21.6051 11.5704 21.75 11.8111 21.8593 12C21.75 12.1889 21.6051 12.4296 21.4256 12.7075C20.9646 13.4213 20.2818 14.3706 19.3955 15.3161C17.6045 17.2264 15.1005 19 12 19C8.89951 19 6.39552 17.2264 4.60454 15.3161C3.71817 14.3706 3.03543 13.4213 2.57441 12.7075ZM23 12C23.8944 11.5528 23.8943 11.5524 23.8941 11.5521L23 12ZM23.8941 11.5521C24.0348 11.8336 24.0352 12.1657 23.8944 12.4472L23 12C23.8944 12.4472 23.8938 12.4484 23.8936 12.4488L23.8925 12.4511L23.889 12.458L23.8777 12.4802C23.8681 12.4987 23.8546 12.5247 23.8372 12.5576C23.8025 12.6233 23.752 12.7168 23.686 12.834C23.5542 13.0684 23.3601 13.3985 23.1057 13.7925C22.5979 14.5787 21.8432 15.6294 20.8545 16.6839C18.8955 18.7736 15.8995 21 12 21C8.10049 21 5.10448 18.7736 3.14546 16.6839C2.15683 15.6294 1.40207 14.5787 0.894336 13.7925C0.63985 13.3985 0.445792 13.0684 0.313971 12.834C0.248023 12.7168 0.19754 12.6233 0.162753 12.5576C0.145357 12.5247 0.131875 12.4987 0.122338 12.4802L0.11099 12.458L0.107539 12.4511L0.105573 12.4472L0.999491 12.0003C0.111724 12.4441 0.105434 12.4468 0.105569 12.4472L0.105573 12.4472C-0.0351909 12.1657 -0.0351909 11.8343 0.105573 11.5528L1 12C0.105573 11.5528 0.106186 11.5516 0.10637 11.5512L0.107539 11.5489L0.11099 11.542L0.122338 11.5198C0.131875 11.5013 0.145357 11.4753 0.162753 11.4424C0.19754 11.3767 0.248023 11.2832 0.313971 11.166C0.445792 10.9316 0.63985 10.6015 0.894336 10.2075C1.40207 9.42131 2.15683 8.3706 3.14546 7.31606C5.10448 5.22644 8.10049 3 12 3C15.8995 3 18.8955 5.22644 20.8545 7.31606C21.8432 8.3706 22.5979 9.42131 23.1057 10.2075C23.3601 10.6015 23.5542 10.9316 23.686 11.166C23.752 11.2832 23.8025 11.3767 23.8372 11.4424C23.8546 11.4753 23.8681 11.5013 23.8777 11.5198L23.889 11.542L23.8925 11.5489L23.8941 11.5521ZM10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12ZM12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8Z" fill="black"/>
                    </svg>
                    <svg class="eye-no" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_324_10684)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L4.56849 5.9827C2.7597 7.53968 1.25036 9.41852 0.118844 11.5272C-0.0347895 11.8135 -0.0397387 12.1566 0.105573 12.4472L1 12C0.105573 12.4472 0.106186 12.4485 0.10637 12.4488L0.107539 12.4512L0.11099 12.458L0.122338 12.4802C0.131875 12.4988 0.145357 12.5247 0.162753 12.5576C0.19754 12.6233 0.248023 12.7168 0.313971 12.834C0.445792 13.0684 0.63985 13.3985 0.894336 13.7926C1.40207 14.5787 2.15683 15.6294 3.14546 16.684C5.10448 18.7736 8.10049 21 12 21L12.0163 20.9999C14.0848 20.9661 16.0962 20.3536 17.8261 19.2403L22.2929 23.7071C22.6834 24.0976 23.3166 24.0976 23.7071 23.7071C24.0976 23.3166 24.0976 22.6834 23.7071 22.2929L18.6471 17.2329L14.8311 13.4169L14.824 13.4098L10.5901 9.17595L10.5832 9.16899L6.76711 5.35292L1.70711 0.292893ZM16.3714 17.7856L14.0497 15.464C13.891 15.5635 13.7251 15.652 13.5531 15.7286C13.0625 15.9472 12.5328 16.0648 11.9957 16.0742C11.4586 16.0837 10.9252 15.9849 10.4271 15.7837C9.92902 15.5826 9.47657 15.2831 9.09674 14.9033C8.71691 14.5235 8.41747 14.071 8.21629 13.5729C8.01511 13.0749 7.91631 12.5414 7.92579 12.0043C7.93527 11.4672 8.05282 10.9375 8.27145 10.4469C8.34805 10.2749 8.43652 10.109 8.53604 9.95028L5.9871 7.40134C4.45031 8.7014 3.14935 10.2582 2.14257 12.0032C2.25165 12.1916 2.39592 12.4311 2.57441 12.7075C3.03543 13.4213 3.71817 14.3706 4.60454 15.3161C6.39395 17.2248 8.89512 18.9969 11.9918 19C13.5373 18.9734 15.0437 18.5524 16.3714 17.7856ZM10.0279 11.4421C9.96372 11.6346 9.92907 11.836 9.92548 12.0396C9.92074 12.3081 9.97014 12.5749 10.0707 12.8239C10.1713 13.0729 10.321 13.2992 10.511 13.4891C10.7009 13.679 10.9271 13.8287 11.1761 13.9293C11.4252 14.0299 11.6919 14.0793 11.9604 14.0745C12.164 14.071 12.3655 14.0363 12.5579 13.9721L10.0279 11.4421ZM20.7526 13.6877L12.0732 5.00035C15.1399 5.02799 17.6186 6.78864 19.3955 8.68397C20.2818 9.62943 20.9646 10.5787 21.4256 11.2926C21.6044 11.5694 21.7488 11.8093 21.858 11.9978C21.5223 12.582 21.1532 13.1462 20.7526 13.6877ZM23 12L23.8944 11.5528C23.8946 11.5532 23.8944 11.5528 23 12ZM23.8819 12.4714C24.0348 12.1854 24.0395 11.8429 23.8944 11.5528L23.8925 11.5489L23.889 11.5421L23.8777 11.5198C23.8681 11.5013 23.8546 11.4753 23.8372 11.4425C23.8025 11.3767 23.752 11.2833 23.686 11.166C23.5542 10.9317 23.3601 10.6015 23.1057 10.2075C22.5979 9.42134 21.8432 8.37062 20.8545 7.31608C18.8957 5.22667 15.9001 3.00046 12.0012 3.00003C11.2171 2.99828 10.4355 3.08765 9.67209 3.26634C9.31876 3.34905 9.03796 3.61668 8.93838 3.96563C8.83881 4.31458 8.93609 4.69009 9.19257 4.94681L20.1326 15.8968C20.3306 16.095 20.6027 16.2011 20.8827 16.1891C21.1627 16.1771 21.4247 16.0483 21.6052 15.8339C22.479 14.7953 23.2421 13.6684 23.8819 12.4714ZM12.0012 3.00003L12 3.00003V4.00003L12.0023 3.00003L12.0012 3.00003Z" fill="black"/>
                        </g>
                    </svg>
                    <span id="pass-reg-rep-span-regex" class="warning-input">Password mismatch</span>
                </div> -->

                <div class="txt-al-r mb20">
                    <a href="#" name="generate-password" id="generate-password">Generate password</a>
                </div>

                <div class="checkbox mb14">
                    <label for="privacy-text" class="checkbox__label">
                        <span class="checkbox__label__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="checkbox__label__text">I agree and accept <a href="#">User Agreement for Content Publishing Rules</a>
                        on <?php bloginfo( 'name' ); ?>, and <a href="#">Privacy Policy</a></span>
                    </label>
                    <input type="checkbox" name="privacy-text" id="privacy-text" class="checkbox__input" required />
                    <span class="checkbox-privacy-text-warning">Must be accepted User Agreement for Content Publishing Rules
                            on <?php bloginfo( 'name' ); ?>, and Privacy Policy</span>
                </div>

                <button class="button btn-primary auth-submit mb28" type="submit" name="register-account-submit" id="register-account-submit">Registration</button>

                <?php wp_nonce_field('exchange_register','exchange_register'); ?>

            </form>

            <div class="reg-end">
                <div class="welcome-text">
                    <h3>Registration completed successfully.</h3>
                    <p>To complete the registration, you must confirm your E-mail (Check your spam folder).</p>
                    <p>An email with instructions has been sent to the email address you provided during registration.</p>
                </div>
                <!-- <a href="/" class="home">Home</a> -->
            </div>
            <div class="notif-custom-reg"></div>

            <a href="/" class="home">Home</a>
        </div>

    </div>



</main><!-- #main -->

<?php
get_footer();
