<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site</title>
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/main.css">
    <script src="resources/js/script.js" defer></script>
</head>
<body class="font-sans h-full bg-gradient-to-tl bg-slate-800 text-slate-50 from-green-300/10 via-blue-500/80 to-purple-600/80">
<div class="flex flex-col min-h-full">
    <?php include 'resources/components/header.php'; ?>
    <main class="flex-auto border-b border-indigo-100/50 backdrop-opacity-50">
        <?php
            include 'includes/pages.php';
        ?>
    </main>
    <?php include 'resources/components/footer.php'; ?>
</div>
</body>
</html>