<?php $display = 0;
if ( is_user_logged_in() && press_net_current_user_type('journalist') ) { ?>
    <div class="archive-buttons-header mt12">
        <div class="archive-buttons-header__item">
            <button type="button" name="button" class="button btn-primary-smail js-open-modal" data-modal="add-request-form" data-overlay="all">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>
                <span>Add request</span>
            </button>
        </div>
        <div class="archive-buttons-header__item">
            <button type="button" name="button" class="archive-title active">
                <span>All requests <sup><?php echo wp_count_posts('requests')->publish;?></sup></span>
            </button>
        </div>
        <div class="archive-buttons-header__item">
            <button type="button" name="button" class="archive-title">My requests</button>
        </div>
        <div class="archive-buttons-header__item">
            <button type="button" name="button" class="archive-title">My answers</button>
        </div>
    </div>
<?php } ?>

<div class="archive-search-header input-search-group mt12">
    <input type="text" name="" value="" class="input" placeholder="Search across all queries">
    <svg class="input-clear-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 5L19 19M5 19L19 5" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round"></path>
    </svg>
    <svg class="input-search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.1648 12.9884L10.9402 10.78C11.8037 9.70246 12.2219 8.33477 12.1088 6.95814C11.9956 5.58151 11.3597 4.30059 10.3318 3.37875C9.30397 2.45692 7.96223 1.96424 6.58252 2.00202C5.20281 2.03981 3.89 2.60518 2.91403 3.58189C1.93806 4.5586 1.37312 5.8724 1.33536 7.25316C1.29761 8.63392 1.78992 9.97668 2.71105 11.0053C3.63219 12.034 4.91214 12.6704 6.28772 12.7836C7.6633 12.8968 9.02995 12.4783 10.1067 11.6141L12.3134 13.8225C12.3691 13.8787 12.4354 13.9234 12.5085 13.9538C12.5816 13.9843 12.6599 14 12.7391 14C12.8183 14 12.8966 13.9843 12.9697 13.9538C13.0428 13.9234 13.1091 13.8787 13.1648 13.8225C13.2729 13.7106 13.3333 13.5611 13.3333 13.4054C13.3333 13.2498 13.2729 13.1003 13.1648 12.9884V12.9884ZM6.74267 11.6141C5.91248 11.6141 5.10094 11.3678 4.41066 10.9062C3.72038 10.4446 3.18238 9.78855 2.86468 9.02097C2.54698 8.25339 2.46386 7.40877 2.62582 6.59392C2.78778 5.77906 3.18755 5.03057 3.77458 4.4431C4.36162 3.85562 5.10954 3.45554 5.92378 3.29346C6.73801 3.13137 7.58199 3.21456 8.34898 3.5325C9.11598 3.85044 9.77154 4.38885 10.2328 5.07965C10.694 5.77045 10.9402 6.58262 10.9402 7.41343C10.9402 8.52753 10.4979 9.59599 9.71075 10.3838C8.92357 11.1716 7.85592 11.6141 6.74267 11.6141V11.6141Z" fill="#8C8C8C"></path>
    </svg>
</div>

