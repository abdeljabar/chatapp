<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 4:09 PM
 */
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <h4>Messages Archivées</h4>
            <ul>
                <?php foreach ($messages as $k=>$message): ?>
                    <li><?=$message['body']?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php