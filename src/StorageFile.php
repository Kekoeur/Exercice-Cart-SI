<?php

namespace Cart;

class StorageFile implements Storable
{
    private string $path;
    public function __construct(string $p)
    {
        $this->path = $p;
        if (file_exists($p)) {
            unlink($p);
        }
    }
    public function setValue(string $name, float $total):void
    {
        $file = fopen($this->path, 'a');
        fputcsv($file, [$name, $total]);
        fclose($file);
    }

    public function total():float
    {
        $file = fopen($this->path, "r");

        $t = 0;

        while ($ligne = fgetcsv($file)) {
            $t += $ligne[1];
        }

        fclose($file);

        return round($t, $_ENV['PRECISION']) ;;
    }
}
