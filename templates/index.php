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
            <div class="col">
                <p>Welcome To ChatApp where you\'ll meet cool people like you.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                Contacts
            </div>
            <div class="col-sm-9">
                <h3>Messages</h3>
                <form action="?" method="post" id="message_send">
                    <textarea name="message[body]" id="message_body" cols="50" rows="2"></textarea>
                    <button type="submit" class="btn btn-outline-success">send</button>
                </form>
            </div>
        </div>
    </div>
<?php