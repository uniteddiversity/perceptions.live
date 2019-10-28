<?php if($paginationData->lastPage() > 1) {
    echo '<div class="pagination" id="'.$id.'">';
    if($paginationData->currentPage() > 1){
        echo '<a href="#" data-page="'.($paginationData->currentPage() - 1).'">&laquo;</a>';
    }
    for ($i = 1; $i <= $paginationData->lastPage(); $i++){

        if( !(($paginationData->currentPage() < ($i+2)) && ($paginationData->currentPage() > ($i-2))) ){
            if($i == 1){
                echo '<a href="#" data-page="'.$i.'">'.$i.'</a>';
                echo '<a href="#">..</a>';
            }
        }

        if( ($paginationData->currentPage() < ($i+2)) && ($paginationData->currentPage() > ($i-2)) ){
            if($i == $paginationData->currentPage()){
                echo '<a class="current_page" href="#" data-page="'.$i.'">'.$i.'</a>';
            }else{
                echo '<a href="#" data-page="'.$i.'">'.$i.'</a>';
            }
        }else{
            if($paginationData->lastPage() == $i){
                echo '<a href="#">..</a>';
                echo '<a href="#" data-page="'.$i.'">'.$i.'</a>';
            }
        }

    }

    if($paginationData->currentPage() < $paginationData->lastPage()){
        echo '<a href="#" data-page="'.($paginationData->currentPage() + 1).'">&raquo;</a>';
    }

    echo '</div>';
} ?>
