<?php

/*
|--------------------------------------------------------------------------
| Dependency injection:
|--------------------------------------------------------------------------
|
| This will be included in the index.php file. Here you can
| bind dependencies manualy to the container.
|
 */
$this->bind('blade', function ($cachedPath, $path) {
    return new Xiaoler\Blade\Factory(
        new Xiaoler\Blade\Engines\CompilerEngine(
            new Xiaoler\Blade\Compilers\BladeCompiler($cachedPath)
        ), new Xiaoler\Blade\FileViewFinder([$path])
    );
});

$this->bind('paginateUsers', function () {
    $paginate = new Paginator('4', new User);
    return $paginate->setUlClass('pagination pagination-lg')->make();
});
