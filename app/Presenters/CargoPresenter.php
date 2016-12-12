<?php

namespace SerEducacional\Presenters;

use SerEducacional\Transformers\CargoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CargoPresenter
 *
 * @package namespace SerEducacional\Presenters;
 */
class CargoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CargoTransformer();
    }
}
