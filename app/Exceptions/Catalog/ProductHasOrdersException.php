<?php

namespace App\Exceptions\Catalog;

class ProductHasOrdersException extends \Exception
{
    protected $code = 422;
    protected $message = 'Товар находится в заказах и не может быть удален';
}
