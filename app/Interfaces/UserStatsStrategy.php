<?php

namespace App\Interfaces;

interface UserStatsStrategy {
    public function getStats(): array;
}
