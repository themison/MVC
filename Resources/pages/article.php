<?php include  __DIR__.'/../app.php'; ?>
<div class="container">
<div class="article1 jumbotron">
            <h2 class="header"><?=$article->getTitle()?></h2>
            <div class="body"> <p><?=$article->getBody()?></p>
            </div>
            <hr>
            <p>Author: <?=$article->getUser()->getName()?></p>
        </div>
        </div>
</body>
</html>