<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single clubs page
 */
$overview    = get_field( 'overview' );
$guestPhotos = get_field( 'guests_photos' );
$menu        = get_field( 'menu' );

get_template_part( 'gpw-templates/global/header' );

get_template_part( 'gpw-templates/clubs/single/header' );

get_template_part( 'gpw-templates/clubs/single/booking-form' );

get_template_part( 'gpw-templates/clubs/single/club-information' );

get_template_part( 'gpw-templates/clubs/single/image-carousel-section', null, [ 'title' => $overview['title'], 'image_ids' => $overview['images'] ] );

get_template_part( 'gpw-templates/clubs/single/image-carousel-section', null, [ 'title' => $guestPhotos['title'], 'image_ids' => $guestPhotos['images'] ] );

get_template_part( 'gpw-templates/clubs/single/booking-information' );

get_template_part( 'gpw-templates/clubs/single/image-carousel-section', null, [ 'title' => $menu['title'], 'image_ids' => $menu['images'], 'note' => $menu['note'] ] );

get_template_part( 'gpw-templates/clubs/single/other-information' );

get_template_part( 'gpw-templates/global/footer' );