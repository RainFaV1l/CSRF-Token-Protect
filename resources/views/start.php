<div class="max-w-7xl m-auto flex flex-col items-center gap-10 py-14">
    <div class="text-center flex flex-col gap-4">
        <h1 class="text-5xl">Create Post</h1>
        <p class="text-lg">Dear friend, please create an article!</p>
    </div>
    <form class="flex flex-wrap gap-7 items-start justify-center" action="app/actions/addPost.php" method="post">
        <input type="hidden" name="_token" value="<?php if(isset($_SESSION['_token'])) { echo $_SESSION['_token'];}?>">
        <div class="flex flex-col gap-3 w-96">
            <input class="input transition-base placeholder-transition"
                <?php
                    if(isset($_SESSION['data']['title']))  {?>
                        value="<?php echo $_SESSION['data']['title']; unset($_SESSION['data']['title']);?>"
                    <?php }
                ?>
           type="text" name="title" placeholder="Post title">
            <?php
                if(isset($_SESSION['errors']['title']) && !empty($_SESSION['errors']['title'])) {?>
                    <label>
                        <?php
                        foreach ($_SESSION['errors']['title'] as $error) {
                            echo $error . '<br>';
                        }
                        unset($_SESSION['errors']['title']);
                        ?>
                    </label>
                <?php }
            ?>
        </div>
        <div class="flex flex-col gap-3 w-96">
            <input class="input transition-base placeholder-transition"
                <?php
                if(isset($_SESSION['data']['description']))  {?>
                    value="<?php echo $_SESSION['data']['description']; unset($_SESSION['data']['description']);?>"
                <?php }
                ?>
           type="text" name="description" placeholder="Description">
            <?php
                if(isset($_SESSION['errors']['description']) && !empty($_SESSION['errors']['description'])) {?>
                    <label>
                        <?php
                        foreach ($_SESSION['errors']['description'] as $error) {
                            echo $error . '<br>';
                        }
                        unset($_SESSION['errors']['description']);
                        ?>
                    </label>
                <?php }
            ?>
        </div>
        <div class="flex flex-col gap-3 w-96">
            <select name="post_type_id" class="input transition-base placeholder-transition text-white/75 cursor-pointer appearance-none">
                <?php
                    $types = PostType::query()->get();
                    foreach ($types as $type) {?>
                        <option <?php if(isset($_SESSION['data']['post_type_id']) && $_SESSION['data']['post_type_id'] == $type['id']) { echo 'selected'; unset($_SESSION['data']['post_type_id']); } ?> class="bg-white text-slate-950" value="<?php echo $type['id']?>"><?php echo $type['name']?></option>
                    <?php }
                ?>
            </select>
            <?php
            if(isset($_SESSION['errors']['post_type_id']) && !empty($_SESSION['errors']['post_type_id'])) {?>
                <label>
                    <?php
                    foreach ($_SESSION['errors']['post_type_id'] as $error) {
                        echo $error . '<br>';
                    }
                    unset($_SESSION['errors']['post_type_id']);
                    ?>
                </label>
            <?php }
            ?>
        </div>
        <button class="button form-button button_hover-outline text-slate-800 items-start h-full" type="submit">Add post</button>
    </form>
    <div class="flex flex-wrap justify-start w-full">
        <div class="flex gap-4">
            <a class="button button_hover-fill transition-base rounded-full px-10" href="#">New</a>
            <a class="button button_hover-fill transition-base rounded-full px-10" href="#">Oldest</a>
            <a class="button button_hover-fill transition-base rounded-full px-10" href="#">Bests</a>
        </div>
    </div>
    <div class="flex flex-wrap justify-start w-full gap-5">
        <?php
            global $connection;

//            var_dump(Post::$table_name);

            $posts = Post::query()->get();

            foreach ($posts as $post)  {?>
                <?php
                    $type = PostType::query()->where('id', '=', $post['post_type_id'])->first();
                ?>
                <div class="post-el h-56">
                    <div class="flex justify-between items-center border-b border-indigo-100/50 backdrop-opacity-50">
                        <h2 class="p-4 font-medium"><?=htmlentities($post['title']), ENT_QUOTES, 'UTF-8'?></h2>
                        <a href="#" class="button button_hover-fill m-4"><?=htmlentities($type['name'])?></a>
<!--                        button_hover-outline text-slate-800-->
                    </div>
                    <div class="p-4 h-full overflow-auto">
                        <p><?=htmlentities($post['description'])?></p>
                    </div>
                </div>
            <?php }
        ?>
    </div>
</div>