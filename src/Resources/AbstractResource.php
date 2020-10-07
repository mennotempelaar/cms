<?php

declare(strict_types = 1);

namespace DigitalCreative\Dashboard\Resources;

use DigitalCreative\Dashboard\Concerns\WithEvents;
use DigitalCreative\Dashboard\Http\Requests\BaseRequest;
use DigitalCreative\Dashboard\Repository\Repository;
use DigitalCreative\Dashboard\Repository\RepositoryInterface;
use DigitalCreative\Dashboard\Traits\MakeableTrait;
use DigitalCreative\Dashboard\Traits\ResolveFieldsTrait;
use DigitalCreative\Dashboard\Traits\ResolveFiltersTrait;
use DigitalCreative\Dashboard\Traits\ResolveUriKey;
use DigitalCreative\Dashboard\Traits\EventsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class AbstractResource implements WithEvents
{

    use ResolveFieldsTrait;
    use ResolveFiltersTrait;
    use ResolveUriKey;
    use MakeableTrait;
    use EventsTrait;

    private BaseRequest $request;
    private RepositoryInterface $repository;

    abstract public function getModel(): Model;

    public function perPage(BaseRequest $request): int
    {
        return $this->getModel()->getPerPage();
    }

    public function getDescriptor(): array
    {
        return [
            'name' => $this->label(),
            'label' => Str::plural($this->label()),
            'uriKey' => static::uriKey(),
        ];
    }

    public static function humanize(string $value): string
    {
        return Str::title(Str::snake($value, ' '));
    }

    public function label(): string
    {
        return static::humanize(class_basename(static::class));
    }

    public function useRepository(RepositoryInterface $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function repository(): RepositoryInterface
    {
        return $this->repository ?? new Repository($this->getModel());
    }

    public function getFiltersListing(): array
    {
        return $this->resolveFilters()->toArray();
    }

}
