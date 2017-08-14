<?php
/*
 * Template Name: Add event page
 * Template Post Type: page
*/

if (isset($_POST)) {
    if (!function_exists('wp_handle_upload')) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    if (isset($_POST['addevent_nonce']) && wp_verify_nonce($_POST['addevent_nonce'], 'addevent')) {
        $event_id = wp_insert_post(array(
            'post_type' => 'event',
            'post_title' => sanitize_title($_POST['title']),
            'post_content' => sanitize_text_field($_POST['info']),
        ));

        $file = wp_handle_upload($_FILES['image'], array('action' => 'addevent'));
        if (isset($file) && !isset($file['error'])) {
            $att_data = array(
                'post_title' => basename($file['file']),
                'post_content' => '',
                'post_status' => 'draft',
                'post_mime_type' => $file['type'],
            );

            $att_id = wp_insert_attachment($att_data, $file['file'], $event_id);
            $meta_id = set_post_thumbnail($event_id, $att_id);
        }

        update_field('organizer', sanitize_text_field($_POST['organizer']), $event_id);
        update_field('start_date', sanitize_text_field($_POST['start_date']), $event_id);
        update_field('start_time', sanitize_text_field($_POST['start_time']), $event_id);
        update_field('end_date', sanitize_text_field($_POST['end_date']), $event_id);
        update_field('end_time', sanitize_text_field($_POST['end_time']), $event_id);
        update_field('city', sanitize_text_field($_POST['city']), $event_id);
        update_field('country', sanitize_text_field($_POST['country']), $event_id);
        update_field('contact_name', sanitize_text_field($_POST['contact']), $event_id);
        update_field('contact_email', sanitize_text_field($_POST['email']), $event_id);
        update_field('contact_phone', sanitize_text_field($_POST['phone']), $event_id);
        update_field('link', sanitize_text_field($_POST['link']), $event_id);
        update_field('open', $_POST['open'] == 'yes', $event_id);

        $done_page = get_field('event_submitted_page', 'option');
        $done_page_url = get_permalink($done_page->ID);
        header('Location: '.$done_page_url);
    }
    else {
        $error = 'Form must be re-submitted.';
    }

    $terms_page = get_field('event_terms_page', 'option');
    $terms_page_url = get_permalink($terms_page->ID);
}

the_post();
get_header();
?>
<div class="content post page">
    <div class="post-image page-image">
        <?php the_post_thumbnail();?>
    </div>
    <h1><?php the_title();?></h1>
    <div class="post-content page-content">
        <?php the_content(); ?>
    </div>
    <div class="event-form">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="addevent">
            <?php wp_nonce_field('addevent', 'addevent_nonce'); ?>

            <ul class="form-items">
                <li class="text-item event-form-title">
                    <label for="event-form-title"><?php disobedience_pstr('events_form_title');?></label>
                    <input id="event-form-title" type="text" name="title">
                </li>
                <li class="text-item event-form-organizer">
                    <label for="event-form-organizer"><?php disobedience_pstr('events_form_organizer');?></label>
                    <input id="event-form-organizer" type="text" name="organizer">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-start-date"><?php disobedience_pstr('events_form_startdate');?></label>
                    <input id="event-form-start-date" type="date" name="start_date">
                </li>
                <li class="text-item event-form-time">
                    <label for="event-form-start-time"><?php disobedience_pstr('events_form_starttime');?></label>
                    <input id="event-form-start-time" type="time" name="start_time">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-end-date"><?php disobedience_pstr('events_form_enddate');?></label>
                    <input id="event-form-end-date" type="date" name="end_date">
                </li>
                <li class="text-item event-form-time">
                    <label for="event-form-end-time"><?php disobedience_pstr('events_form_endtime');?></label>
                    <input id="event-form-end-time" type="time" name="end_time">
                </li>
                <li class="text-item event-form-city">
                    <label for="event-form-city"><?php disobedience_pstr('events_form_city');?></label>
                    <input id="event-form-city" type="text" name="city">
                </li>
                <li class="text-item event-form-country">
                    <label for="event-form-country"><?php disobedience_pstr('events_form_country');?></label>
                    <input id="event-form-country" type="text" name="country">
                </li>
                <li class="textarea-item event-form-info">
                    <label for="event-form-info"><?php disobedience_pstr('events_form_info');?></label>
                    <textarea id="event-form-info" name="info"></textarea>
                </li>
                <li class="text-item event-form-contact">
                    <label for="event-form-contact"><?php disobedience_pstr('events_form_contact');?></label>
                    <input id="event-form-contact" type="text" name="contact">
                </li>
                <li class="text-item event-form-email">
                    <label for="event-form-email"><?php disobedience_pstr('events_form_email');?></label>
                    <input id="event-form-email" type="email" name="email">
                </li>
                <li class="text-item event-form-phone">
                    <label for="event-form-phone"><?php disobedience_pstr('events_form_phone');?></label>
                    <input id="event-form-phone" type="text" name="phone">
                </li>
                <li class="text-item event-form-link">
                    <label for="event-form-link"><?php disobedience_pstr('events_form_link');?></label>
                    <input id="event-form-link" type="text" name="link">
                </li>
                <li class="file-item event-form-image">
                    <span><?php disobedience_pstr('events_form_image');?></span>
                    <div class="upload-warning">
                        <?php disobedience_pstr('events_form_image_caption');?>
                    </div>
                    <input id="event-form-image" type="file" name="image">
                </li>
                <li class="event-form-open">
                    <?php disobedience_pstr('events_form_open');?>
                    <ul class="radio-options">
                        <li class="radio-option">
                            <input id="event-form-open-yes" type="radio" name="open" value="yes" checked="checked">
                            <label for="event-form-open-yes"><?php disobedience_pstr('events_form_open_yes');?></label>
                        </li>
                        <li class="radio-option">
                            <input id="event-form-open-no" type="radio" name="open" value="no">
                            <label for="event-form-open-no"><?php disobedience_pstr('events_form_open_no');?></label>
                            <p class="small-print">
                                <?php disobedience_pstr('events_form_closed');?>
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>
            <p>
                <?php disobedience_pstr('events_form_terms');?>
                <?php if ($terms_page): ?>
                <a href="<?php echo $terms_page_url;?>"><?php disobedience_pstr('events_form_terms_link');?></a>
                <?php endif; ?>
            </p>
            <input class="submit-button" type="submit" value="<?php disobedience_pstr('events_form_submit');?>">
        </form>
    </div>
</div>
<?php get_footer();?>
