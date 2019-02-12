<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Course Manager</title>
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
</head>

<!-- the body section -->
<body>
    <header><h1>Course Manager</h1></header>

    <main>
        <h2 class="top">Error</h2>
        <p><?php echo $error; ?></p>
    </main>
    <a href = "javascript:history.back()">Back to previous page</a>
    <footer>
        <p class='copyright'>&copy; <?php echo date("Y"); ?> Vladimir Heredia</p>
    </footer>
</body>
</html>