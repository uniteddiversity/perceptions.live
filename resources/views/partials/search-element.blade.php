<?php
switch($type){
    case 'category':
        echo '<div class="search-form-element">';
        echo '<select class="form-control multi-select2-max3" id="categories">';
        echo '<option value="">All Categories</option>';
        foreach($categories as $m){
            echo '<option value="'.$m['id'].'" >'.$m['name'].'</option>';
        }
        echo '</select></div>';
        break;
    case 'gci_tags':
        echo '<div class="search-form-element">';
        echo '<select class="form-control multi-select2-max3" id="gci">';
        echo '<option value="">All Great Community Intentions</option>';
        foreach($gci_tags as $m){
            echo '<option value="'.$m['id'].'" >'.$m['tag'].'</option>';
        }
        echo '</select></div>';
        break;
    case 'primary_sub_tag':
        echo '<div class="search-form-element">';
        echo '<select class="form-control select2-ajax-primary_sub_tag" id="primary_sub_tag">';
        echo '<option value="">All Primary Subjects</option>';
        echo '</select></div>';
        break;
    case 'users':
        echo '<div class="search-form-element">';
        echo '<select class="form-control select2-ajax-users" id="associated_users">';
        echo '<option value="">All Associated Users</option>';
        echo '</select></div>';
        break;
    case 's_o_p':
        echo '<div class="search-form-element">';
        echo '<select class="form-control multi-select2-max3" id="s_o_p">';
        echo '<option value="">All</option>';
        foreach($s_o_p as $m){
            echo '<option value="'.$m['id'].'" >'.$m['tag'].'</option>';
        }
        echo '</select></div>';
        break;
    case 'search_buttons':
//        echo '<button class="btn btn-primary" onclick="shareSearchVideo()">Search</button>';
        echo '<div class="search-form-element-buttons">
                <button class="btn btn-primary" onclick="shareResetSearch()">Reset</button>
            </div>';
        break;
}