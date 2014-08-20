<?php
/*****************************************************************************
 * Phloor Body Background                                                    *
 *                                                                           *
 * Copyright (C) 2011 Alois Leitner                                          *
 *                                                                           *
 * This program is free software: you can redistribute it and/or modify      *
 * it under the terms of the GNU General Public License as published by      *
 * the Free Software Foundation, either version 2 of the License, or         *
 * (at your option) any later version.                                       *
 *                                                                           *
 * This program is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 * GNU General Public License for more details.                              *
 *                                                                           *
 * You should have received a copy of the GNU General Public License         *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 *                                                                           *
 * "When code and comments disagree both are probably wrong." (Norm Schryer) *
 *****************************************************************************/
?>
<?php
$user = elgg_get_page_owner_entity();

$background_images = phloor_body_background_get_background_image_entities_by_container($user->guid);

$image = "none";
$color = "";

$background_string = "";
foreach ($background_images as $background_image) {
    // check if its a background entity instance
    if(phloor_body_background_instanceof($background_image)) {
        // take the first element that has a color defined
        if (empty($color) && !empty($background_image->color)) {
            $color = $background_image->color;
        }

        if($background_image->hasImage()) {
            $image_url = elgg_get_site_url() . "phloor-background/user/{$user->username}-body.jpg?guid={$background_image->guid}";
            //$image_url = $background_image->getImageURL();
            $image     = "url($image_url)";

            $repeat     = $background_image->repeat;
            $attachment = $background_image->attachment;
            $position   = $background_image->position;

            if (!empty($background_string)) {
                $background_string .= ", ";
            }

            $background_string .= "$image $position $repeat $attachment";
        }
    }

}

if (!empty($background_images)) {
?>
<style type="text/css">
body {
<?php if(!empty($background_string)): ?>
	background: <?php echo $background_string; ?>;
<?php endif; ?>
<?php if(!empty($color)): ?>
	background-color: <?php echo $color; ?>;
<?php endif; ?>
}

.elgg-page-header {
	background: transparent;
}

.elgg-page-body {
	background: transparent;
}
</style>
<?php
}



