<?php

namespace App\Services;

use App\Handlers\TestHandlerFactory;
use App\Helpers\AuthGuardHelper;
use App\Models\Collection;
use App\Models\CustomCollection;
use App\Models\CustomTest;
use App\Models\PendingTestAnswer;
use App\Models\Test;
use App\Models\UserCustomTest;
use App\Models\UserTest;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TestService
{
    protected TestHandlerFactory $handlerFactory;

    public function __construct(TestHandlerFactory $handlerFactory)
    {
        $this->handlerFactory = $handlerFactory;
    }

    public function process(CustomCollection $collection, Test | CustomTest $test, array $answers): bool
    {
        $answersValues = array_map(function ($value) {
            return (int) $value;
        }, $answers);

        $sessionKey = $collection->collectionType->key_name . "|" . $test->key_name ."|result";
        
        session([$sessionKey=> $answersValues]);

        return true;
    }

    public function evaluateTests(Test | CustomTest $testType, EloquentCollection $metrics, ?string $collectionKeyName = null): array
    {        
        $handler = $this->handlerFactory->getHandler($testType, $collectionKeyName ?? null);
        $evaluatedTest = $handler->processTests($testType, $metrics);

        return $evaluatedTest;
    }

    public function evaluateIndividualTest(Test | CustomTest $testType, UserTest $userTest, EloquentCollection $metrics, ?string $collectionKeyName = null): array
    {        
        $handler = $this->handlerFactory->getHandler($testType, $collectionKeyName ?? null);
        $evaluatedTest = $handler->processIndividualTest($testType, $userTest, $metrics);

        return $evaluatedTest;
    }
}
