<div class="max-w-7xl m-auto flex-x-center py-52 gap-10">
    <div class="text-center flex flex-col gap-4">
        <h2 class="text-5xl">Sign-in</h2>
        <p class="text-lg">Login and Share Your Thoughts with the World!</p>
        <?php
        if(!empty($_SESSION['errors']['attempt']) && !empty($_SESSION['errors']['email']) && !empty($_SESSION['errors']['password'])) {?>
            <p class="text-lg">
                <?php
                foreach ($_SESSION['errors']['attempt'] as $error) {
                    echo $error . '<br>';
                }
                unset($_SESSION['errors']['attempt']);
                ?>
            </p>
        <?php }
        ?>
    </div>
    <form class="flex flex-col items-center gap-7" action="app/actions/login.php" method="post">
        <input type="hidden" name="_token" value="<?php if(isset($_SESSION['_token'])) { echo $_SESSION['_token'];} ?>">
        <div class="flex flex-col gap-3 w-96">
            <input class="input transition-base placeholder-transition" type="text" name="email"
                   <?php
                        if(isset($_SESSION['data']['email']))  {?>
                           value="<?php echo $_SESSION['data']['email']; unset($_SESSION['data']['email']);?>"
                        <?php }
                   ?>
                    placeholder="Email">
            <?php
                if(isset($_SESSION['errors']['email']) && !empty($_SESSION['errors']['email'])) {?>
                    <label>
                        <?php
                            foreach ($_SESSION['errors']['email'] as $error) {
                                echo $error . '<br>';
                            }
                            unset($_SESSION['errors']['email']);
                        ?>
                    </label>
                <?php }
            ?>
        </div>
        <div class="flex flex-col gap-3 w-96">
            <input class="input transition-base placeholder-transition" type="password" name="password" placeholder="Password">
            <?php
                if(isset($_SESSION['errors']['password']) && !empty($_SESSION['errors']['password'])) {?>
                    <label>
                        <?php
                        foreach ($_SESSION['errors']['password'] as $error) {
                            echo $error . '<br>';
                        }
                        unset($_SESSION['errors']['password']);
                        ?>
                    </label>
                <?php }
            ?>
        </div>
        <button type="submit" class="button form-button button_hover-outline text-slate-800 px-12">Login</button>
    </form>
</div>