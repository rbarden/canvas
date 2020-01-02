<?php

namespace Laravie\Canvas\Database;

use InvalidArgumentException;
use Laravie\Canvas\Presets\Preset;

class MigrationCreator extends \Illuminate\Database\Migrations\MigrationCreator
{
    /**
     * Canvas preset.
     *
     * @var \Laravie\Canvas\Presets\Preset
     */
    protected $preset;

    /**
     * Create a new migration creator instance.
     */
    public function __construct(Preset $preset)
    {
        $this->files = $preset->getFilesystem();
        $this->preset = $preset;
    }

    /**
     * Create a new migration at the given path.
     *
     * @param  string  $name
     * @param  string  $path
     * @param  string|null  $table
     * @param  bool  $create
     *
     * @throws \Exception
     *
     * @return string
     */
    public function create($name, $path, $table = null, $create = false)
    {
        if (! $this->files->isDirectory($path)) {
            throw new InvalidArgumentException("Path {$path} doesn't exists.");
        }

        return parent::create($name, $path, $table, $create);
    }

    /**
     * Get the path to the stubs.
     *
     * @return string
     */
    public function stubPath()
    {
        return __DIR__.'/../../storage/database/migrations';
    }
}
