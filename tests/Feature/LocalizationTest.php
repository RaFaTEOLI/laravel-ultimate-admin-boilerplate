<?php

namespace Tests\Feature;

use App\Http\HttpStatus;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    /**
     * It should change language
     *
     * @return void
     */
    public function testShouldChangeLanguage()
    {
        $response = $this->json("GET", env("APP_API") . "/lang/pt-BR");

        $response
            ->assertStatus(HttpStatus::SUCCESS)
            ->assertJson(['status' => 'success', 'message' => 'Idioma alterado com sucesso!']);
    }

    /**
     * It should not change language because locale is invalid
     *
     * @return void
     */
    public function testShouldNotChangeLanguageBecauseLocaleIsInvalid()
    {
        $response = $this->json("GET", env("APP_API") . "/lang/INVALID");

        $response
            ->assertStatus(HttpStatus::BAD_REQUEST)
            ->assertJson(['status' => 'Error', 'message' => 'Invalid Localization!', 'data' => null]);
    }
}
