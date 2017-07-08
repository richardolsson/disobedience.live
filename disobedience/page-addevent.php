<?php
/*
 * Template Name: Add event page
 * Template Post Type: page
*/

acf_form_head();
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
        <form>
            <ul>
                <li class="text-item event-form-title">
                    <label for="event-form-title">Event Title</label>
                    <input id="event-form-title" type="text" name="title">
                </li>
                <li class="text-item event-form-date">
                    <label for="event-form-date">Date</label>
                    <input id="event-form-date" type="date" name="date">
                </li>
                <li class="text-item event-form-start">
                    <label for="event-form-start">Starts</label>
                    <input id="event-form-start" type="time" name="start">
                </li>
                <li class="text-item event-form-end">
                    <label for="event-form-end">Ends</label>
                    <input id="event-form-end" type="time" name="end">
                </li>
                <li class="text-item event-form-city">
                    <label for="event-form-city">City</label>
                    <input id="event-form-city" type="text" name="city">
                </li>
                <li class="text-item event-form-country">
                    <label for="event-form-country">Country</label>
                    <input id="event-form-country" type="text" name="country">
                </li>
                <li class="textarea-item event-form-info">
                    <label for="event-form-info">Event information</label>
                    <textarea id="event-form-info" name="title"></textarea>
                </li>
                <li class="text-item event-form-contact">
                    <label for="event-form-contact">Name of contact person</label>
                    <input id="event-form-contact" type="text" name="contact">
                </li>
                <li class="text-item event-form-email">
                    <label for="event-form-email">Contact email</label>
                    <input id="event-form-email" type="email" name="email">
                </li>
                <li class="text-item event-form-phone">
                    <label for="event-form-phone">Contact phone</label>
                    <input id="event-form-phone" type="text" name="phone">
                </li>
                <li class="text-item event-form-link">
                    <label for="event-form-link">Link (e.g. Facebook event)</label>
                    <input id="event-form-link" type="url" name="link">
                </li>
                <li class="file-item event-form-image">
                    <input id="event-form-image" type="file" name="image">
                </li>
                <li class="event-form-open">
                    <input id="event-form-open" type="checkbox" name="open">
                    <label for="event-form-open">Event is open (anyone may attend)</label>
                </li>
            </ul>
        </form>
    </div>
</div>
<?php get_footer();?>
