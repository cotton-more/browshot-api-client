<?php

namespace BrowshotAPI\Command;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Process\Process;

class ProtobufCompileCommand
{
    public function __invoke()
    {
        $srcDir = getenv('ROOT_DIR').'/messages';

        $compileCmd = 'protoc --proto_path=messages --php_out=generated {file}';

        $finder = (new Finder())
            ->name('*.proto')
        ;

        /** @var SplFileInfo $file */
        foreach ($finder->in($srcDir) as $file) {
            $cmd = $compileCmd;
            $cmd = str_replace('{file}', $file->getRelativePathname(), $cmd);

            var_dump($cmd);

            $process = new Process($cmd);
            $process->run();
        }
    }
}