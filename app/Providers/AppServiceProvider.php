<?php

namespace SerEducacional\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # Validator para espaços em branco
        Validator::extend('serbinario_alpha_space', function($attribute, $value, $formats, $validator) {
            #expressão regular
            $pattern = "/^[\pL\s\-]+$/u";

            #Validando pela expressão regular
            if (\preg_match($pattern, $value)) {
                return true;
            }

            #retorno
            return false;
        });

        # Validator para formatos de datas
        Validator::extend('serbinario_date_format', function($attribute, $value, $formats, $validator) {
            #Verificando se o valor já é uma data
            if($value instanceof \DateTime) {
                return true;
            }

            #Convertendo a data
            $parsed = date_parse_from_format($formats[0], $value);

            #Verificando se houve erro de conversão
            if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
                return true;
            }

            #retorno
            return false;
        });

        # Validator cpf Brasil
        Validator::extend('cpf_br', function($attribute, $value, $formats, $validator) {
            #expressão regular
            $pattern = "/^([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}|[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2})$/";

            #Validando pela expressão regular
            if (\preg_match($pattern, $value)) {
                return true;
            }

            #retorno
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
