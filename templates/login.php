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
                <p>Welcome To ChatApp where you'll meet cool people like you.</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="text-center">Login</h3>
                <form action="?" name="user" method="post" id="user_login" class="mt-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <label for="user_pseudo">Pseudo:</label>
                            <input type="text" name="user[pseudo]" id="user_pseudo" value="<?=''.uniqid('user', false)?>" style="width: 77%; height: 40px">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-outline-success">login</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php