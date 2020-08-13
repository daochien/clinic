<?php

namespace Frameworks\Cores\Interfaces;

interface CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository);
}
