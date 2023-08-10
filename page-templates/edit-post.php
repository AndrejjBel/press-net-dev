<?php
/**
 * Template Name: Edit post
 * Template Post Type: post, page, product
 */

get_header();
$post_obj = press_net_edit_post_obj($_GET['post']);
$terms = press_net_terms_post($_GET['post'], REQUESTS_CAT, 0);
?>

<main id="primary" class="site-main edit-post container  mb40">
    <header class="page-header">
        <h1 class="archive-title">Edit - <span><?php echo $post_obj->post_title;?></span></h1>
    </header><!-- .page-header -->

    <form id="form-edit-request">
        <div class="field-group mb14">
            <div class="field-group__title">
                <span>Request title</span>
                <span class="field-group__title__required">*</span>
            </div>
            <div class="input-group">
                <input type="text" class="input" name="post_title" id="post_title" placeholder="Request title" required value="<?php echo $post_obj->post_title;?>" />
            </div>
            <span class="field-group__warning-input">Field is required</span>
        </div>
        <div class="field-group mb14">
            <div class="field-group__title">
                <span>Request description</span>
                <span class="field-group__title__required">*</span>
            </div>
            <div class="input-group user-description">
                <textarea type="textarea" rows="4" class="textarea"
                name="description" id="description"
                placeholder="Request description" required><?php echo $post_obj->post_content;?></textarea>
            </div>
            <span class="field-group__warning-input">Field is required</span>
        </div>
        <div class="field-group-two mb14">
            <div class="field-group">
                <div class="field-group__title">
                    <span>Request rubric</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group field-select">
                    <input type="text" class="input" name="rubric_text"
                    id="rubric_text" placeholder="Request rubric" required
                    value="<?php echo $terms['term_name']; ?>" readonly />
                    <div class="field-select__options">
                        <?php press_net_request_list(REQUESTS_CAT, $order = 'name', $orderby = 'ASC', $hide_empty = false); ?>
                    </div>
                </div>
                <span class="field-group__warning-input">Field is required</span>
                <span class="field-group__warning-input">Must be selected from the list</span>
                <input type="hidden" class="input" name="rubric" id="rubric" value="<?php echo $terms['terms_id']; ?>" />
            </div>
            <div class="field-group">
                <div class="field-group__title">
                    <span>Request type</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group field-select">
                    <input type="text" class="input" name="request_type" id="request_type" placeholder="Request type" required value="<?php echo $post_obj->request_type;?>" readonly />
                    <div class="field-select__options">
                        <span>Texture</span>
                        <span>Barter</span>
                        <span>Texts</span>
                    </div>
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
        </div>

        <div class="field-group-two mb14">
            <div class="field-group">
                <div class="field-group__title">
                    <span>Mass media</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group field-select">
                    <input type="text" class="input" name="mass_media_parent"
                    id="mass_media_parent" placeholder="Mass media" required
                    value="<?php echo get_post( $post_obj->mass_media_parent_id )->post_title;?>" readonly />
                    <div class="field-select__options">
                        <?php press_net_user_media_parent_list(); ?>
                    </div>
                </div>
                <span class="field-group__warning-input">Field is required</span>
                <span class="field-group__warning-input">Must be selected from the list</span>
                <input type="hidden" class="input" name="mass_media_parent_id" id="mass_media_parent_id"
                value="<?php echo $post_obj->mass_media_parent_id;?>" />
            </div>
            <div class="field-group">
                <div class="field-group__title">
                    <span>Deadline</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group">
                    <input type="datetime-local" class="input" name="deadline" id="deadline" min="" required value="<?php echo wp_date( 'Y-m-d H:i', $post_obj->deadline );?>" />
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
        </div>

        <div class="field-group-two">
            <div class="field-group">
                <div class="field-group__title">
                    <span>Number of letters from</span>
                    <!-- <span class="field-group__title__required">*</span> -->
                </div>
                <div class="input-group">
                    <input type="number" class="input" name="signs_number_from"
                    id="signs_number_from" placeholder="Number of letters from"
                    value="<?php echo $post_obj->signs_number_from;?>" />
                </div>
                <!-- <span class="field-group__warning-input">Field is required</span> -->
            </div>
            <div class="field-group">
                <div class="field-group__title">
                    <span>Number of letters up to</span>
                    <!-- <span class="field-group__title__required">*</span> -->
                </div>
                <div class="input-group">
                    <input type="number" class="input" name="signs_number_upto"
                    id="signs_number_upto" placeholder="Number of letters up to"
                    value="<?php echo $post_obj->signs_number_upto;?>" />
                </div>
                <!-- <span class="field-group__warning-input">Field is required</span> -->
            </div>
        </div>

        <div class="buttons-group-post add-post mt28">
            <a href="<?php echo get_permalink($_GET['post']);?>" class="btn-primary-smail">Back</a>
            <!-- <button type="button" name="btn-cancel-post-form-request" id="btn-cancel-post-form-request" class="button cancel-post-form js-modal-close" data-title="New company">Cancel</button> -->
            <button type="button" name="btn-save-post-form" id="btn-edit-post-form" class="button save-post-form width-100-499">Save</button>
        </div>

        <input type="hidden" name="post_id" id="post_id" value="<?php echo $_GET['post'];?>" />
        <input type="hidden" name="post_author" id="post_author" value="<?php echo $post_obj->post_author;?>" />

    </form>

</main><!-- #main -->

<?php
get_footer();
