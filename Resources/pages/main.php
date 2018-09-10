<?php include  __DIR__.'/../app.php'; ?>
    <div class="container">
        <?php foreach($wtf as $params): ?>
        <div class="article1 jumbotron">
            <h2 class="header"><a href="/articles/<?=$params->getId()?>"><?=$params->getTitle()?></a></h2>
            <div class="body"> <p><?=$params->getBody()?></p>
        </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>