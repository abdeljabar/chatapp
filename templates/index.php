<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 3:16 PM
 */
?>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p>Welcome To ChatApp where you\'ll meet cool people like you.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <h3>Contacts</h3>
                <div id="contact_list" data-prototype="<?php ob_start(); include '_partials/contact_item.php'; echo htmlentities(ob_get_clean()); ?>"></div>
            </div>
            <div class="col-sm-9">
                <h3>Messages</h3>
                <div id="message_list" data-prototype="<?php ob_start(); include '_partials/message_item.php'; echo htmlentities(ob_get_clean()); ?>"></div>
                <form action="?" method="post" id="message_send" class="mt-3">
                    <div class="row">
                        <div class="col-10">
                            <textarea name="message[body]" id="message_body" rows="2" style="width: 100%"></textarea>
                        </div>
                        <div class="col-2 mt-2">
                            <button type="submit" class="btn btn-outline-success">send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php