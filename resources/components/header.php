<header class="text-xl py-5 border-b border-indigo-100/50 backdrop-opacity-50 font-medium">
    <div class="flex flex-wrap justify-between items-center max-w-7xl m-auto">
        <a href="index.php" class="text-2xl">CSRF</a>
        <nav>
            <ul class="flex items-center text-base gap-9">
                <li><a class="header__link transition-base" href="#">Home</a></li>
                <li><a class="header__link transition-base" href="#">About us</a></li>
                <li><a class="header__link transition-base" href="#">Blog</a></li>
                <li><a class="header__link transition-base" href="#">Contact</a></li>
                <li><a class="header__link transition-base" href="#">Map</a></li>
            </ul>
        </nav>
        <div class="text-base flex align-middle gap-4">
            <?php
                if(isset($_SESSION['user'])) {?>
                    <form action="app/actions/logout.php" method="post">
                    <input type="hidden" name="_token" value="<?php if(isset($_SESSION['_token'])) { echo $_SESSION['_token'];} ?>">
                        <button class="button button_hover-outline transition-base text-slate-800" type="submit">Logout</button>
                    </form>
                <?php } else {?>
                    <a class="button button_hover-fill transition-base" href="?p=login">Sign in</a>
                    <a class="button button_hover-outline transition-base text-slate-800" href="?p=register">Create account</a>
                <?php }
            ?>

        </div>
    </div>
</header>