<div class="archive-filter mt12">
    <?php if ( $display == 1 ) { ?>
    <div class="archive-filter__item">
        <button type="button" name="button" class="button">
            <span>My Subscriptions</span>
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.99451 7.99865C5.87789 7.99891 5.76487 7.95243 5.67507 7.86729L2.68031 5.01162C2.57838 4.91468 2.51428 4.77537 2.50211 4.62435C2.48994 4.47333 2.5307 4.32296 2.61542 4.20632C2.70015 4.08969 2.82189 4.01634 2.95387 4.00242C3.08585 3.98849 3.21726 4.03513 3.31919 4.13208L5.99451 6.69075L8.66983 4.22346C8.72088 4.17602 8.77963 4.14059 8.84269 4.11921C8.90575 4.09783 8.97188 4.09092 9.03728 4.09888C9.10268 4.10685 9.16606 4.12952 9.22377 4.1656C9.28149 4.20168 9.33241 4.25046 9.3736 4.30913C9.41931 4.36785 9.45393 4.43675 9.47528 4.51149C9.49664 4.58624 9.50428 4.66523 9.49772 4.74351C9.49116 4.82179 9.47054 4.89768 9.43716 4.96642C9.40378 5.03516 9.35835 5.09527 9.30372 5.14298L6.30896 7.90156C6.21658 7.97324 6.10587 8.00743 5.99451 7.99865Z" fill="#595959"></path>
            </svg>
        </button>
    </div>
    <?php } ?>
    <div class="archive-filter__item">
        <button id="categories" type="button" name="button">Categories</button>
        <div class="filtr-options categories">
            <div class="filtr-options__wrap">
                <?php press_net_request_cat_list('', '', false);?>
            </div>
            <div class="filtr-options__wrap">
                <?php press_net_request_cat_list(10, 10, false);?>
            </div>
            <div class="filtr-options__wrap">
                <?php press_net_request_cat_list(10, 20, false);?>
            </div>
        </div>
    </div>
    <div class="archive-filter__item with-options">
        <button id="type" type="button" name="button">Request type</button>
        <div class="filtr-options type">
            <div class="type__item">
                <input id="Texture" type="checkbox" name="Texture" value="Texture" />
                <label for="Texture">Texture<span class="filtr-options__count">(<?php echo press_net_request_type('Texture');?>)</span></label>
            </div>
            <div class="type__item">
                <input id="Barter" type="checkbox" name="Barter" value="Barter" />
                <label for="Barter">Barter<span class="filtr-options__count">(<?php echo press_net_request_type('Barter');?>)</span></label>
            </div>
            <div class="type__item">
                <input id="Texts" type="checkbox" name="Texts" value="Texts" />
                <label for="Texts">Texts<span class="filtr-options__count">(<?php echo press_net_request_type('Texts');?>)</span></label>
            </div>
        </div>
    </div>
    <div class="archive-filter__item">
        <button id="featured" type="button" name="button">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="7" cy="7.00003" r="5.5" stroke="#8C8C8C"></circle>
                <path d="M8.72231 9.91558C8.67205 9.91558 8.62255 9.90274 8.57808 9.87817L6.99996 9.00817L5.42184 9.87817C5.37071 9.90638 5.31308 9.91903 5.25545 9.91468C5.19782 9.91034 5.14251 9.88917 5.09576 9.85357C5.049 9.81798 5.01268 9.76938 4.9909 9.71327C4.96912 9.65716 4.96275 9.59578 4.97251 9.53607L5.27398 7.69334L3.99704 6.38834C3.95568 6.34605 3.92643 6.29247 3.9126 6.23366C3.89877 6.17485 3.90091 6.11316 3.91878 6.05556C3.93665 5.99796 3.96954 5.94675 4.01372 5.90773C4.0579 5.86871 4.11162 5.84343 4.16879 5.83476L5.93317 5.5659L6.72239 3.88931C6.75083 3.83862 6.7914 3.79659 6.84008 3.7674C6.88877 3.7382 6.94389 3.72284 6.99998 3.72284C7.05606 3.72284 7.11118 3.7382 7.15987 3.7674C7.20855 3.79659 7.24913 3.83862 7.27757 3.88931L8.06678 5.5659L9.83116 5.83476C9.88833 5.84343 9.94205 5.86871 9.98623 5.90773C10.0304 5.94675 10.0633 5.99796 10.0812 6.05556C10.099 6.11316 10.1012 6.17485 10.0874 6.23366C10.0735 6.29247 10.0443 6.34605 10.0029 6.38834L8.72597 7.69334L9.02744 9.53607C9.03505 9.58266 9.03286 9.63043 9.02104 9.67604C9.00921 9.72165 8.98803 9.76401 8.95898 9.80015C8.92993 9.83629 8.8937 9.86535 8.85282 9.88529C8.81195 9.90523 8.76742 9.91557 8.72234 9.9156L8.72231 9.91558Z" fill="#8C8C8C"></path>
            </svg>
            <span>Featured</span>
        </button>
    </div>

    <div class="archive-filter__item mla">
        <button id="favorites" type="button" name="button">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 13.5V5.25H11.25V13.5L8.625 11.2083L6 13.5Z" stroke="#8C8C8C" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>Favorites</span>
        </button>

        <button type="button" name="button" class="sorting-requests no-border" title="Sorting Requests">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h11M4 18h6"></path>
            </svg>
            <div class="sorting-requests__options" title="">
                <span class="sorting-requests__options__title">Sorting Requests</span>

                <input id="date" type="radio" name="sort" value="date" checked />
                <label for="date" class="sorting-requests__options__item">By posting date</label>

                <input id="deadline" type="radio" name="sort" value="deadline" />
                <label for="deadline" class="sorting-requests__options__item">By deadline</label>

                <input id="taken-work" type="radio" name="sort" value="taken-work" />
                <label for="taken-work" class="sorting-requests__options__item">Taken to work</label>
            </div>
        </button>

        <button type="button" name="button" class="mark-all-read no-border" title="Mark all as read">
            <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m7 12 5 5L22 7M12 12l5-5M2 12l5 5-5-5Z"></path>
            </svg>
        </button>
    </div>
</div>

<?php if ( have_posts() ) : ?>
<div class="archive-posts mt12 mb48">
    <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'press-inc/template-parts/archive-template/post-type/content', get_post_type() );
        endwhile;
    ?>
</div>

<?php //the_posts_navigation(); ?>

<?php
else :
    get_template_part( 'press-inc/template-parts/archive-template/post-type/content', 'none' );
endif;
?>

<form id="author_nonce">
    <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo $user_ID; ?>" />
    <?php wp_nonce_field( 'press_net_add_post', 'press_net_add_post' ); ?>
</form>
