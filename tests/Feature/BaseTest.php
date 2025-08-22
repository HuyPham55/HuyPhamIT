<?php

namespace Tests\Feature;

use Tests\TestCase;

class BaseTest extends TestCase
{
    /**
     * @return string|null
     */
    public function getCsrfToken(): ?string
    {
        $csrf = $this->withServerVariables([
            // makes Sanctum treat it as a “stateful” first-party request
            'HTTP_ORIGIN' => config('app.url'),
            'HTTP_REFERER' => config('app.url'),
        ])
            ->get('/sanctum/csrf-cookie');
        // pull the token value out of Laravel’s cookie jar
        return $csrf->headers->getCookies()[0]->getValue();
    }
}
