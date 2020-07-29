<?php

namespace JeroenNoten\LaravelAdminLte\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\ActiveChecker;
use JeroenNoten\LaravelAdminLte\Menu\Builder;

class ActiveFilter implements FilterInterface
{
    private $activeChecker;

    public function __construct(ActiveChecker $activeChecker)
    {
        $this->activeChecker = $activeChecker;
    }

    public function transform($item, Builder $builder)
    {
        if (! isset($item['header'])) {
            $item['active'] = $this->activeChecker->isActive($item);
        }

        return $item;
    }
}
