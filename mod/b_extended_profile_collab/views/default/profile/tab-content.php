<?php
/*
    User Profile Tabs
*/
//generate content tabs
elgg_push_context('profile');
$fields = array('File', 'Blog', 'page_top', 'Bookmarks', 'Poll', 'Thewire', 'Album', 'task_top', 'question', 'etherpad');
$user_display_name = elgg_get_page_owner_entity()->name;
foreach($fields as $field){

    echo '<div role="tabpanel" tabindex="-1" class="tab-pane fade-in" id="' . strtolower($field) . '">';

    $options = array(
        'type' => 'object',
        'subtype' => strtolower($field),
        'container_guid' => elgg_get_page_owner_entity()->guid,
        'limit' => 5,
        'full_view' => false,
        'pagination' => false,
        'distinct' => false,
    );

    $content = elgg_list_entities($options);

        //fix field to allow proper URLs
        //pick appropriate messages
        switch($field){
            case 'File':
                $title = elgg_echo('file:user', array($user_display_name));
                $add = elgg_echo('file:add');
                $message = elgg_echo('file:none');
                break;
            case 'Blog':
                $title = elgg_echo('blog:title:user_blogs', array($user_display_name));
                $add = elgg_echo('blog:add');
                $message = elgg_echo('blog:noblogs');
                break;
            case 'Bookmarks':
                $title = elgg_echo('bookmarks:owner', array($user_display_name));
                $add = elgg_echo('bookmarks:add');
                $message = elgg_echo('bookmarks:none');
                break;
            case 'Thewire':
                $title = elgg_echo('thewire:user', array($user_display_name));
                $message = elgg_echo('thewire:noposts');
                break;
            case 'page_top':
                $title = elgg_echo('pages:owner', array($user_display_name));
                $add = elgg_echo('pages:add');
                $message = elgg_echo('pages:none');
                $field = "pages";
                break;
            case 'task_top':
                $title = elgg_echo('tasks:user', array($user_display_name));
                $add = elgg_echo('tasks:add');
                $message = elgg_echo('tasks:none');
                $field = "tasks";
                break;
            case 'Poll':
                $title = elgg_echo('polls:user', array($user_display_name));
                $add = elgg_echo('polls:add');
                $message = elgg_echo('polls:none');
                $field = "polls";
                break;
            case 'Album':
                $title = elgg_echo('album:user', array($user_display_name));
                $add = elgg_echo('photos:add');
                $message = elgg_echo('tidypics:widget:no_albums');
                $field = "photos";
                break;
            case 'question':
                $title = elgg_echo('questions:owner', array($user_display_name));
                $add = elgg_echo('questions:add');
                $message = elgg_echo('questions:none');
                $field = 'questions';
                break;
            case 'etherpad':
                $title = elgg_echo('etherpad:owner', array($user_display_name));
                $add = elgg_echo('etherpad:add');
                $message = elgg_echo('etherpad:none');
                $field = 'docs';
                break;
        }

        if(elgg_get_page_owner_entity()->canEdit()){

            echo '<h2 class="wb-invisible" tabindex="-1">'.$title.'</h2>';

            //dont display add button on The Wire panel
            if($field == 'Thewire'){
                //do nothing
            } else {

                //display add button
            echo '<div class="text-right">';
                $action = strtolower($field) . "/add/" . elgg_get_page_owner_entity()->guid;
               $addButton = elgg_view('output/url', array(
                    'href' => $action,
                    'text' => $add,
                    'is_trusted' => true,
                    'class' => 'btn btn-primary',
                ));

                //for files we want an additional add folder button
                if($field == 'File' && elgg_get_plugin_setting("user_folder_structure", "file_tools") == 'yes'){
                  //create new foldr button
                    $new_folder = elgg_view('output/url', array(
                      'name' => 'new_folder',
                      'text' => elgg_echo("file_tools:new:title"),
                      'href' => "#",
                      "id" => "file_tools_list_new_folder_toggle",
                      'class' => 'btn btn-default mrgn-rght-sm',
                    ));

                    //add new folder to add button
                    $addButton = $new_folder.$addButton;
                }

                echo $addButton;
            echo '</div>';

            }
        }

        if(!$content){
            echo '<div class="mrgn-lft-sm mrgn-bttm-md">' . $message . '</div>';
        } else {
            echo $content;
        }

        $url = strtolower($field) . "/owner/" . elgg_get_page_owner_entity()->username;
        $more_link = elgg_view('output/url', array(
            'href' => $url,
            'text' => elgg_echo('link:view:all'),
            'is_trusted' => true,
            'class' => 'text-center btn btn-default center-block',
        ));

        echo '<div class="panel-footer text-right">' . $more_link . '</div>';
    echo '</div>';
}

//event calendar tab
echo '<div role="tabpanel" tabindex="-1" class="tab-pane fade-in" id="events">';
    echo '<div class="clearfix">';
    echo '<h2 class="wb-invisible" tabindex="-1">'.elgg_echo('event_calendar:listing_title:mine', array($user_display_name)).'</h2>';
    if(elgg_is_active_plugin('event_calendar')){
        $events = event_calendar_get_personal_events_for_user(elgg_get_page_owner_guid(), 5);
    }

    if(!$events){
        echo '<div class="mrgn-lft-sm mrgn-bttm-md">' . elgg_echo('event_calendar:no_events_found') . '</div>';
    }

    foreach($events as $event) {
        echo elgg_view("object/event_calendar", array('entity' => $event));
    }

    $date = date('Y-m-d'/*, strtotime("-1 days")*/);
    $event_url = "event_calendar/owner/". elgg_get_page_owner_entity()->username;
    $viewall_link = elgg_view('output/url', array(
        'href' => $event_url,
        'text' => elgg_echo('link:view:all'),
        'is_trusted' => true,
        'class' => 'text-center btn btn-default center-block',
    ));
    echo '</div>';
    echo "<div class=\"elgg-widget-more  panel-footer text-right\">$viewall_link</div>";
echo '</div>';
elgg_pop_context();
?>