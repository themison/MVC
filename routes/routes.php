<?php   
    return [
        '#^$#' => [Controllers\MainController::class,'index'],
        '#^articles/(\d+)$#' => [Controllers\ArticlesController::class,'article'],
        '#^articles/(\d+)/edit$#' => [Controllers\ArticlesController::class, 'edit'],
        '#^articles/add$#' => [Controllers\ArticlesController::class, 'add'],
        '#^articles/(\d+)/delete$#' => [Controllers\ArticlesController::class, 'delete'],

        
    ];