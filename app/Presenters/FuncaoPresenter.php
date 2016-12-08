<?php

namespace SerEducacional\Presenters;

use SerEducacional\Transformers\FuncaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FuncaoPresenter
 *
 * @package namespace SerEducacional\Presenters;
 */
class FuncaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FuncaoTransformer();
    }
}
